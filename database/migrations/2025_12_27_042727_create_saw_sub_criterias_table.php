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
        Schema::create('saw_sub_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saw_criteria_id')->constrained('saw_criterias')->onDelete('cascade');
            $table->string('name');
            $table->decimal('weight', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saw_sub_criterias');
    }
};
