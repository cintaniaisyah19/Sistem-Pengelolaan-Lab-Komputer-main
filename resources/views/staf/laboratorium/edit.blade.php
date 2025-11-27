@extends('layouts.main')
@section('title', 'Edit Data Laboratorium')

@section('content')
<div class="content-wrapper">

  <!-- Page Title Header -->
  <div class="row page-title-header">
    <div class="col-12">
      <div class="page-header">
        <h3 class="page-title">Edit Data Laboratorium</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('staf.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('staf.laboratorium.index') }}">Data Laboratorium</a></li>
              <li class="breadcrumb-item active">Edit Data</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <!-- Form -->
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Form Edit Data Laboratorium</h4>
      <p class="card-description">Pastikan semua input sudah benar</p>

      <form method="POST" action="{{ route('staf.laboratorium.update', $laboratorium->id) }}" enctype="multipart/form-data" class="forms-sample">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="nama">Nama Laboratorium</label>
          <input type="text" name="nama" id="nama" class="form-control"
                 value="{{ old('nama', $laboratorium->nama_lab) }}" required>
        </div>

        <div class="form-group">
          <label for="status">Status</label>
          <select name="status" id="status" class="form-control" required>
            <option value="tersedia" {{ $laboratorium->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="terpakai" {{ $laboratorium->status == 'terpakai' ? 'selected' : '' }}>Terpakai</option>
            <option value="maintenance" {{ $laboratorium->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
          </select>
        </div>

        <div class="form-group">
          <label for="foto">Foto Laboratorium</label>
          <input type="file" name="foto" class="form-control-file">
          
          @if($laboratorium->foto)
            <img src="{{ asset($laboratorium->foto) }}" class="img-thumbnail mt-2" width="150">
          @endif
        </div>

        <button type="submit" class="btn btn-success mr-2">Simpan</button>
        <a href="{{ route('staf.laboratorium.index') }}" class="btn btn-light">Cancel</a>
      </form>

    </div>
  </div>

</div>
@endsection
