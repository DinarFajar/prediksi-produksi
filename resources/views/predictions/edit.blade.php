@extends('layouts.app')

@section('title', 'Edit Prediksi')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Prediksi</h1>

    <div class="card shadow mb-4">
      <div class="card-header card-header-cs py-0 d-flex align-items-center">
        <div class="back-icon py-3" title="kembali" onclick="location.assign('{{ route('predictions.index') }}')">
          <i class="fas fw fa-arrow-left"></i>
        </div>
        <h6 class="m-0 ml-1 font-weight-bold text-primary">Edit Nilai Produksi</h6>
      </div>
      <div class="card-body">

        <x-validation-errors />

        <form action="{{ route('predictions.update', ['production' => $production->id]) }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group row">
            <label for="demand" class="col-sm-2 col-form-label"><b>Permintaan</b></label>
            <div class="col-sm-10">
              <input id="demand" class="form-control-plaintext" type="number" name="demand" value="{{ $production->demand }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="balance" class="col-sm-2 col-form-label"><b>Sisa</b></label>
            <div class="col-sm-10">
              <input id="balance" class="form-control-plaintext" type="number" name="balance" value="{{ $production->balance }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="deficit" class="col-sm-2 col-form-label"><b>Kekurangan</b></label>
            <div class="col-sm-10">
              <input id="deficit" class="form-control-plaintext" type="number" name="deficit" value="{{ $production->deficit }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="prediction" class="col-sm-2 col-form-label"><b>Prediksi</b></label>
            <div class="col-sm-10">
              <input id="prediction" class="form-control-plaintext" type="number" name="prediction" value="{{ $production->prediction !== 0 ? $production->prediction : '' }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="production" class="col-sm-2 col-form-label"><b>Produksi</b></label>
            <div class="col-sm-2">
              <input id="production" class="form-control" type="number" name="production" value="{{ old('production', ($production->production !== 0 ? $production->production : '')) }}" autofocus required>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@endsection