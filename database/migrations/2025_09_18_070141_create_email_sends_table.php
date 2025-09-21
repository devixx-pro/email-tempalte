<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_sends', function (Blueprint $t) {
            $t->id();
            $t->foreignId('email_campaign_id')->constrained('email_campaigns')->cascadeOnDelete();
            $t->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
            $t->uuid('send_key')->unique();                   // stable id for job->row mapping
            $t->string('to_email')->index();
            $t->enum('status', ['queued', 'sent', 'failed'])->index();
            $t->string('provider_message_id')->nullable();    // optional if you add webhook later
            $t->string('error', 512)->nullable();
            $t->timestamp('queued_at')->nullable();
            $t->timestamp('sent_at')->nullable();
            $t->timestamps();

            $t->index(['email_campaign_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_sends');
    }
};
