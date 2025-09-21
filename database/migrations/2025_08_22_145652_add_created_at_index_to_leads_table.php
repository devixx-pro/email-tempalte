<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('leads', function (Blueprint $t) {
            $t->index('created_at', 'leads_created_at_index');
        });
    }
    public function down(): void {
        Schema::table('leads', function (Blueprint $t) {
            $t->dropIndex('leads_created_at_index'); // drop by name = safest
        });
    }
};
