@extends('layouts.app')

@section('title', 'Edit Produksi')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Produksi</h1>

    <div class="card shadow mb-4">
      <div class="card-header card-header-cs py-0 d-flex align-items-center">
        <div class="back-icon py-3" title="kembali" onclick="location.assign('{{ route('productions.index') }}')">
          <i class="fas fw fa-arrow-left"></i>
        </div>
        <h6 class="m-0 ml-1 font-weight-bold text-primary">Edit Produksi</h6>
      </div>
      <div class="card-body">

        <x-validation-errors />

        <form action="{{ route('productions.update', ['production' => $production->id]) }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label for="demand"><b>Permintaan</b></label>
            <input id="demand" class="form-control" type="number" name="demand" value="{{ old('demand', $production->demand) }}" autofocus>
          </div>
          <div class="form-group">
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="balance_or_deficit" id="balance" value="balance" onchange="focusToValue()" onclick="focusToValue()" {{ old('balance_or_deficit', ($production->balance !== 0 ? 'balance' : null)) === 'balance' ? 'checked' : null }} required>
                <label class="form-check-label" for="balance"><b>Sisa</b></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="balance_or_deficit" id="deficit" value="deficit" onchange="focusToValue()" onclick="focusToValue()" {{ old('balance_or_deficit', ($production->deficit !== 0 ? 'deficit' : null)) === 'deficit' ? 'checked' : null }} required>
                <label class="form-check-label" for="deficit"><b>Kekurangan</b></label>
              </div>
            </div>
            <input id="balance_or_deficit_value" class="form-control" type="number" name="balance_or_deficit_value" value="{{ old('balance_or_deficit_value', ($production->balance !== 0 ? $production->balance : $production->deficit)) }}" required>
          </div>
          <button class="btn btn-primary" type="submit">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript">
    function focusToValue() {
      document.getElementById('balance_or_deficit_value').focus();
    }
  </script>
@endpush
