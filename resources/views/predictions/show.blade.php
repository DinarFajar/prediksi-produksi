@extends('layouts.app')

@section('title', 'Detail Prediksi')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Prediksi</h1>

    <div class="card shadow mb-4">
      <div class="card-header card-header-cs py-0 d-flex align-items-center">
        <div class="back-icon py-3" title="kembali" onclick="location.assign('{{ route('predictions.index') }}')">
          <i class="fas fw fa-arrow-left"></i>
        </div>
        <h6 class="m-0 ml-1 font-weight-bold text-primary mr-auto">Detail Prediksi</h6>
        <form id="formDelete" action="{{ route('predictions.destroy', ['production' => $production->id]) }}" method="POST">
          @method('DELETE')
          @csrf
          <a href="{{ route('predictions.edit', ['production' => $production->id]) }}">Edit</a>
          <span class="mx-1 text-black-50">|</span>
          <a class="text-danger" href="{{ route('predictions.destroy', ['production' => $production->id]) }}" onclick="deleteData()">Hapus</a>
        </form>
      </div>
      <div class="card-body">

        <x-alert-messages />

        <form>          
          <div class="form-group row">
            <label class="col-sm-2"><b>Permintaan</b></label>
            <div class="col-sm-10">  
              <p>{{ $production->demand }}</p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2"><b>Sisa</b></label>
            <div class="col-sm-10">  
              <p>{{ $production->balance }}</p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2"><b>Kekurangan</b></label>
            <div class="col-sm-10">  
              <p>{{ $production->deficit }}</p>
            </div>
          </div>
          <div class="form-group row text-success">
            <label class="col-sm-2"><b>Prediksi</b></label>
            <div class="col-sm-10">  
              <p>{{ $production->prediction }}</p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2"><b>Produksi</b></label>
            <div class="col-sm-10">  
              <p>{{ $production->production === 0 ? '' : $production->production }}</p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2"><b>Dibuat</b></label>
            <div class="col-sm-10">  
              <p>{{ $production->created_at->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB</p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2"><b>Diperbarui</b></label>
            <div class="col-sm-10">  
              <p>{{ $production->updated_at->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB</p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript">
    function deleteData() {
      event.preventDefault();

      if(confirm('Anda yakin ingin menghapus data ini?')) {
        document.getElementById('formDelete').submit();
      } else {
        return false;
      }
    }
  </script>
@endpush