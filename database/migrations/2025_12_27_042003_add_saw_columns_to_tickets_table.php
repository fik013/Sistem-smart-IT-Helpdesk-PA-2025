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
            $table->foreignId('inventory_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('urgency', ['low', 'medium', 'high'])->default('low');
            $table->decimal('saw_score', 8, 4)->default(0.0000);
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
