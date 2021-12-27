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

        <form id="formDeleteProductionValue" method="POST">
          @method('DELETE')
          @csrf
        </form>

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
                    @if($production->production !== 0)
                      <a href="{{ route('predictions.edit', ['production' => $production->id]) }}">Edit</a>
                      <span class="mx-1 text-black-50">|</span>
                      <a class="text-danger" href="{{ route('predictions.destroy', ['production' => $production->id]) }}" onclick="deleteProductionValue()">Hapus</a>
                    @else
                      <a href="{{ route('predictions.store', ['production' => $production->id]) }}" title="Menambahkan nilai prediksi ke produksi" onclick="openModalAddProductionValue()" data-action-url-manually="{{ route('predictions.storeManually', ['production' => $production->id]) }}" data-prediction-value="{{ $production->prediction }}">Tambah</a>
                    @endif
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
  <div class="modal" id="modalAddProductionValue" tabindex="-1" aria-labelledby="modalAddProductionValueLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center py-4">
          <p>Apakah anda ingin mengisi nilai produksi sesuai dengan <br>nilai prediksi <span id="textOfPredictionValue"></span> ?</p>
          <div>
            <form id="formAddProductionValue" method="POST">
              @csrf
              <button type="submit" class="btn btn-sm btn-primary">Ya</button>
              <button type="button" class="btn btn-sm btn-secondary" onclick="openModalAddProductionValueManually()">Tidak</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Add Production Value Manually -->
  <div class="modal" id="modalAddProductionValueManually" tabindex="-1" aria-labelledby="modalAddProductionValueManuallyLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAddProductionValueManuallyLabel">Masukkan Nilai Produksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formAddProductionValueManually" method="POST">
            @csrf
            <div class="form-group mb-0">
              <input class="form-control" type="number" name="production" autocomplete="off" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" form="formAddProductionValueManually">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <x-datatables type="scripts" />
  <script type="text/javascript">
    function openModalAddProductionValue() {
      event.preventDefault();

      $('#modalAddProductionValue').modal();
      
      const thisElement = event.target;

      document.getElementById('formAddProductionValue').action = thisElement.href;
      document.getElementById('formAddProductionValueManually').action = thisElement.dataset.actionUrlManually;
      document.getElementById('textOfPredictionValue').innerText = thisElement.dataset.predictionValue;

    }

    function openModalAddProductionValueManually() {
      $('#modalAddProductionValue').modal('hide');
      $('#modalAddProductionValueManually').modal();

      document.querySelector('#formAddProductionValueManually > div.form-group > input').focus();
    }

    function deleteProductionValue() {
      event.preventDefault();

      if(confirm('Anda yakin ingin menghapus nilai produksi ini?')) {
        const form = document.getElementById('formDeleteProductionValue');

        form.action = event.target.href;
        form.submit();
      } else {
        return false;
      }
    }
  </script>
@endpush
