@extends('layouts.app')

@section('title', 'Tes Fuzzy Mamdani')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tes Fuzzy Mamdani</h1>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Input Variabel</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('fuzzy-mamdani') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="demand"><b>Permintaan</b></label>
            <input id="demand" class="form-control" type="number" name="demand" value="{{ isset($demand) ? $demand : '' }}" autofocus required>
          </div>
          <div class="form-group">
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="balance_or_deficit" id="balance" value="balance" onchange="focusToValue()" onclick="focusToValue()" {{ isset($balance_or_deficit) ? ($balance_or_deficit === 'balance' ? 'checked' : null) : null }} required>
                <label class="form-check-label" for="balance"><b>Sisa</b></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="balance_or_deficit" id="deficit" value="deficit" onchange="focusToValue()" onclick="focusToValue()" {{ isset($balance_or_deficit) ? ($balance_or_deficit === 'deficit' ? 'checked' : null) : null }} required>
                <label class="form-check-label" for="deficit"><b>Kekurangan</b></label>
              </div>
            </div>
            <input id="balance_or_deficit_value" class="form-control" type="number" name="balance_or_deficit_value" value="{{ isset($balance_or_deficit_value) ? $balance_or_deficit_value : '' }}" required>
          </div>
          <button class="btn btn-primary" type="submit">Proses</button>
        </form>
      </div>
    </div>

    @if(isset($fuzzyMamdani)) 
      <!-- Derajat Keanggotaan -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Derajat Keanggotaan</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-bordered text-center" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th colspan="3">Permintaan</th>
                  <th colspan="3">Sisa</th>
                  <th colspan="3">Kekurangan</th>
                </tr>
                <tr>
                  <td>Sedikit</td>
                  <td>Sedang</td>
                  <td>Banyak</td>
                  <td>Sedikit</td>
                  <td>Sedang</td>
                  <td>Banyak</td>
                  <td>Sedikit</td>
                  <td>Sedang</td>
                  <td>Banyak</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $fuzzyMamdani["Derajat Keanggotaan"]["Permintaan"]["Sedikit"] }}</td>
                  <td>{{ $fuzzyMamdani["Derajat Keanggotaan"]["Permintaan"]["Sedang"] }}</td>
                  <td>{{ $fuzzyMamdani["Derajat Keanggotaan"]["Permintaan"]["Banyak"] }}</td>
                  <td>{{ $fuzzyMamdani["Derajat Keanggotaan"]["Sisa"]["Sedikit"] }}</td>
                  <td>{{ $fuzzyMamdani["Derajat Keanggotaan"]["Sisa"]["Sedang"] }}</td>
                  <td>{{ $fuzzyMamdani["Derajat Keanggotaan"]["Sisa"]["Banyak"] }}</td>
                  <td>{{ $fuzzyMamdani["Derajat Keanggotaan"]["Kekurangan"]["Sedikit"] }}</td>
                  <td>{{ $fuzzyMamdani["Derajat Keanggotaan"]["Kekurangan"]["Sedang"] }}</td>
                  <td>{{ $fuzzyMamdani["Derajat Keanggotaan"]["Kekurangan"]["Banyak"] }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Implikasi -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Implikasi</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-bordered text-center" width="100%" cellspacing="0">
              <thead>
                <tr>
                  @foreach($fuzzyMamdani["Implikasi"] as $key => $value)
                    <th>{{ $key }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                <tr>
                  @foreach($fuzzyMamdani["Implikasi"] as $key => $value)
                    <td>{{ $value }}</td>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Rule Produksi -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Rule Produksi</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-bordered text-center" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th colspan="3">Sedikit</th>
                  <th colspan="10">Sisa</th>
                  <th colspan="5">Kekurangan</th>
                </tr>
                <tr>
                  @foreach($fuzzyMamdani["Rule Produksi"]["Sedikit"] as $key => $value)
                    <td>{{ $key }}</td>
                  @endforeach
                  @foreach($fuzzyMamdani["Rule Produksi"]["Sedang"] as $key => $value)
                    <td>{{ $key }}</td>
                  @endforeach
                  @foreach($fuzzyMamdani["Rule Produksi"]["Banyak"] as $key => $value)
                    <td>{{ $key }}</td>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                <tr>
                  @foreach($fuzzyMamdani["Rule Produksi"]["Sedikit"] as $key => $value)
                    <td>{{ $value }}</td>
                  @endforeach
                  @foreach($fuzzyMamdani["Rule Produksi"]["Sedang"] as $key => $value)
                    <td>{{ $value }}</td>
                  @endforeach
                  @foreach($fuzzyMamdani["Rule Produksi"]["Banyak"] as $key => $value)
                    <td>{{ $value }}</td>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Komposisi -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Komposisi</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-bordered text-center" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Sedikit</th>
                  <th>Sedang</th>
                  <th>Banyak</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $fuzzyMamdani["Komposisi"]["Sedikit"] }}</td>
                  <td>{{ $fuzzyMamdani["Komposisi"]["Sedang"] }}</td>
                  <td>{{ $fuzzyMamdani["Komposisi"]["Banyak"] }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Defuzzifikasi - Titik -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Defuzzifikasi - Titik</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-bordered text-center" width="100%" cellspacing="0">
              <thead>
                <tr>
                  @foreach($fuzzyMamdani["Defuzzifikasi"]["Titik"] as $key => $value)
                    <th>{{ $key }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                <tr>
                  @foreach($fuzzyMamdani["Defuzzifikasi"]["Titik"] as $key => $value)
                    <td>{{ $value }}</td>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Defuzzifikasi - Luas Bangunan -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Defuzzifikasi - Luas Bangunan</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-bordered text-center" width="100%" cellspacing="0">
              <thead>
                <tr>
                  @foreach($fuzzyMamdani["Defuzzifikasi"]["Luas Bangunan"] as $key => $value)
                    <th>{{ $key }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                <tr>
                  @foreach($fuzzyMamdani["Defuzzifikasi"]["Luas Bangunan"] as $key => $value)
                    <td>{{ $value }}</td>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Defuzzifikasi - Luas Momen -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Defuzzifikasi - Luas Momen</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-bordered text-center" width="100%" cellspacing="0">
              <thead>
                <tr>
                  @foreach($fuzzyMamdani["Defuzzifikasi"]["Luas Momen"] as $key => $value)
                    <th>{{ $key }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                <tr>
                  @foreach($fuzzyMamdani["Defuzzifikasi"]["Luas Momen"] as $key => $value)
                    <td>{{ $value }}</td>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Hasil Prediksi -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Hasil Prediksi</h6>
        </div>
        <div class="card-body">
          <div class="my-3 text-center">
            <p class="mb-0 h1">{{ $fuzzyMamdani["Hasil PREDIKSI"] }}</p>
            <p class="mb-0 my-4">dibulatkan menjadi</p>
            <p class="mb-0 h1">{{ $fuzzyMamdani["Hasil PREDIKSI (dibulatkan)"] }}</p>
          </div>
        </div>
      </div>
    @endif
  </div>
@endsection

@push('scripts')
  <script type="text/javascript">
    function focusToValue() {
      document.getElementById('balance_or_deficit_value').focus();
    }
  </script>
@endpush
