<?php

namespace App\Mail;

use App\Models\EmailCampaign;
use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class CampaignMailable extends Mailable
{
    use Queueable;

    public function __construct(public EmailCampaign $campaign, public Lead $lead) {}

    public function build()
    {
        // Optional: add SendGrid category / custom args for analytics
        $this->withSymfonyMessage(function($message){
            $message->getHeaders()->addTextHeader('X-SMTPAPI', json_encode([
                'category'    => 'bulk-campaign',
                'unique_args' => ['lead_id' => (string)$this->lead->id, 'campaign_id' => (string)$this->campaign->id],
            ]));
        });

        return $this->subject($this->campaign->subject)
                    ->view($this->campaign->blade_view)
                    ->with(['campaign'=>$this->campaign,'lead'=>$this->lead]);
    }
}