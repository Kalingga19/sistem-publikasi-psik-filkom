<?php
// database/migrations/2026_05_15_000002_create_publication_attachments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publication_attachments', function (Blueprint $table) {
            $table->id();

            // Relasi ke publications (cascade delete — aturan integritas SRS 4.3.5)
            $table->foreignId('publication_id')
                ->constrained('publications')
                ->onDelete('cascade');

            $table->string('nama_file');        // nama asli file
            $table->string('file_path');        // path di storage
            $table->enum('tipe_file', ['pdf', 'jpg', 'jpeg', 'png']); // FR-01

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publication_attachments');
    }
};