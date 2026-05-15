<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicationController;

// ── Halaman awal → login ────────────────────────────────────────
Route::get('/', fn() => redirect('/login'));

// ── Auth (guest) ────────────────────────────────────────────────
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register',[AuthController::class, 'register'])->name('register.process');

// ── Auth required ───────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard (admin → dashboard.admin | user → dashboard.user)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/user', [DashboardController::class, 'index'])->name('dashboard.user');

    // Profil
    Route::get('/profile/edit',  [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update',[UserController::class, 'updateProfile'])->name('profile.update');

    // ── Pengajuan Konten (Pengaju) ──────────────────────────────
    Route::prefix('pengajuan')->name('publications.')->group(function () {

        // S-04: Riwayat pengajuan milik sendiri
        Route::get('/',         [PublicationController::class, 'index'])->name('index');

        // S-03: Form pengajuan baru
        Route::get('/buat',     [PublicationController::class, 'create'])->name('create');

        // Simpan pengajuan baru
        Route::post('/',        [PublicationController::class, 'store'])->name('store');

        // S-05: Detail pengajuan milik sendiri
        Route::get('/{id}',     [PublicationController::class, 'show'])->name('show');

        // Download lampiran (pengaju hanya miliknya)
        Route::get('/lampiran/{attachmentId}/download',
            [PublicationController::class, 'downloadAttachment']
        )->name('attachment.download');

    });

    // ── Admin Only ──────────────────────────────────────────────
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

        // S-06: Semua pengajuan masuk
        Route::get('/pengajuan',
            [PublicationController::class, 'adminIndex'])->name('publications.index');

        // S-07: Detail + keputusan (setujui/revisi/tolak)
        Route::get('/pengajuan/{id}',
            [PublicationController::class, 'adminShow'])->name('publications.show');

        // FR-03: Update status (Setujui/Revisi/Tolak)
        Route::post('/pengajuan/{id}/status',
            [PublicationController::class, 'updateStatus'])->name('publications.status');

        // S-08: Jadwalkan publikasi
        Route::post('/pengajuan/{id}/jadwalkan',
            [PublicationController::class, 'jadwalkan'])->name('publications.jadwalkan');

        // Download lampiran (admin bisa semua)
        Route::get('/lampiran/{attachmentId}/download',
            [PublicationController::class, 'downloadAttachment']
        )->name('publications.attachment.download');
    });

});