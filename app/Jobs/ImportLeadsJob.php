<?php

namespace App\Jobs;

use App\Models\LeadImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SplFileObject;
// NEW: Spout for XLSX
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ImportLeadsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $timeout = 0;

    public function __construct(
        public int $importId,
        public bool $hasHeader = true,
        public string $delimiter = ',',
        public string $ext = 'csv'  // 'csv' or 'xlsx'
    ) {}

    public function handle(): void
    {
        // Memory safety
        ini_set('memory_limit', '1024M');
        DB::connection()->disableQueryLog();

        $import = LeadImport::find($this->importId);
        if (!$import) return;

        $import->update(['status' => 'processing', 'processed_rows' => 0, 'error' => null]);

        $path = $import->stored_path;
        if (!Storage::exists($path)) {
            $import->update(['status' => 'failed', 'error' => 'File not found']);
            return;
        }
        $fullPath = Storage::path($path);

        $batchSize = 1000;      // smaller batch to keep RAM low
        $processed = 0;
        $buffer = [];

        // cleaners
        $clean      = fn($v)=> $v===null ? null : trim(preg_replace('/\s+/', ' ', (string)$v));
        $cleanEmail = fn($v)=> ($v=$clean($v)) ? mb_strtolower($v) : null;
        $cleanPhone = fn($v)=> ($v=$clean($v)) ? (preg_replace('/[^0-9+]/','',$v) ?: null) : null;
        $cleanAge   = function($v) use ($clean){ $v=$clean($v); $n=(int)preg_replace('/\D/','',(string)$v); return ($n>0 && $n<130)?$n:null; };

        // header mapping
        $map = null;
        $aliases = [
            'first name' => 'f name',
            'middle name' => 'm name',
            'primary business phone' => 'p business phone',
            'alt phone' => 'alt business phone',
            'business email' => 'bus email',
            'email1'=> 'email 1',
            'email2'=>'email 2',
        ];

        $consumeRow = function(array $row) use (&$buffer,&$processed,$batchSize,$import,$clean,$cleanEmail,$cleanPhone,$cleanAge,&$map,$aliases) {
            if ($map === null) {
                // Build map from header row
                $lower = array_map(fn($h)=> mb_strtolower(trim((string)$h)), $row);
                $want = [
                    'f name'=>null,'m name'=>null,'l name'=>null,'age'=>null,
                    'p business phone'=>null,'alt business phone'=>null,
                    'email 1'=>null,'email 2'=>null,'bus email'=>null,
                ];
                foreach ($lower as $i=>$h) if (array_key_exists($h,$want)) $want[$h]=$i;
                foreach ($lower as $i=>$h) if (isset($aliases[$h]) && $want[$aliases[$h]]===null) $want[$aliases[$h]]=$i;
                $map = $want;
                return; // header consumed
            }

            $get = function($key) use ($row,$map){ $i=$map[$key]??null; return $i===null?null:($row[$i]??null); };

            $first = $clean($get('f name'));
            $middle= $clean($get('m name'));
            $last  = $clean($get('l name'));
            $age   = $cleanAge($get('age'));

            $pPhone= $cleanPhone($get('p business phone'));
            $aPhone= $cleanPhone($get('alt business phone'));

            $email1= $cleanEmail($get('email 1'));
            $email2= $cleanEmail($get('email 2'));
            $bEmail= $cleanEmail($get('bus email'));

            if (!$email1 && !$email2 && !$bEmail && !$pPhone && !$aPhone && !$first && !$last) return;

            $parts = array_filter([
                mb_strtolower($first ?? ''), mb_strtolower($middle ?? ''), mb_strtolower($last ?? ''),
                $age, $pPhone, $aPhone, $email1, $email2, $bEmail
            ], fn($v)=> $v!==null && $v!=='');
            sort($parts, SORT_NATURAL);
            $dedupe = hash('sha256', implode('|', $parts));

            $buffer[] = [
                'first_name' => $first,
                'middle_name'=> $middle,
                'last_name'  => $last,
                'age'        => $age,
                'primary_business_phone' => $pPhone,
                'alt_business_phone'     => $aPhone,
                'email1' => $email1,
                'email2' => $email2,
                'business_email' => $bEmail,
                'dedupe_key' => $dedupe,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($buffer) >= $batchSize) {
                DB::table('leads')->upsert(
                    $buffer,
                    ['dedupe_key'],
                    [
                        'first_name','middle_name','last_name','age',
                        'primary_business_phone','alt_business_phone',
                        'email1','email2','business_email','updated_at'
                    ]
                );
                $processed += count($buffer);
                $buffer = [];
                $import->update(['processed_rows' => $processed]);
                gc_collect_cycles();
            }
        };

        if ($this->ext === 'xlsx') {
            // Stream XLSX via Spout
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->open($fullPath);
            $firstRow = true;
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = [];
                    foreach ($row->getCells() as $cell) { $cells[] = $cell->getValue(); }
                    if ($firstRow) {
                        if ($this->hasHeader) { $consumeRow($cells); }
                        else { $map = [ 'f name'=>0,'m name'=>1,'l name'=>2,'age'=>3,'p business phone'=>4,'alt business phone'=>5,'email 1'=>6,'email 2'=>7,'bus email'=>8 ]; }
                        $firstRow = false;
                        if ($this->hasHeader) continue; // header consumed
                    }
                    $consumeRow($cells);
                }
            }
            $reader->close();
        } else {
            // CSV streaming
            $fh = new SplFileObject($fullPath, 'r');
            $fh->setFlags(SplFileObject::READ_CSV | SplFileObject::DROP_NEW_LINE);
            $fh->setCsvControl($this->delimiter);

            $isFirst = true;
            while (!$fh->eof()) {
                $row = $fh->fgetcsv();
                if ($row === false || $row === [null]) continue;
                if ($isFirst) {
                    if ($this->hasHeader) { $consumeRow($row); }
                    else { $map = [ 'f name'=>0,'m name'=>1,'l name'=>2,'age'=>3,'p business phone'=>4,'alt business phone'=>5,'email 1'=>6,'email 2'=>7,'bus email'=>8 ]; }
                    $isFirst = false;
                    if ($this->hasHeader) continue;
                }
                $consumeRow($row);
            }
        }

        if ($buffer) {
            DB::table('leads')->upsert(
                $buffer,
                ['dedupe_key'],
                [
                    'first_name','middle_name','last_name','age',
                    'primary_business_phone','alt_business_phone',
                    'email1','email2','business_email','updated_at'
                ]
            );
            $processed += count($buffer);
        }

        $import->update(['processed_rows' => $processed, 'status' => 'completed']);
    }

    public function failed(\Throwable $e): void
    {
        if ($import = LeadImport::find($this->importId)) {
            $import->update(['status' => 'failed', 'error' => $e->getMessage()]);
        }
    }
}
