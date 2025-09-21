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
        Schema::table('leads', function (Blueprint $t) {
            $t->string('send_status', 16)->nullable()->index(); // pending|sent|failed
            // $t->timestamp('last_sent_at')->nullable()->index();
            $t->string('last_error', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
    Schema::table('leads', function (Blueprint $t) {
      $t->dropColumn(['send_status','last_sent_at','last_error']);
    });
  }
};
