<?php 

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class BulkEmailMailable extends Mailable
{
    use Queueable;

    public function __construct(public array $payload = []) {}

    public function build()
    {
        // Optional: add SendGrid categories/args via headers
        $this->withSymfonyMessage(function($message){
            $message->getHeaders()->addTextHeader('X-SMTPAPI', json_encode([
                'category' => $this->payload['category'] ?? 'bulk-campaign',
            ]));
        });

        return $this->subject($this->payload['subject'] ?? 'Hello from Your Brand')
                    ->view('emails.bulk')
                    ->with($this->payload);
    }
}
