<?php

namespace Database\Seeders;

use App\Models\MediaPartner;
use Illuminate\Database\Seeder;

class MediaPartnerSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama'             => 'Himpunan Mahasiswa TI',
                'kategori'         => 'Organisasi Mahasiswa',
                'pic'              => 'Ahmad Fauzi',
                'email'            => 'hima.ti@ub.ac.id',
                'telepon'          => '0812-3456-7890',
                'website'          => 'https://himati.ub.ac.id',
                'alamat'           => 'Gedung Vokasi UB, Malang',
                'deskripsi'        => 'Himpunan Mahasiswa Teknik Informatika berfokus pada pengembangan soft skill dan hard skill mahasiswa di bidang teknologi informasi.',
                'status'           => 'aktif',
                'total_event'      => 5,
                'total_kolaborasi' => 8,
                'rating'           => 4.8,
            ],
            [
                'nama'             => 'Media Kampus UB',
                'kategori'         => 'Media & Jurnalistik',
                'pic'              => 'Siti Nurhaliza',
                'email'            => 'media@kampusub.com',
                'telepon'          => '0813-2345-6789',
                'website'          => 'https://mediakampusub.com',
                'alamat'           => 'Universitas Brawijaya, Malang',
                'deskripsi'        => 'Media kampus resmi Universitas Brawijaya yang meliput berbagai kegiatan akademik dan kemahasiswaan.',
                'status'           => 'aktif',
                'total_event'      => 3,
                'total_kolaborasi' => 6,
                'rating'           => 4.9,
            ],
            [
                'nama'             => 'PT Maju Bersama',
                'kategori'         => 'Perusahaan',
                'pic'              => 'Budi Santoso',
                'email'            => 'info@majubersama.com',
                'telepon'          => '0341-555-1234',
                'website'          => 'https://majubersama.com',
                'alamat'           => 'Jl. Sudirman No. 10, Malang',
                'deskripsi'        => 'Perusahaan teknologi yang bergerak di bidang pengembangan software dan konsultasi IT.',
                'status'           => 'pending',
                'total_event'      => 0,
                'total_kolaborasi' => 0,
                'rating'           => null,
            ],
            [
                'nama'             => 'Komunitas Kreatif MLG',
                'kategori'         => 'Komunitas',
                'pic'              => 'Dewi Lestari',
                'email'            => 'komunitas@kreatif.id',
                'telepon'          => '0812-9876-5432',
                'website'          => 'https://kreatifmlg.id',
                'alamat'           => 'Jl. Kawi No. 5, Malang',
                'deskripsi'        => 'Komunitas kreatif yang menghimpun seniman, desainer, dan content creator di Malang.',
                'status'           => 'aktif',
                'total_event'      => 7,
                'total_kolaborasi' => 12,
                'rating'           => 5.0,
            ],
            [
                'nama'             => 'UKM Sinematografi',
                'kategori'         => 'Organisasi Mahasiswa',
                'pic'              => 'Andi Wijaya',
                'email'            => 'ukm.sinema@ub.ac.id',
                'telepon'          => '0814-1111-2222',
                'website'          => 'https://ukmsinema.ub.ac.id',
                'alamat'           => 'Gedung Student Center UB, Malang',
                'deskripsi'        => 'Unit Kegiatan Mahasiswa bidang sinematografi dan film pendek tingkat universitas.',
                'status'           => 'aktif',
                'total_event'      => 4,
                'total_kolaborasi' => 9,
                'rating'           => 4.7,
            ],
            [
                'nama'             => 'Radar Malang',
                'kategori'         => 'Media & Jurnalistik',
                'pic'              => 'Rudi Hartono',
                'email'            => 'redaksi@radarmalang.id',
                'telepon'          => '0341-777-8888',
                'website'          => 'https://radarmalang.id',
                'alamat'           => 'Jl. Raya Langsep No. 14, Malang',
                'deskripsi'        => 'Koran lokal terbesar di Malang Raya yang aktif meliput berita pendidikan dan kampus.',
                'status'           => 'aktif',
                'total_event'      => 6,
                'total_kolaborasi' => 11,
                'rating'           => 4.9,
            ],
            [
                'nama'             => 'Himpunan Mahasiswa Akuntansi',
                'kategori'         => 'Organisasi Mahasiswa',
                'pic'              => 'Rizky Pratama',
                'email'            => 'hima.akuntansi@ub.ac.id',
                'telepon'          => '0815-3333-4444',
                'website'          => null,
                'alamat'           => 'Gedung Vokasi UB, Malang',
                'deskripsi'        => 'Himpunan mahasiswa akuntansi yang aktif mengadakan seminar keuangan dan perpajakan.',
                'status'           => 'aktif',
                'total_event'      => 3,
                'total_kolaborasi' => 5,
                'rating'           => 4.5,
            ],
            [
                'nama'             => 'CV Digital Nusantara',
                'kategori'         => 'Perusahaan',
                'pic'              => 'Hendra Gunawan',
                'email'            => 'hello@digitalnusantara.co.id',
                'telepon'          => '0816-5555-6666',
                'website'          => 'https://digitalnusantara.co.id',
                'alamat'           => 'Jl. Soekarno Hatta No. 25, Malang',
                'deskripsi'        => 'Perusahaan digital marketing dan branding yang melayani UMKM dan startup.',
                'status'           => 'pending',
                'total_event'      => 0,
                'total_kolaborasi' => 0,
                'rating'           => null,
            ],
        ];

        foreach ($data as $item) {
            MediaPartner::create($item);
        }
    }
}