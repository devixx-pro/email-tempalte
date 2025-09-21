<?php

namespace App\Jobs;

use App\Mail\CampaignMailable;
use App\Models\EmailSend;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class SendEmailSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, Batchable;

    public $tries = 3;
    public $backoff = 60;

    public function __construct(public string $sendKey) {}

    public function handle(): void
    {
        $send = EmailSend::with(['campaign','lead'])->where('send_key', $this->sendKey)->first();
        if (!$send) return;

        // Skip if unsubscribed now or missing email
        if ($send->lead->unsubscribed) { $send->update(['status'=>'failed','error'=>'unsubscribed']); return; }
        $to = $send->to_email;
        if (!$to) { $send->update(['status'=>'failed','error'=>'no to_email']); return; }

        // Throttle globally (e.g., 100/sec)
        $ok = RateLimiter::attempt('sendgrid:global', 100, function () use ($send, $to) {
            Mail::to($to)->send(new CampaignMailable($send->campaign, $send->lead));
        }, 1);
        if (!$ok) { usleep(10000); $this->release(1); return; } // try shortly

        $send->update(['status'=>'sent','sent_at'=>now()]);
        $send->campaign()->increment('sent_count');
        $send->lead->increment('send_attempts'); // optional: track on lead too
    }

    public function failed(\Throwable $e): void
    {
        EmailSend::where('send_key',$this->sendKey)->update([
            'status'=>'failed',
            'error'=> Str::limit($e->getMessage(), 500),
        ]);
    }
}
