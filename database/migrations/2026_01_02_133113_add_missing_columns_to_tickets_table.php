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
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('inventory_id')->nullable()->after('user_id')->constrained()->nullOnDelete();
            $table->enum('urgency', ['low', 'medium', 'high'])->default('low')->after('status');
            $table->float('saw_score')->nullable()->after('urgency');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['inventory_id']);
            $table->dropColumn(['inventory_id', 'urgency', 'saw_score']);
        });
    }
};
