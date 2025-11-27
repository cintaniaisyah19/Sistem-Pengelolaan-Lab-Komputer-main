@extends('layouts.main')

@section('content')
<div class="card" style="width: 450px; margin: 20px auto; padding: 20px; border: 1px solid #000;">
    <h4 style="text-align: center; margin-bottom: 20px;">Bukti Peminjaman Alat</h4>

<p><strong>Nama Alat:</strong> {{ $peminjaman->alat->nama_alat ?? '-' }}</p>
<p><strong>Laboratorium:</strong> {{ $peminjaman->laboratorium->nama_lab ?? '-' }}</p>
<p><strong>Disetujui oleh:</strong> {{ $peminjaman->staf->name ?? '-' }}</p>
<p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tgl_pinjam }}</p>
<p><strong>Tanggal Kembali:</strong> {{ $peminjaman->tgl_kembali }}</p>
<p><strong>Status:</strong> {{ $peminjaman->status_peminjaman }}</p>


    <hr>
    <p style="text-align: center; font-size: 12px;">Terima kasih telah meminjam alat. Harap bawa bukti ini saat mengambil alat.</p>

    <div style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="padding: 8px 16px; font-size: 14px; cursor: pointer;">Cetak Bukti</button>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    .card, .card * {
        visibility: visible;
    }
    .card {
        margin: 0;
        border: none;
        width: 100%;
        box-shadow: none;
    }
    button {
        display: none;
    }
}
</style>
@endsection