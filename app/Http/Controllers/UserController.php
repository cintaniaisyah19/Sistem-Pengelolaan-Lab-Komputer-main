<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NotifikasiUser;


class UserController extends Controller
{
    public function index()
    {
        $riwayat_peminjaman = Peminjaman::where('user_id', Auth::id())
            ->with('laboratorium')
            ->latest()
            ->get();

                // Ambil notifikasi yang belum dibaca
    $notifikasi = NotifikasiUser::where('user_id', Auth::id())
        ->where('status', 0)
        ->first(); // ambil satu notifikasi saja

            

        return view('user.index', [
            'riwayat_peminjaman' => $riwayat_peminjaman,
            'available_lab' => Laboratorium::where('status', 'tersedia')->get(),
        'notifikasi' => $notifikasi, // kirim notifikasi ke view
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'alat_id' => 'required',
        'tgl_pinjam' => 'required',
        'tgl_kembali' => 'required',
    ]);

    Peminjaman::create([
        'user_id' => auth()->id(), // otomatis user login
        'alat_id' => $request->alat_id,
        'tgl_pinjam' => $request->tgl_pinjam,
        'tgl_kembali' => $request->tgl_kembali,
        'status_peminjaman' => 'pending',
    ]);

    return redirect()->route('user.peminjaman.index')->with('success', 'Peminjaman berhasil diajukan!');
}

public function bukti($id)
{
    $peminjaman = Peminjaman::with('alat', 'laboratorium', 'staf')
        ->where('user_id', Auth::id())
        ->where('status', 'disetujui') // pastikan sudah divalidasi
        ->findOrFail($id);

    return view('user.bukti', compact('peminjaman'));
}
}