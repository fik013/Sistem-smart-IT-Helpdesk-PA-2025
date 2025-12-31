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
        // Update C3 name from 'Status Garansi' to 'Jumlah Pelapor'
        \DB::table('saw_criterias')
            ->where('code', 'C3')
            ->update(['name' => 'Jumlah Pelapor', 'attribute' => 'benefit']);

        // Delete old sub-criteria for C3
        $c3 = \DB::table('saw_criterias')->where('code', 'C3')->first();
        if ($c3) {
            \DB::table('saw_sub_criterias')->where('saw_criteria_id', $c3->id)->delete();

            // Insert new sub-criteria
            \DB::table('saw_sub_criterias')->insert([
                ['saw_criteria_id' => $c3->id, 'name' => '1', 'weight' => 0.20, 'created_at' => now(), 'updated_at' => now()],
                ['saw_criteria_id' => $c3->id, 'name' => '2-3', 'weight' => 0.60, 'created_at' => now(), 'updated_at' => now()],
                ['saw_criteria_id' => $c3->id, 'name' => '>4', 'weight' => 1.00, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert C3 name to 'Status Garansi'
        \DB::table('saw_criterias')
            ->where('code', 'C3')
            ->update(['name' => 'Status Garansi']);
            
        // Note: Reverting sub-criteria is tricky without original data backup, 
        // but for development this is usually acceptable or handled by re-seeding.
    }
};
