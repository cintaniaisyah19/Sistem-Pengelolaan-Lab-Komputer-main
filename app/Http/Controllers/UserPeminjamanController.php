<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\NotifikasiUser;

class UserPeminjamanController extends Controller
{
    /**
     * Menampilkan daftar peminjaman milik user yang login
     */
    public function index()
    {
        $peminjaman = Peminjaman::where('user_id', auth()->id())
            ->orderBy('tgl_pinjam', 'desc')
            ->get();

                // Ambil notifikasi status peminjaman jika ada
    $notifKey = 'notifikasi_user_' . auth()->id();
    $notifikasi = session($notifKey);

        return view('user.peminjamanalat.index', compact('peminjaman'));
    }

    /**
     * Form tambah peminjaman alat
     */
    public function create()
    {
        $alat = Alat::all(); // semua alat ditampilkan

        return view('user.peminjamanalat.create', compact('alat'));
    }

    /**
     * Simpan peminjaman baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'alat_id'      => 'required|exists:alat,id',
            'tgl_pinjam'   => 'required|date',
            'tgl_kembali'  => 'required|date|after_or_equal:tgl_pinjam',
        ]);

         $alat = Alat::findOrFail($request->alat_id);

        Peminjaman::create([
            'user_id'            => auth()->id(),
            'alat_id'            => $request->alat_id,
            'lab_id'             => $alat->lab_id,
            'tgl_pinjam'         => $request->tgl_pinjam,
            'tgl_kembali'        => $request->tgl_kembali,
            'status_peminjaman'  => 'pending', // otomatis pending
        ]);

        return redirect()
            ->route('user.peminjamanalat.index')
            ->with('success', 'Peminjaman berhasil diajukan!');
    }
}