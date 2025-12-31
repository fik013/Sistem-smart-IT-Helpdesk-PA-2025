<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SawSubCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SawSubCriteria::truncate();

        $c1 = \App\Models\SawCriteria::where('code', 'C1')->first();
        if ($c1) {
            $c1->subCriterias()->createMany([
                ['name' => 'high', 'weight' => 1.00],
                ['name' => 'medium', 'weight' => 0.66],
                ['name' => 'low', 'weight' => 0.33],
            ]);
        }

        $c2 = \App\Models\SawCriteria::where('code', 'C2')->first();
        if ($c2) {
            $c2->subCriterias()->createMany([
                ['name' => 'Server', 'weight' => 1.00],
                ['name' => 'Network', 'weight' => 0.90],
                ['name' => 'Laptop', 'weight' => 0.80],
                ['name' => 'PC', 'weight' => 0.70],
                ['name' => 'Printer', 'weight' => 0.50],
                ['name' => 'Other', 'weight' => 0.40],
            ]);
        }

        $c3 = \App\Models\SawCriteria::where('code', 'C3')->first();
        if ($c3) {
            $c3->subCriterias()->createMany([
                ['name' => '1', 'weight' => 0.20],
                ['name' => '2-3', 'weight' => 0.60],
                ['name' => '>4', 'weight' => 1.00],
            ]);
        }

        $c4 = \App\Models\SawCriteria::where('code', 'C4')->first();
        if ($c4) {
            $c4->subCriterias()->createMany([
                ['name' => 'Director', 'weight' => 1.00],
                ['name' => 'Manager', 'weight' => 0.80],
                ['name' => 'Staff', 'weight' => 0.50],
            ]);
        }
    }
}
