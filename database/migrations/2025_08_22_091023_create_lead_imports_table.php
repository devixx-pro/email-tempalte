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
        Schema::create('lead_imports', function (Blueprint $t) {
            $t->id();
            $t->string('original_name');
            $t->string('stored_path');
            $t->unsignedBigInteger('total_rows')->nullable();
            $t->unsignedBigInteger('processed_rows')->default(0);
            $t->enum('status', ['pending', 'processing', 'completed', 'failed'])->default('pending');
            $t->text('error')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_imports');
    }
};
