<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // Statistik untuk admin (S-06)
            $stats = [
                'total'        => Publication::count(),
                'menunggu'     => Publication::where('status', 'Menunggu Validasi')->count(),
                'disetujui'    => Publication::where('status', 'Disetujui')->count(),
                'ditolak'      => Publication::where('status', 'Ditolak')->count(),
                'dijadwalkan'  => Publication::where('status', 'Dijadwalkan')->count(),
                'dipublikasikan' => Publication::where('status', 'Dipublikasikan')->count(),
            ];

            $recentPublications = Publication::with('user')
                ->latest()
                ->take(5)
                ->get();

            return view('admin.dashboard', compact('stats', 'recentPublications'));
        }

        // Dashboard pengaju (S-02)
        $stats = [
            'total'       => Publication::where('user_id', $user->id)->count(),
            'menunggu'    => Publication::where('user_id', $user->id)
                                ->where('status', 'Menunggu Validasi')->count(),
            'revisi'      => Publication::where('user_id', $user->id)
                                ->where('status', 'Revisi')->count(),
            'disetujui'   => Publication::where('user_id', $user->id)
                                ->where('status', 'Disetujui')->count(),
            'ditolak'     => Publication::where('user_id', $user->id)
                                ->where('status', 'Ditolak')->count(),
        ];

        $recentPublications = Publication::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('stats', 'recentPublications'));
    }
}