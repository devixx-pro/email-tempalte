<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\Lead;

class BulkLeadMail extends Mailable
{
    use Queueable;

    public function __construct(public string $subjectLine, public string $body, public Lead $lead) {}

    public function build()
    {
        // Optional: Reply-To
        $this->replyTo(config('mail.reply_to.address') ?? 'diwakar.orion@gmail.com', 'Support');

        // Optional: SendGrid categorization (helps stats)
        $this->withSymfonyMessage(function($message){
            $message->getHeaders()->addTextHeader('X-SMTPAPI', json_encode([
                'category' => 'bulk-campaign',
            ]));
        });

        // return $this->subject($this->subjectLine)
        //             ->view('emails.bulk')
        //             ->with(['lead'=>$this->lead, 'body'=>$this->body]);

        return $this->subject($this->subjectLine)
            ->view('emails.bulk')               // <-- your file: resources/views/email/bulk.blade.php
            ->with([
                'lead' => $this->lead,         // e.g. use {{ $lead->first_name }} in the blade
                'body' => $this->body,         // put {!! $body !!} if you pass HTML
                // add any extra variables your template expects:
                // 'preheader' => $this->data['preheader'] ?? null,
                // 'cta_text'  => $this->data['cta_text'] ?? null,
                // 'cta_url'   => $this->data['cta_url'] ?? null,
            ]);
    }
}
