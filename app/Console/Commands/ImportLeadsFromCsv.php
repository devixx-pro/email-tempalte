<?php
namespace App\Console\Commands;

use App\Models\Lead;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportLeadsFromCsv extends Command
{
    protected $signature = 'leads:import {path : Absolute path to CSV}
                                     {--batch=5000}
                                     {--delimiter=,}
                                     {--headers=1 : 1 if first row has headers}';
    protected $description = 'Stream-import large CSV into leads with dedupe & batch upsert';

    public function handle(): int
    {
        $path = $this->argument('path');
        if (!is_readable($path)) { $this->error("File not readable: $path"); return self::FAILURE; }

        $batchSize = (int)$this->option('batch');
        $delimiter = (string)$this->option('delimiter');
        $hasHeaders = (bool)$this->option('headers');

        $fh = new \SplFileObject($path, 'r');
        $fh->setFlags(\SplFileObject::READ_CSV | \SplFileObject::DROP_NEW_LINE);
        $fh->setCsvControl($delimiter);

        // Map columns by header name (case-insensitive)
        $map = null;
        if ($hasHeaders && !$fh->eof()) {
            $headers = array_map(fn($h)=>mb_strtolower(trim((string)$h)), (array)$fh->fgetcsv());
            $want = [
                'fname' => null,
                'm name' => null,
                'last name' => null,
                'age' => null,
                'p business phone' => null,
                'alt business phone' => null,
                'email1' => null,
                'email2' => null,
                'bus email' => null,
            ];
            foreach ($headers as $i => $h) {
                if (array_key_exists($h, $want)) $want[$h] = $i;
            }
            // Fall back: also match common variants
            $aliases = [
                'first name' => 'fname',
                'middle name' => 'm name',
                'last_name' => 'last name',
                'primary business phone' => 'p business phone',
                'alt phone' => 'alt business phone',
                'business email' => 'bus email',
            ];
            foreach ($headers as $i => $h) {
                if (isset($aliases[$h]) && $want[$aliases[$h]] === null) $want[$aliases[$h]] = $i;
            }
            // Ensure minimal mapping
            if ($want['fname']===null && $want['last name']===null && $want['email1']===null && $want['bus email']===null) {
                $this->error('Headers not recognized. Ensure expected names exist (e.g., Fname, Last Name, Email1, Bus Email).');
                return self::FAILURE;
            }
            $map = $want;
        } else {
            // If no headers, assume strict order
            $map = [
                'fname' => 0,
                'm name' => 1,
                'last name' => 2,
                'age' => 3,
                'p business phone' => 4,
                'alt business phone' => 5,
                'email1' => 6,
                'email2' => 7,
                'bus email' => 8,
            ];
        }

        $clean = fn($v)=>$v===null?null:trim(preg_replace('/\s+/', ' ', (string)$v));
        $cleanEmail = fn($v)=>($v=$clean($v)) ? mb_strtolower($v) : null;
        $cleanPhone = fn($v)=>($v=$clean($v)) ? (preg_replace('/[^0-9+]/','',$v) ?: null) : null;
        $cleanAge = function($v) use ($clean){ $v=$clean($v); $n=(int)preg_replace('/\D/','',(string)$v); return ($n>0 && $n<130)?$n:null; };

        $buffer=[]; $rows=0; $upserts=0;

        while (!$fh->eof()) {
            $row = $fh->fgetcsv();
            if ($row===false || $row===[null]) continue;

            $get = function($key) use ($row,$map){ $i=$map[$key]??null; return $i!==null?($row[$i]??null):null; };

            $first = $clean($get('fname'));
            $middle= $clean($get('m name'));
            $last  = $clean($get('last name'));
            $age   = $cleanAge($get('age'));

            $pPhone= $cleanPhone($get('p business phone'));
            $aPhone= $cleanPhone($get('alt business phone'));

            $email1= $cleanEmail($get('email1'));
            $email2= $cleanEmail($get('email2'));
            $bEmail= $cleanEmail($get('bus email'));

            // Quick email sanity — skip rows with no any email
            if (!$email1 && !$email2 && !$bEmail && !$pPhone && !$aPhone && !$first && !$last) { continue; }

            // Stable dedupe across fields
            $parts = array_filter([
                mb_strtolower($first ?? ''), mb_strtolower($middle ?? ''), mb_strtolower($last ?? ''),
                $age, $pPhone, $aPhone, $email1, $email2, $bEmail
            ], fn($v)=>$v!==null && $v!=='');
            sort($parts, SORT_NATURAL);
            $dedupe = hash('sha256', implode('|',$parts));

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
            $rows++;

            if (count($buffer) >= $batchSize) {
                $upserts += $this->flush($buffer);
                $buffer=[];
                $this->info("Processed $rows; upserts so far: $upserts");
            }
        }
        if ($buffer) $upserts += $this->flush($buffer);

        $this->info("Done. Rows processed: $rows; total upserts: $upserts");
        return self::SUCCESS;
    }

    protected function flush(array $buffer): int
    {
        return DB::table('leads')->upsert(
            $buffer,
            ['dedupe_key'],
            [
                'first_name','middle_name','last_name','age',
                'primary_business_phone','alt_business_phone',
                'email1','email2','business_email','updated_at'
            ]
        );
    }
}
