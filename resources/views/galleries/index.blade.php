@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Galeri</h1>
    
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center justify-content-end">
        <button class="btn btn-primary btn-sm" type="button" onclick="location.assign('{{ route('galleries.create') }}')">Upload Gambar</button>
      </div>
      <div class="card-body">

        <x-alert-messages />

        <div class="row">
          @foreach($galleries as $gallery)
            <div class="col-sm-3 mb-4">
              <img class="img-fluid" src="{{ $gallery->fullUrl() }}" loading="lazy">
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
