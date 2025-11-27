@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Ajukan Peminjaman Alat</h4>

        <form action="{{ route('user.peminjamanalat.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Alat</label>
                <select name="alat_id" class="form-control" required>
                    @foreach($alat as $a)
                        <option value="{{ $a->id }}">{{ $a->nama_alat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tgl_pinjam" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Tanggal Kembali</label>
                <input type="date" name="tgl_kembali" class="form-control" required>
            </div>

            {{-- Status otomatis Pending --}}
            <input type="hidden" name="status_peminjaman" value="pending">

            <button class="btn btn-primary mt-3">Ajukan</button>

        </form>
    </div>
</div>
@endsection