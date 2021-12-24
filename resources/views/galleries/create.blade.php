@extends('layouts.app')

@section('title', 'Upload Gambar')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Galeri</h1>

    <div class="card shadow mb-4">
      <div class="card-header card-header-cs py-0 d-flex align-items-center">
        <div class="back-icon py-3" title="kembali" onclick="location.assign('{{ route('galleries.index') }}')">
          <i class="fas fw fa-arrow-left"></i>
        </div>
        <h6 class="m-0 ml-1 font-weight-bold text-primary">Upload Gambar Baru</h6>
      </div>
      <div class="card-body">

        <x-validation-errors />

        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="picture"><b>File Gambar</b></label>
            <input id="picture" class="form-control-file" type="file" name="picture" accept="image/*" style="width: auto;" required>
          </div>
          <button class="btn btn-primary" type="submit">Upload</button>
        </form>
      </div>
    </div>
  </div>
@endsection