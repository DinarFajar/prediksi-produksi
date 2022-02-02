@extends('layouts.app')

@section('title', 'Produksi')

@push('styles')
  <x-datatables type="styles" />
@endpush

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Produksi</h1>
    
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <button class="btn btn-primary btn-sm" type="button" onclick="location.assign('{{ route('produksi.print') }}')">Cetak</button>
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
                <th>Prediksi</th>
                <th>Produksi</th>
                @if(auth()->user()->role === 'ADMIN')
                  <th></th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($produksi as $p)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $p->prediksi->permintaan->tanggal }}</td>
                  <td>{{ $p->prediksi->permintaan->permintaan }}</td>
                  <td>{{ $p->prediksi->permintaan->sisa }}</td>
                  <td>{{ $p->prediksi->permintaan->kekurangan }}</td>
                  <td>{{ $p->prediksi->prediksi }}</td>
                  <td>{{ $p->produksi !== 0 ? $p->produksi : '' }}</td>
                  @if(auth()->user()->role === 'ADMIN')
                    <td>                      
                      @if($p->produksi !== 0)
                        <a href="{{ route('produksi.edit', ['produksi' => $p->id]) }}">Edit</a>
                        <span class="mx-1 text-black-50">|</span>
                        <a class="text-danger" href="{{ route('produksi.destroy', ['produksi' => $p->id]) }}" onclick="deleteProductionValue()">Hapus</a>
                      @else
                        <a href="{{ route('produksi.store', ['produksi' => $p->id]) }}" title="Menambahkan nilai prediksi ke produksi" onclick="openModalAddProductionValue()" data-action-url-manually="{{ route('produksi.storeManually', ['produksi' => $p->id]) }}" data-prediction-value="{{ $p->prediksi->prediksi }}">Tambah</a>
                      @endif
                    </td>
                  @endif
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
              <input class="form-control" type="number" name="produksi" autocomplete="off" required>
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
      
      const currentElement = event.currentTarget;

      document.getElementById('formAddProductionValue').action = currentElement.href;
      document.getElementById('formAddProductionValueManually').action = currentElement.dataset.actionUrlManually;
      document.getElementById('textOfPredictionValue').innerText = currentElement.dataset.predictionValue;

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

        form.action = event.currentTarget.href;
        form.submit();
      } else {
        return false;
      }
    }
  </script>
@endpush
