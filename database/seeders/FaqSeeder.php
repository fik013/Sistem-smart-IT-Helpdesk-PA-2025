<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara mereset password email kantor?',
                'answer' => 'Anda dapat mereset password email kantor melalui portal self-service IT. Jika tidak bisa mengakses portal, silakan hubungi IT Helpdesk melalui ekstensi 1000 atau buat tiket baru.',
            ],
            [
                'question' => 'Fasilitas VPN apa yang tersedia untuk WFH?',
                'answer' => 'Kami menyediakan akses VPN menggunakan Cisco AnyConnect. Panduan instalasi dan konfigurasi dapat ditemukan di bagian Knowledge Base > Remote Access.',
            ],
            [
                'question' => 'Bagaimana cara request laptop baru?',
                'answer' => 'Permintaan laptop baru harus disetujui oleh manajer departemen Anda terlebih dahulu. Setelah disetujui, silakan buat tiket dengan kategori "Hardware Request" dan lampirkan form persetujuan.',
            ],
            [
                'question' => 'Apa yang harus dilakukan jika printer macet?',
                'answer' => 'Cek indikator layar printer untuk melihat pesan error. Jika kertas tersangkut, coba keluarkan secara perlahan. Jangan memaksa menarik kertas. Jika masalah berlanjut, laporkan ke IT Support.',
            ],
            [
                'question' => 'Berapa lama waktu respon untuk tiket Prioritas Tinggi?',
                'answer' => 'Tiket dengan prioritas "High" atau "Critical" memiliki SLA respon maksimal 1 jam dan target penyelesaian dalam 4 jam kerja.',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
