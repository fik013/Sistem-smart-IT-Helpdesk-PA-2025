<?php

namespace Database\Seeders;

use App\Models\AssetCategory;
use Illuminate\Database\Seeder;

class AssetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Network',
                'description' => '-',
                'weight' => '0.50',
            ],
            [
                'id' => 2,
                'name' => 'Server',
                'description' => '-',
                'weight' => '0.70',
            ],
        ];

        foreach ($categories as $category) {
            AssetCategory::updateOrCreate(['id' => $category['id']], $category);
        }
    }
}
