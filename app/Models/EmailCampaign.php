<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCampaign extends Model
{
    protected $fillable = ['name','subject','body','blade_view','sendgrid_template_id','status','total_targets','sent_count','failed_count'];
    public function sends(){ return $this->hasMany(EmailSend::class); }
}