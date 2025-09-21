<?php

namespace App\Jobs;

use App\Mail\BulkEmailMailable;
use Illuminate\Bus\Batchable;   
use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class SendLeadEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, Batchable;

    public $tries = 3;
    public $backoff = 60; // seconds

    public function __construct(public int $leadId, public array $payload = []) {}

    public function handle(): void
    {
        $lead = Lead::find($this->leadId);
        if (!$lead || $lead->unsubscribed) return;

        $to = $lead->email1 ?? $lead->business_email ?? $lead->email2;
        if (!$to) return;

        // Global throttle: 100 sends per second across all workers
        $sent = false;
        while (!$sent) {
            $sent = RateLimiter::attempt('sendgrid:global', 100, function () use ($lead, $to) {
                Mail::to($to)->send(new BulkEmailMailable([
                    'subject' => $this->payload['subject'] ?? 'Hello from Your Brand',
                    'body' => $this->payload['body'] ?? '',
                    'first_name' => $lead->first_name,
                    'category' => $this->payload['category'] ?? 'bulk-campaign',
                    'unsubscribe_url' => url("/unsubscribe/{$lead->id}")
                ]));
            }, 1); // decay 1 second

            if (!$sent) usleep(10000); // 10ms backoff until a slot opens
        }
    }
}
