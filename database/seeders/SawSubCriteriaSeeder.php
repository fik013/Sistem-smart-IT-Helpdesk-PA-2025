<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SawSubCriteria;

class SawSubCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate can be dangerous in production but standard in dev seeding if we want a clean state.
        // But user asked to "replace with existing data".
        // I will use updateOrCreate to preserve IDs if possible, or just re-insert.
        // Given complexity, updateOrCreate by ID is safest.
        
        $subCriteria = [
            ['id' => 1, 'saw_criteria_id' => 1, 'name' => 'high', 'weight' => '1.00'],
            ['id' => 2, 'saw_criteria_id' => 1, 'name' => 'medium', 'weight' => '0.66'],
            ['id' => 3, 'saw_criteria_id' => 1, 'name' => 'low', 'weight' => '0.33'],
            ['id' => 20, 'saw_criteria_id' => 3, 'name' => 'Perorangan', 'weight' => '0.50'],
            ['id' => 21, 'saw_criteria_id' => 3, 'name' => 'Divisi / Departemen', 'weight' => '1.00'],
            ['id' => 23, 'saw_criteria_id' => 2, 'name' => 'Server', 'weight' => '0.70'],
            ['id' => 24, 'saw_criteria_id' => 2, 'name' => 'Network', 'weight' => '0.50'],
            ['id' => 25, 'saw_criteria_id' => 4, 'name' => 'Direktur', 'weight' => '0.90'],
            ['id' => 26, 'saw_criteria_id' => 4, 'name' => 'Divisi IT', 'weight' => '0.50'],
            ['id' => 27, 'saw_criteria_id' => 4, 'name' => 'Manager', 'weight' => '0.60'],
            ['id' => 28, 'saw_criteria_id' => 4, 'name' => 'Divisi Desain', 'weight' => '0.40'],
            ['id' => 29, 'saw_criteria_id' => 4, 'name' => 'Divisi Customer Service', 'weight' => '0.70'],
            ['id' => 30, 'saw_criteria_id' => 4, 'name' => 'Divisi Marketing', 'weight' => '0.30'],
            ['id' => 31, 'saw_criteria_id' => 4, 'name' => 'Divisi Finance', 'weight' => '0.30'],
            ['id' => 32, 'saw_criteria_id' => 4, 'name' => 'Divisi Hr', 'weight' => '0.40'],
        ];

        foreach ($subCriteria as $item) {
            SawSubCriteria::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
