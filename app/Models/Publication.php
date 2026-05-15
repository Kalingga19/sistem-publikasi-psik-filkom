<?php
// app/Models/Publication.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reviewed_by',
        'judul',
        'jenis_konten',
        'deskripsi',
        'objektif',
        'media_target',
        'tanggal_kegiatan',
        'status',
        'catatan_revisi',
        'jadwal_publikasi',
    ];

    protected $casts = [
        'media_target'     => 'array',   // JSON → array otomatis
        'tanggal_kegiatan' => 'date',
        'jadwal_publikasi' => 'datetime',
    ];

    // ── Relasi ──────────────────────────────────────────────────

    // Pengaju konten
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Admin yang mereview
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Lampiran (cascade delete sudah di migration)
    public function attachments()
    {
        return $this->hasMany(PublicationAttachment::class);
    }

    // ── Helper status ────────────────────────────────────────────

    public function isMenunggu(): bool
    {
        return $this->status === 'Menunggu Validasi';
    }

    public function isRevisi(): bool
    {
        return $this->status === 'Revisi';
    }

    public function isDisetujui(): bool
    {
        return $this->status === 'Disetujui';
    }

    public function isDitolak(): bool
    {
        return $this->status === 'Ditolak';
    }

    public function isDijadwalkan(): bool
    {
        return $this->status === 'Dijadwalkan';
    }

    // Warna badge per status (untuk view)
    public function badgeColor(): string
    {
        return match($this->status) {
            'Diajukan'           => 'secondary',
            'Menunggu Validasi'  => 'warning',
            'Revisi'             => 'warning',
            'Disetujui'          => 'success',
            'Ditolak'            => 'danger',
            'Dijadwalkan'        => 'info',
            'Dipublikasikan'     => 'purple',
            default              => 'secondary',
        };
    }
}