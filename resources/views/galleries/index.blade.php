@extends('layouts.app')

@section('title', 'Galeri')

@push('styles')
  <link rel="stylesheet" href="{{ asset('vendor/VenoBox-master/dist/venobox.min.css') }}" type="text/css" media="screen" />
@endpush

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Galeri</h1>
    
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center justify-content-end">
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{ route('galeri.create') }}">Upload Gambar</a>
            <a class="dropdown-item" href="{{ route('galeri.all') }}">Hapus</a>
          </div>
        </div>
      </div>
      <div class="card-body">

        <x-alert-messages />

        <div class="row">
          @foreach($galleries as $gallery)
            <div class="col-sm-3 mb-4">
              <a class="my-image-links" data-gall="gallery01" data-maxwidth="600px" href="{{ $gallery->fullUrl() }}" title="{{ $gallery->filename }}">
                <img class="img-fluid" src="{{ $gallery->fullUrl() }}" loading="lazy">
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('vendor/VenoBox-master/dist/venobox.min.js') }}"></script>
  <script type="text/javascript">
    new VenoBox({
      selector: '.my-image-links'
    });
  </script>
@endpush
