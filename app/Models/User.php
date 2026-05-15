<?php

// app/Models/User.php
// Pastikan 'role' ada di $fillable

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Tambahkan 'role' ke dalam $fillable
     */
    protected $fillable = [
        'name',
        'nim', 
        'email',
        'password',
        'role', // <-- tambahkan ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods untuk cek role (opsional tapi berguna)
    |--------------------------------------------------------------------------
    */

    // Cek apakah user adalah admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Cek apakah user adalah user biasa
    public function isUser(): bool
    {
        return $this->role === 'user';
    }
}