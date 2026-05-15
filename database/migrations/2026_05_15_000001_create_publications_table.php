<?php
// database/migrations/2026_05_15_000001_create_publications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');

            // Isi konten (FR-02, UR-01, UR-02)
            $table->string('judul', 255);
            $table->enum('jenis_konten', [
                'Prestasi Mahasiswa',
                'Kegiatan Organisasi',
                'Berita Akademik',
                'Lainnya'
            ]);
            $table->text('deskripsi');
            $table->text('objektif');

            // Target media (FR-02, UR-02) — disimpan sebagai JSON
            // contoh: ["Instagram", "Website FILKOM"]
            $table->json('media_target');

            // Tanggal kegiatan (opsional)
            $table->date('tanggal_kegiatan')->nullable();

            // Status pengajuan (FR-03, UR-08)
            $table->enum('status', [
                'Diajukan',
                'Menunggu Validasi',
                'Revisi',
                'Disetujui',
                'Ditolak',
                'Dijadwalkan',
                'Dipublikasikan'
            ])->default('Menunggu Validasi');

            // Catatan dari admin (UR-09)
            $table->text('catatan_revisi')->nullable();

            // Penjadwalan (F-07, UR-10)
            $table->dateTime('jadwal_publikasi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};