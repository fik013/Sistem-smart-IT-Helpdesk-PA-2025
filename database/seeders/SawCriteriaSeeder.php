<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SawCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SawCriteria::create([
            'code' => 'C1',
            'name' => 'Tingkat Urgensi',
            'attribute' => 'benefit',
            'weight' => 0.40,
        ]);
        \App\Models\SawCriteria::create([
            'code' => 'C2',
            'name' => 'Jenis Aset',
            'attribute' => 'benefit',
            'weight' => 0.30,
        ]);
        \App\Models\SawCriteria::create([
            'code' => 'C3',
            'name' => 'Jumlah Pelapor',
            'attribute' => 'benefit',
            'weight' => 0.20,
        ]);
        \App\Models\SawCriteria::create([
            'code' => 'C4',
            'name' => 'Jabatan Pengguna',
            'attribute' => 'benefit',
            'weight' => 0.10,
        ]);
    }
}
