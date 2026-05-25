<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $stats = [
                'total'          => Publication::count(),
                'menunggu'       => Publication::where('status', 'Menunggu Validasi')->count(),
                'disetujui'      => Publication::where('status', 'Disetujui')->count(),
                'ditolak'        => Publication::where('status', 'Ditolak')->count(),
                'dijadwalkan'    => Publication::where('status', 'Dijadwalkan')->count(),
                'dipublikasikan' => Publication::where('status', 'Dipublikasikan')->count(),
            ];

            $query = Publication::with('user')->latest();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', '%' . $search . '%')
                      ->orWhereHas('user', function ($q2) use ($search) {
                          $q2->where('name', 'like', '%' . $search . '%');
                      });
                });
            }

            $recentPublications = $query->take(10)->get();

            return view('admin.dashboard', compact('stats', 'recentPublications'));
        }

        // ── Dashboard User ──────────────────────────────────────
        $stats = [
            'total'     => Publication::where('user_id', $user->id)->count(),
            'menunggu'  => Publication::where('user_id', $user->id)->where('status', 'Menunggu Validasi')->count(),
            'revisi'    => Publication::where('user_id', $user->id)->where('status', 'Revisi')->count(),
            'disetujui' => Publication::where('user_id', $user->id)->where('status', 'Disetujui')->count(),
            'ditolak'   => Publication::where('user_id', $user->id)->where('status', 'Ditolak')->count(),
        ];

        $query = Publication::where('user_id', $user->id)->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('judul', 'like', '%' . $search . '%');
        }

        $recentPublications = $query->take(10)->get();

        return view('user.dashboard', compact('stats', 'recentPublications'));
    }
}