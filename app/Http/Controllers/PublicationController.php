<?php
// app/Http/Controllers/PublicationController.php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\PublicationAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    // ══════════════════════════════════════════════════════════════
    // PENGAJU — index: riwayat pengajuan milik sendiri (S-04)
    // ══════════════════════════════════════════════════════════════
    public function index()
    {
        $userId = Auth::id();

        $publications = Publication::with('attachments')
            ->where('user_id', $userId)
            ->latest()
            ->paginate(10);

        $recentPublications = Publication::with('attachments')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'total' => Publication::where('user_id', $userId)->count(),
            'menunggu' => Publication::where('user_id', $userId)
                ->where('status', 'Menunggu Validasi')
                ->count(),
            'disetujui' => Publication::where('user_id', $userId)
                ->where('status', 'Disetujui')
                ->count(),
            'revisi' => Publication::where('user_id', $userId)
                ->where('status', 'Revisi')
                ->count(),
            'ditolak' => Publication::where('user_id', $userId)
                ->where('status', 'Ditolak')
                ->count(),
        ];

        return view('user.dashboard', compact(
            'publications',
            'recentPublications',
            'stats'
        ));
    }

    // Form pengajuan baru (S-03)
    public function create()
    {
        return view('user.ajukan-konten');
    }

    // Simpan pengajuan baru (FR-01, FR-02, FR-03, UR-01–UR-04)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:255',
            'jenis_konten'     => 'required|in:Prestasi Mahasiswa,Kegiatan Organisasi,Berita Akademik,Lainnya',
            'deskripsi'        => 'required|string|min:10',
            'tanggal_kegiatan' => 'nullable|date',
            'lampiran.*'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $publication = Publication::create([
            'user_id'          => Auth::id(),
            'judul'            => $validated['judul'],
            'jenis_konten'     => $validated['jenis_konten'],
            'deskripsi'        => $validated['deskripsi'],
            'objektif'         => '-',
            'media_target'     => ['Instagram'],
            'tanggal_kegiatan' => $validated['tanggal_kegiatan'] ?? null,
            'status'           => 'Menunggu Validasi',
        ]);

        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $path = $file->store('publications/attachments', 'public');

                PublicationAttachment::create([
                    'publication_id' => $publication->id,
                    'nama_file'      => $file->getClientOriginalName(),
                    'file_path'      => $path,
                    'tipe_file'      => strtolower($file->getClientOriginalExtension()),
                ]);
            }
        }

        return redirect()->route('publications.index')
            ->with('success', 'Pengajuan berhasil dikirim.');
    }

    // Detail pengajuan milik sendiri (S-05)
    public function show($id)
    {
        $publication = Publication::with(['attachments', 'feedback.items'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.revisi-konten', compact('publication'));
    }

    // ══════════════════════════════════════════════════════════════
    // ADMIN — daftar semua pengajuan (S-06)
    // ══════════════════════════════════════════════════════════════
    public function adminIndex(Request $request)
    {
        $query = Publication::with(['user', 'attachments'])->latest();

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter jenis konten
        if ($request->filled('jenis_konten')) {
            $query->where('jenis_konten', $request->jenis_konten);
        }

        // Search judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Filter tanggal
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('created_at', [
                $request->dari . ' 00:00:00',
                $request->sampai . ' 23:59:59',
            ]);
        }

        $publications = $query->paginate(10)->withQueryString();

        return view('publications.admin.index', compact('publications'));
    }

    // Detail pengajuan untuk admin (S-07)
    public function adminShow($id)
    {
        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Status pengajuan berhasil diperbarui.');
    }


    // Admin: update status (Setujui / Revisi / Tolak) — FR-03, UR-08, UR-09
    public function updateStatus(Request $request, $id)
    {
        $publication = Publication::findOrFail($id);

    $request->validate([
        'status'         => 'required|in:Disetujui,Revisi,Ditolak',
        'catatan_revisi' => 'required_if:status,Revisi|nullable|string',
    ], [
        'catatan_revisi.required_if' =>
            'Catatan revisi wajib diisi jika status adalah Revisi.',
    ]);

        $publication->update([
            'status'         => $request->status,
            'catatan_revisi' => $request->catatan_revisi,
            'reviewed_by'    => Auth::id(),
        ]);

        return redirect()->route('admin.publications.show', $id)
            ->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    // Admin: jadwalkan publikasi (F-07, UC-05, S-08)
    public function jadwalkan(Request $request, $id)
    {
        $publication = Publication::findOrFail($id);

        // Hanya bisa dijadwalkan jika sudah Disetujui
        if (!$publication->isDisetujui()) {
            return back()->with('error', 'Pengajuan harus berstatus Disetujui untuk dijadwalkan.');
        }

        $request->validate([
            'jadwal_publikasi' => [
                'required',
                'date',
                'after_or_equal:today', // tanggal tidak boleh lampau (SRS 3.1)
            ],
        ], [
            'jadwal_publikasi.required'        => 'Tanggal publikasi wajib diisi.',
            'jadwal_publikasi.after_or_equal'  => 'Tanggal publikasi tidak boleh sebelum hari ini.',
        ]);

        // Cek maks 3 konten per hari (SRS UC-05 A1 / S-08)
        $tglPublikasi = date('Y-m-d', strtotime($request->jadwal_publikasi));
        $jumlahHari   = Publication::whereDate('jadwal_publikasi', $tglPublikasi)
                            ->whereIn('status', ['Dijadwalkan', 'Dipublikasikan'])
                            ->count();

        if ($jumlahHari >= 3) {
            return back()->with('error',
                'Slot waktu ini sudah terisi. Maksimal 3 konten per hari. Silakan pilih tanggal lain.'
            );
        }

        $publication->update([
            'status'           => 'Dijadwalkan',
            'jadwal_publikasi' => $request->jadwal_publikasi,
            'reviewed_by'      => Auth::id(),
        ]);

        return redirect()->route('admin.publications.show', $id)
            ->with('success', 'Jadwal publikasi berhasil disimpan.');
    }

    // Download lampiran (pengaju hanya miliknya, admin semua)
    public function downloadAttachment($attachmentId)
    {
        $attachment  = PublicationAttachment::findOrFail($attachmentId);
        $publication = $attachment->publication;

        // Pengaju hanya boleh download lampiran miliknya sendiri
        if (!Auth::user()->isAdmin() && $publication->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return Storage::disk('public')->download(
            $attachment->file_path,
            $attachment->nama_file
        );
    }

     // Form revisi admin
public function showRevisiForm($id)
{
    $publication = Publication::with(['user', 'attachments'])
        ->findOrFail($id);

    return view('admin.form-revisi', compact('publication'));
}

    // Submit revisi admin
    public function submitRevisi(Request $request, $id)
    {
        $request->validate([
            'catatan_revisi' => 'required|string|max:1000',
        ]);

        $publication = Publication::findOrFail($id);

        $publication->update([
            'status' => 'Revisi',
            'catatan_revisi' => $request->catatan_revisi,
            'reviewed_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Revisi berhasil dikirim.');
    }
}