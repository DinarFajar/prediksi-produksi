@extends('layouts.app')

@section('title', 'Tambah Permintaan')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Permintaan</h1>

    <div class="card shadow mb-4">
      <div class="card-header card-header-cs py-0 d-flex align-items-center">
        <div class="back-icon py-3" title="Kembali" onclick="location.assign('{{ route('permintaan.index') }}')">
          <i class="fas fw fa-arrow-left"></i>
        </div>
        <h6 class="m-0 ml-1 font-weight-bold text-primary">Tambah Baru</h6>
      </div>
      <div class="card-body">

        <x-validation-errors />

        <form action="{{ route('permintaan.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="tanggal"><b>Tanggal</b></label>
            <input id="tanggal" class="form-control" type="date" name="tanggal" value="{{ old('tanggal') }}" autofocus required>
          </div>
          <div class="form-group">
            <label for="permintaan"><b>Permintaan</b></label>
            <input id="permintaan" class="form-control" type="number" name="permintaan" value="{{ old('permintaan') }}" required>
          </div>
          <div class="form-group">
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input id="sisa" class="form-check-input" type="radio" name="sisa_or_kekurangan" value="sisa" onchange="focusToValue()" onclick="focusToValue()" {{ old('sisa_or_kekurangan') === 'sisa' ? 'checked' : null }} required>
                <label class="form-check-label" for="sisa"><b>Sisa</b></label>
              </div>
              <div class="form-check form-check-inline">
                <input id="kekurangan" class="form-check-input" type="radio" name="sisa_or_kekurangan" value="kekurangan" onchange="focusToValue()" onclick="focusToValue()" {{ old('sisa_or_kekurangan') === 'kekurangan' ? 'checked' : null }} required>
                <label class="form-check-label" for="kekurangan"><b>Kekurangan</b></label>
              </div>
            </div>
            <input id="sisa_or_kekurangan_value" class="form-control" type="number" name="sisa_or_kekurangan_value" value="{{ old('sisa_or_kekurangan_value') }}" required>
          </div>
          <button class="btn btn-primary" type="submit">Tambah</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript">
    function focusToValue() {
      document.getElementById('sisa_or_kekurangan_value').focus();
    }
  </script>
@endpush
