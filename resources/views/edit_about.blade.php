@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Selamat Datang</h1>

    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header card-header-cs py-0 d-flex align-items-center">
        <div class="back-icon py-3" title="kembali" onclick="location.assign('{{ route('home') }}')">
          <i class="fas fw fa-arrow-left"></i>
        </div>
        <h6 class="m-0 ml-1 font-weight-bold text-primary">Edit Tentang Kami</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <form action="{{ route('home.update') }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <textarea id="about" class="form-control" name="about" rows="10">{!! old('about', ($company->about ?? null)) !!}</textarea>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
  <script type="text/javascript">
    CKEDITOR.replace('about', {
      tabSpaces: 4
    });
  </script>
@endpush