<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Inventory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'department' => 'IT Support',
        ]);

        // User
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'employee',
            'department' => 'Finance',
        ]);

        // Inventory for User
        Inventory::create([
            'user_id' => $user->id,
            'item_name' => 'Asus ROG Laptop',
            'description' => 'High performance laptop',
            'serial_number' => 'ROG-123456',
            'status' => 'good',
        ]);
        
        Inventory::create([
            'user_id' => $user->id,
            'item_name' => 'Epson L3110 Printer',
            'description' => 'Color printer',
            'serial_number' => 'EPS-987654',
            'status' => 'good',
        ]);

        $this->call([
            DepartmentSeeder::class,
            AssetCategorySeeder::class,
            SawCriteriaSeeder::class,
            SawSubCriteriaSeeder::class,
        ]);
    }
}
