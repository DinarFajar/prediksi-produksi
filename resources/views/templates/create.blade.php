@extends('layouts.app')

@section('title', 'Tambah Template')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Template</h1>

    <div class="card shadow mb-4">
      <div class="card-header card-header-cs py-0 d-flex align-items-center">
        <div class="back-icon py-3" title="kembali" onclick="location.assign('{{ route('templates.index') }}')">
          <i class="fas fw fa-arrow-left"></i>
        </div>
        <h6 class="m-0 ml-1 font-weight-bold text-primary">Tambah Template Baru</h6>
      </div>
      <div class="card-body">

        <x-validation-errors />

        <form action="{{ route('templates.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="name"><b>Nama</b></label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" autofocus>
          </div>
          
          {{-- <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label"><b>Nama</b></label>
            <div class="col-sm-10">
              <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" autofocus>
            </div>
          </div> --}}
          <button class="btn btn-primary" type="submit">Tambah</button>
        </form>
      </div>
    </div>
  </div>
@endsection