@extends('layouts.main')
@section('content')

<div class="card">
  <div class="card-body">

    <div class="d-flex justify-content-between mb-3">
      <h4 class="card-title mb-0">Peminjaman Saya</h4>
      <a href="{{ route('user.peminjamanalat.create') }}" class="btn btn-primary btn-rounded">+ Ajukan Peminjaman</a>
    </div>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Alat</th>
          <th>Tgl Pinjam</th>
          <th>Tgl Kembali</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>
        @foreach($peminjaman as $p)
          <tr>
            <td>{{ $p->alat->nama_alat ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($p->tgl_kembali)->format('d M Y') }}</td>
            <td>
              @if ($p->status_peminjaman == 'pending')
                <span class="btn btn-sm btn-warning btn-rounded">Pending</span>
              @elseif ($p->status_peminjaman == 'disetujui')
                <span class="btn btn-sm btn-success btn-rounded">Disetujui</span>
              @elseif ($p->status_peminjaman == 'ditolak')
                <span class="btn btn-sm btn-danger btn-rounded">Ditolak</span>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>

    </table>
  </div>
</div>

@endsection