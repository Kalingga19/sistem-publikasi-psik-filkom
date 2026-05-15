<?php
// app/Models/PublicationAttachment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PublicationAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'publication_id',
        'nama_file',
        'file_path',
        'tipe_file',
    ];

    // Relasi balik ke Publication
    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    // Helper: URL download lampiran
    public function getUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }
}