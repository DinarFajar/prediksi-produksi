@extends('layouts.app')

@section('title', 'Edit Nilai Produksi')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Produksi</h1>

    <div class="card shadow mb-4">
      <div class="card-header card-header-cs py-0 d-flex align-items-center">
        <div class="back-icon py-3" title="Kembali" onclick="location.assign('{{ route('produksi.index') }}')">
          <i class="fas fw fa-arrow-left"></i>
        </div>
        <h6 class="m-0 ml-1 font-weight-bold text-primary">Edit Nilai Produksi</h6>
      </div>
      <div class="card-body">

        <x-validation-errors />

        <form action="{{ route('produksi.update', ['produksi' => $produksi->id]) }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group row">
            <label for="tanggal" class="col-sm-2 col-form-label"><b>Tanggal</b></label>
            <div class="col-sm-10">
              <input id="tanggal" class="form-control-plaintext" type="date" name="tanggal" value="{{ $produksi->prediksi->permintaan->tanggal }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="permintaan" class="col-sm-2 col-form-label"><b>Permintaan</b></label>
            <div class="col-sm-10">
              <input id="permintaan" class="form-control-plaintext" type="number" name="permintaan" value="{{ $produksi->prediksi->permintaan->permintaan }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="sisa" class="col-sm-2 col-form-label"><b>Sisa</b></label>
            <div class="col-sm-10">
              <input id="sisa" class="form-control-plaintext" type="number" name="sisa" value="{{ $produksi->prediksi->permintaan->sisa }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="kekurangan" class="col-sm-2 col-form-label"><b>Kekurangan</b></label>
            <div class="col-sm-10">
              <input id="kekurangan" class="form-control-plaintext" type="number" name="kekurangan" value="{{ $produksi->prediksi->permintaan->kekurangan }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="prediksi" class="col-sm-2 col-form-label"><b>Prediksi</b></label>
            <div class="col-sm-10">
              <input id="prediksi" class="form-control-plaintext" type="number" name="prediksi" value="{{ $produksi->prediksi->prediksi }}" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="produksi" class="col-sm-2 col-form-label"><b>Produksi</b></label>
            <div class="col-sm-2">
              <input id="produksi" class="form-control" type="number" name="produksi" value="{{ old('produksi', ($produksi->produksi !== 0 ? $produksi->produksi : '')) }}" autofocus required>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@endsection