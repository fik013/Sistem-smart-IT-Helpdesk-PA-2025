<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;
use Carbon\Carbon;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Critical Announcement (Active)
        Announcement::create([
            'title' => 'Maintenance Server Darurat',
            'content' => 'Server akan mengalami downtime untuk pemeliharaan mendesak pada hari Jumat, jam 22:00 WIB. Mohon simpan pekerjaan Anda.',
            'type' => 'critical', // Penting
            'is_active' => true,
            'start_date' => Carbon::now()->subHour(), // Started 1 hour ago
            'end_date' => Carbon::now()->addDays(2), // Ends in 2 days
        ]);

        // 2. Warning Announcement (Active)
        Announcement::create([
            'title' => 'Pembaruan Kebijakan Password',
            'content' => 'Mulai minggu depan, semua pengguna diwajibkan mengganti password setiap 3 bulan sekali demi keamanan.',
            'type' => 'warning', // Sedang
            'is_active' => true,
            'start_date' => null, // Immediate
            'end_date' => null, // No expiration
        ]);

        // 3. Info Announcement (Active)
        Announcement::create([
            'title' => 'Selamat Datang di Sistem Baru',
            'content' => 'Halo semua! Kami baru saja memperbarui tampilan dashboard agar lebih user-friendly. Selamat bekerja!',
            'type' => 'info', // Biasa
            'is_active' => true,
            'start_date' => null,
            'end_date' => Carbon::now()->addMonth(),
        ]);

        // 4. Expired Announcement (Inactive via Date)
        Announcement::create([
            'title' => 'Pengumuman Lama',
            'content' => 'Ini adalah pengumuman yang sudah kadaluarsa dan tidak seharusnya tampil di dashboard user.',
            'type' => 'info',
            'is_active' => true,
            'start_date' => Carbon::now()->subMonth(),
            'end_date' => Carbon::now()->subDay(), // Expired yesterday
        ]);
        
        // 5. Inactive Announcement (Inactive via Status)
        Announcement::create([
            'title' => 'Draft Pengumuman',
            'content' => 'Pengumuman ini masih draft dan diset non-aktif.',
            'type' => 'info',
            'is_active' => false,
            'start_date' => null,
            'end_date' => null,
        ]);
    }
}
