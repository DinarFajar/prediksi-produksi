@extends('layouts.app')

@section('title', 'Pilih yang akan dihapus')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Galeri</h1>
    
    <div class="card shadow mb-4">
      <div class="card-header card-header-cs py-0 d-flex align-items-center">
        <div class="back-icon py-3" title="kembali" onclick="location.assign('{{ route('galleries.index') }}')">
          <i class="fas fw fa-arrow-left"></i>
        </div>
        <h6 class="m-0 ml-1 font-weight-bold text-primary">Hapus Gambar</h6>
      </div>
      <div class="card-body">

        <x-alert-messages />

        <form method="POST" onsubmit="deletePicture()">
          <div class="row">
            @method('DELETE')
            @csrf
            @foreach($galleries as $gallery)
              <div class="col-sm-3 mb-4">
                <div class="mb-2">  
                  <img class="img-fluid" src="{{ $gallery->fullUrl() }}" loading="lazy">
                </div>
                <div>
                  <button class="btn btn-sm btn-block btn-danger" type="submit" formaction="{{ route('galleries.destroy', ['gallery' => $gallery->id]) }}">Hapus</button>
                </div>
              </div>
            @endforeach
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript">
    function deletePicture() {
      if(confirm('Anda yakin ingin menghapus gambar ini?') === false) {
        event.preventDefault();
      }
    }
  </script>
@endpush
