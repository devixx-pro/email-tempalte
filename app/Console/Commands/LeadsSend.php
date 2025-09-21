<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Lead;
use App\Models\LeadImport;
use App\Jobs\SendLeadMail;

class LeadsSend extends Command
{
    protected $signature = 'leads:send 
        {subject : Email subject}
        {body : Email body}
        {--import= : Import ID to target (optional)}
        {--limit= : Limit number of emails (optional)}
        {--resume : Only queue leads with status failed or null}';

    protected $description = 'Queue emails to leads (simple mode: status tracked on leads table)';

    public function handle(): int
    {
        $subject = $this->argument('subject');
        $body    = $this->argument('body');
        $limit   = (int)($this->option('limit') ?? 0);
        $resume  = (bool)$this->option('resume');

        // base query: not unsubscribed + has an email
        $q = Lead::query()
            ->where(function ($q) {
                $q->where('unsubscribed', false)->orWhereNull('unsubscribed');
            })
            ->where(function ($q) {
                $q->whereNotNull('email1')
                  ->orWhereNotNull('business_email')
                  ->orWhereNotNull('email2');
            });

        if ($this->option('import')) {
            $imp = LeadImport::find($this->option('import'));
            if (!$imp) { $this->error('Import not found'); return self::FAILURE; }
            $start = $imp->created_at;
            $end   = ($imp->updated_at ?? now())->addSecond();
            $q->whereBetween('updated_at', [$start, $end]);
        }

        if ($resume) {
            $q->where(function ($q) {
                $q->whereNull('send_status')
                  ->orWhere('send_status', 'failed');
            });
        }

        $this->info('Queuing jobs...');
        $count = 0;
        $stop  = false;

        $q->orderBy('id')->chunkById(5000, function ($chunk) use (&$count, $limit, $subject, $body, &$stop) {
            if ($stop) return false; // stop further chunking

            foreach ($chunk as $lead) {
                if ($limit && $count >= $limit) { $stop = true; break; }

                // queue one job per lead to "emails" queue
                dispatch(new SendLeadMail($lead->id, $subject, $body))->onQueue('emails');

                // mark pending right away
                $lead->send_status = 'pending';
                $lead->last_error  = null;
                $lead->save();

                $count++;
            }

            if ($stop) return false; // tell chunkById to stop
        });

        $this->info("Queued {$count} emails.");
        return self::SUCCESS;
    }
}
