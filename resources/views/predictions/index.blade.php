@extends('layouts.app')

@section('title', 'Prediksi')

@push('styles')
  <x-datatables type="styles" />
@endpush

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Prediksi</h1>
    
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center">
        <h6 class="m-0 font-weight-bold text-primary mr-auto">Data Prediksi</h6>
        <button class="btn btn-primary btn-sm" type="button" onclick="location.assign('{{ route('predictions.print') }}')">Cetak</button>
      </div>
      <div class="card-body">

        <x-alert-messages />
        <x-validation-errors />

        <div class="table-responsive py-1 pr-1">
          <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Permintaan</th>
                <th>Sisa</th>
                <th>Kekurangan</th>
                <th>Produksi</th>
                <th class="text-success">Prediksi</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($productions as $production)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $production->created_at->format('Y-m-d H:i') }}</td>
                  <td>{{ $production->demand }}</td>
                  <td>{{ $production->balance }}</td>
                  <td>{{ $production->deficit }}</td>
                  <td>{{ $production->production !== 0 ? $production->production : '' }}</td>
                  <td class="text-success">{{ $production->prediction !== 0 ? $production->prediction : '' }}</td>
                  <td>
                    <form action="{{ route('predictions.destroy', ['production' => $production->id]) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      
                      @if($production->production !== 0)
                        <a href="{{ route('predictions.edit', ['production' => $production->id]) }}">Edit</a>
                        <span class="mx-1 text-black-50">|</span>
                        <a class="text-danger" href="{{ route('predictions.destroy', ['production' => $production->id]) }}" onclick="deleteData()">Hapus</a>
                      @else
                        <a href="javascript:void(0)" title="Menambahkan nilai prediksi ke produksi" onclick="openModalAddProduction('{{ route('predictions.store', ['production' => $production->id]) }}', '{{ route('predictions.storeManually', ['production' => $production->id]) }}', {{ $production->prediction }})">Tambah</a>
                      @endif
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Add Production Value -->
  <div class="modal" id="addProductionVal" tabindex="-1" aria-labelledby="addProductionValLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center py-5">
          <p>Apakah anda ingin mengisi nilai produksi sesuai dengan <br>nilai prediksi <span id="textOfPredictionVal"></span> ?</p>
          <div>
            <form id="formAddProdVal" method="POST">
              @csrf
              <button type="submit" class="btn btn-sm btn-primary">Ya</button>
              <button type="button" class="btn btn-sm btn-secondary" onclick="openModalAddProductionManually()">Tidak</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Add Production Value Manually -->
  <div class="modal" id="addProductionValManually" tabindex="-1" aria-labelledby="addProductionValManuallyLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductionValManuallyLabel">Masukkan Nilai Produksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formAddProdValManually" method="POST">
            @csrf
            <div class="form-group mb-0">
              <input class="form-control" type="number" name="production" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" form="formAddProdValManually">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <x-datatables type="scripts" />
  <script type="text/javascript">
    function openModalAddProduction(actionURL, actionURLManually, valOfPrediction) {
      document.getElementById('formAddProdVal').action = actionURL;
      document.getElementById('formAddProdValManually').action = actionURLManually;
      document.getElementById('textOfPredictionVal').innerText = valOfPrediction;

      $('#addProductionVal').modal();
    }

    function openModalAddProductionManually() {
      $('#addProductionVal').modal('hide');
      $('#addProductionValManually').modal();

      document.querySelector('#formAddProdValManually > div > input').focus();
    }

    function deleteData() {
      event.preventDefault();

      if(confirm('Anda yakin ingin menghapus nilai produksi ini?')) {
        event.target.closest('form').submit();
      } else {
        return false;
      }
    }
  </script>
@endpush
