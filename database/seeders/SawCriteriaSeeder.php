<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SawCriteria;

class SawCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteria = [
            [
                'id' => 1,
                'code' => 'C1',
                'name' => 'Tingkat Urgensi',
                'attribute' => 'benefit',
                'weight' => '0.40',
                'description' => 'Deskripsi',
                'is_active' => 1,
            ],
            [
                'id' => 2,
                'code' => 'C2',
                'name' => 'Jenis Aset',
                'attribute' => 'benefit',
                'weight' => '0.30',
                'description' => null,
                'is_active' => 1,
            ],
            [
                'id' => 3,
                'code' => 'C3',
                'name' => 'Pengguna Aset',
                'attribute' => 'benefit',
                'weight' => '0.20',
                'description' => null,
                'is_active' => 1,
            ],
            [
                'id' => 4,
                'code' => 'C4',
                'name' => 'Jabatan Pengguna',
                'attribute' => 'benefit',
                'weight' => '0.10',
                'description' => null,
                'is_active' => 1,
            ],
        ];

        foreach ($criteria as $item) {
            SawCriteria::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
