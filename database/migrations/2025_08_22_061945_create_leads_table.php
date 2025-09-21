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
        Schema::create('leads', function (Blueprint $t) {
            $t->id();

            // Core identity
            $t->string('first_name')->nullable();
            $t->string('middle_name')->nullable();
            $t->string('last_name')->nullable();
            $t->unsignedSmallInteger('age')->nullable();

            // Phones
            $t->string('primary_business_phone', 32)->nullable();
            $t->string('alt_business_phone', 32)->nullable();

            // Emails
            $t->string('email1')->nullable();
            $t->string('email2')->nullable();
            $t->string('business_email')->nullable();

            // Dedupe
            $t->string('dedupe_key', 64)->unique();

            // Optional sending/CRM fields (handy later)
            $t->boolean('unsubscribed')->default(false);
            $t->timestamp('last_sent_at')->nullable();
            $t->unsignedInteger('send_attempts')->default(0);

            $t->timestamps();

            // Useful indexes
            $t->index('email1');
            $t->index('email2');
            $t->index('business_email');
            $t->index('primary_business_phone');
            $t->index('alt_business_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
