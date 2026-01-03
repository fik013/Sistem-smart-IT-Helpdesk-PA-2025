<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'id' => 1,
                'name' => 'Direktur',
                'weight' => '0.9000',
                'description' => '-',
            ],
            [
                'id' => 2,
                'name' => 'Divisi IT',
                'weight' => '0.5000',
                'description' => '-',
            ],
            [
                'id' => 3,
                'name' => 'Manager',
                'weight' => '0.6000',
                'description' => null,
            ],
            [
                'id' => 4,
                'name' => 'Divisi Desain',
                'weight' => '0.4000',
                'description' => '-',
            ],
            [
                'id' => 5,
                'name' => 'Divisi Customer Service',
                'weight' => '0.7000',
                'description' => '-',
            ],
            [
                'id' => 6,
                'name' => 'Divisi Marketing',
                'weight' => '0.3000',
                'description' => '-',
            ],
            [
                'id' => 7,
                'name' => 'Divisi Finance',
                'weight' => '0.3000',
                'description' => null,
            ],
            [
                'id' => 8,
                'name' => 'Divisi Hr',
                'weight' => '0.4000',
                'description' => '-',
            ],
        ];

        foreach ($departments as $department) {
            Department::updateOrCreate(['id' => $department['id']], $department);
        }
    }
}
