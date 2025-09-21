<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\BulkLeadMail;
use App\Models\Lead;

class SendLeadMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries   = 1;      // avoid duplicate re-sends on retry
    public $backoff = 60;

    public function __construct(
        public int $leadId,
        public string $subjectLine,
        public string $body,
        public bool $forceResend = false   // allow resending if explicitly requested
    ) {}

    public function handle(): void
    {
        $lead = Lead::find($this->leadId);
        if (!$lead) return;

        // idempotency: skip if already sent (unless forced)
        if (!$this->forceResend && $lead->send_status === 'sent') {
            return;
        }

        // choose best recipient
        $to = $lead->email1 ?? $lead->business_email ?? $lead->email2;
        if (!$to) {
            $lead->update(['send_status' => 'failed', 'last_error' => 'no email']);
            return;
        }

        try {
            // mark pending
            $lead->update(['send_status' => 'pending', 'last_error' => null]);

            // send
            // Mail::to($to)->send(new BulkLeadMail($this->subjectLine, $this->body, $lead));
            Mail::to($to)->send(new BulkLeadMail(
    $this->subjectLine,
    $this->body,
    $lead
));

            // mark sent
            $lead->update([
                'send_status'  => 'sent',
                'last_sent_at' => now(),
                'last_error'   => null,
            ]);
        } catch (\Throwable $e) {
            $lead->update([
                'send_status' => 'failed',
                'last_error'  => Str::limit($e->getMessage(), 500),
            ]);
            // do NOT rethrow to avoid repeat sends
        }
    }
}
