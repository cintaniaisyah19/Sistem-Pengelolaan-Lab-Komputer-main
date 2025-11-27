@extends('layouts.main')
@section('title', 'Tambah Data Laboratorium')

@section('content')
<div class="content-wrapper">

  <!-- Page Title Header Starts-->
  <div class="row page-title-header">
    <div class="col-12">
      <div class="page-header">
        <h3 class="page-title">Tambah Data Laboratorium</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('staf.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('staf.laboratorium.index') }}">Data Laboratorium</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Data Laboratorium</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <!-- Form Card -->
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Form Tambah Data</h4>
      <p class="card-description">Pastikan anda memasukkan inputan dengan benar</p>

      <form class="forms-sample" method="POST" action="{{ route('staf.laboratorium.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label for="nama">Nama Laboratorium</label>
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Laboratorium" required>
        </div>

        <div class="form-group">
          <label for="status">Status Laboratorium</label>
          <select class="form-control" id="status" name="status" required>
            <option value="tersedia" selected>Tersedia</option>
            <option value="terpakai">Terpakai</option>
            <option value="maintenance">Maintenance</option>
          </select>
        </div>

        <div class="form-group">
          <label for="foto">Foto Laboratorium</label>
          <input type="file" class="form-control-file" id="foto" name="foto">
        </div>

        <button type="submit" class="btn btn-success mr-2">Tambah</button>
        <a href="{{ route('staf.laboratorium.index') }}" class="btn btn-light">Cancel</a>
      </form>
    </div>
  </div>

</div>
@endsection