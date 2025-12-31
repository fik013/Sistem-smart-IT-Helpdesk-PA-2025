<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update Criteria Name
        $c3 = DB::table('saw_criterias')->where('code', 'C3')->first();
        
        if ($c3) {
            DB::table('saw_criterias')
                ->where('id', $c3->id)
                ->update(['name' => 'Pengguna Aset', 'updated_at' => now()]);

            // 2. Delete old sub-criteria for C3
            DB::table('saw_sub_criterias')->where('saw_criteria_id', $c3->id)->delete();

            // 3. Insert new sub-criteria
            // Higher weight for Department/Divisi
            DB::table('saw_sub_criterias')->insert([
                [
                    'saw_criteria_id' => $c3->id,
                    'name' => 'Perorangan',
                    'weight' => 0.50,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'saw_criteria_id' => $c3->id,
                    'name' => 'Divisi / Departemen',
                    'weight' => 1.00, // Lebih besar bobotnya
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $c3 = DB::table('saw_criterias')->where('code', 'C3')->first();

        if ($c3) {
            // Revert Name
            DB::table('saw_criterias')
                ->where('id', $c3->id)
                ->update(['name' => 'Jumlah Pelapor', 'updated_at' => now()]);

            // Revert Sub-criteria (Approximate restore of previous state)
            DB::table('saw_sub_criterias')->where('saw_criteria_id', $c3->id)->delete();
            
            DB::table('saw_sub_criterias')->insert([
                ['saw_criteria_id' => $c3->id, 'name' => '1', 'weight' => 0.20, 'created_at' => now(), 'updated_at' => now()],
                ['saw_criteria_id' => $c3->id, 'name' => '2-3', 'weight' => 0.60, 'created_at' => now(), 'updated_at' => now()],
                ['saw_criteria_id' => $c3->id, 'name' => '>4', 'weight' => 1.00, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
};
