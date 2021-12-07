@extends('layouts.app')

@section('title', 'Template')

@push('styles')
  <x-datatables type="styles" />
@endpush

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Template</h1>
    
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center">
        <h6 class="m-0 font-weight-bold text-primary mr-auto">Data Template</h6>
        <button class="btn btn-primary btn-sm" type="button" onclick="location.assign('{{ route('templates.create') }}')">Tambah Baru</button>
      </div>
      <div class="card-body">

        <x-alert-messages />

        <div class="table-responsive py-1 pr-1">
          <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($templates as $template)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $template->name }}</td>
                  <td>
                    <a href="{{ route('templates.show', ['template' => $template->id]) }}">lihat detail</a>
                    {{-- <form action="{{ route('templates.destroy', ['template' => $template->id]) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-light btn-sm" type="button" title="detail" onclick="location.assign('{{ route('templates.show', ['template' => $template->id]) }}')"><i class="fas fa-eye"></i></button>
                      <button class="btn btn-light btn-sm" type="button" title="edit" onclick="location.assign('{{ route('templates.edit', ['template' => $template->id]) }}')"><i class="fas fa-edit"></i></button>
                      <button class="btn btn-danger btn-sm" type="submit" title="hapus" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i></button>
                    </form> --}}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <x-datatables type="scripts" />
@endpush
