<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('email_campaigns', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('subject');
            $t->text('body')->nullable();                // for Blade template
            $t->string('blade_view')->default('emails.campaign'); // Blade view to render
            $t->string('sendgrid_template_id')->nullable();       // optional, later
            $t->enum('status', ['queued','sending','completed','failed'])->default('queued');
            $t->unsignedBigInteger('total_targets')->default(0);
            $t->unsignedBigInteger('sent_count')->default(0);
            $t->unsignedBigInteger('failed_count')->default(0);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { Schema::dropIfExists('email_campaigns'); }
};
