@extends('layouts.app')

@section('title', 'Detail Template')

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Template</h1>

    <div class="card shadow mb-4">
      <div class="card-header card-header-cs py-0 d-flex align-items-center">
        <div class="back-icon py-3" title="kembali" onclick="location.assign('{{ route('templates.index') }}')">
          <i class="fas fw fa-arrow-left"></i>
        </div>
        <h6 class="m-0 ml-1 font-weight-bold text-primary mr-auto">Detail Template</h6>
        <form id="formDelete" action="{{ route('templates.destroy', ['template' => $template->id]) }}" method="POST">
          @method('DELETE')
          @csrf
          <a href="{{ route('templates.edit', ['template' => $template->id]) }}">Edit</a>
          <span class="mx-1 text-black-50">|</span>
          <a class="text-danger" href="{{ route('templates.destroy', ['template' => $template->id]) }}" onclick="deleteData()">Hapus</a>
        </form>
      </div>
      <div class="card-body">

        <x-alert-messages />

        <form>
          <div class="form-group">
            <label><b>Nama</b></label>
            <p>{{ $template->name }}</p>
          </div>
          <div class="form-group">
            <label><b>Terakhir Diperbarui</b></label>
            <p>{{ $template->updated_at->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB</p>
          </div>
          <div class="form-group">
            <label><b>Dibuat</b></label>
            <p>{{ $template->created_at->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB</p>
          </div>
          
          {{-- <div class="form-group row">
            <label class="col-sm-3"><b>Nama</b></label>
            <div class="col-sm-9">  
              <p>{{ $template->name }}</p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3"><b>Terakhir Diperbarui</b></label>
            <div class="col-sm-9">  
              <p>{{ $template->updated_at->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB</p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3"><b>Dibuat</b></label>
            <div class="col-sm-9">  
              <p>{{ $template->created_at->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB</p>
            </div>
          </div> --}}
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