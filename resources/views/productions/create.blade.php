@extends('layouts.app')

@section('title', 'Tambah Produksi')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Produksi</h1>

    <div class="card shadow mb-4">
      <div class="card-header card-header-cs py-0 d-flex align-items-center">
        <div class="back-icon py-3" title="kembali" onclick="location.assign('{{ route('productions.index') }}')">
          <i class="fas fw fa-arrow-left"></i>
        </div>
        <h6 class="m-0 ml-1 font-weight-bold text-primary">Tambah Produksi Baru</h6>
      </div>
      <div class="card-body">

        <x-validation-errors />

        <form action="{{ route('productions.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="demand"><b>Permintaan</b></label>
            <input id="demand" class="form-control" type="number" name="demand" value="{{ old('demand') }}" autofocus>
          </div>
          <div class="form-group">
            <label for="balance"><b>Sisa</b></label>
            <input id="balance" class="form-control" type="number" name="balance" value="{{ old('balance') }}">
          </div>
          <div class="form-group">
            <label for="deficit"><b>Kekurangan</b></label>
            <input id="deficit" class="form-control" type="number" name="deficit" value="{{ old('deficit') }}">
          </div>
          <button class="btn btn-primary" type="submit">Tambah</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript">
    const balance = document.getElementById('balance');
    const deficit = document.getElementById('deficit');

    document.body.onload = function() {
      if((balance.value.trim().length !== 0) && Number.isInteger(parseInt(balance.value))) {
        deficit.disabled = true;
      } else if((deficit.value.trim().length !== 0) && Number.isInteger(parseInt(deficit.value))) {
        balance.disabled = true;
      }
    };

    balance.addEventListener('keyup', function() {
      const value = this.value;
      if((value.trim().length !== 0) && Number.isInteger(parseInt(value))) {
        deficit.disabled = true;
      } else {
        deficit.disabled = false;
      }
    });

    deficit.addEventListener('keyup', function() {
      const value = this.value;
      if((value.trim().length !== 0) && Number.isInteger(parseInt(value))) {
        balance.disabled = true;
      } else {
        balance.disabled = false;
      }
    });
  </script>
@endpush