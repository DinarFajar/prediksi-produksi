@extends('layouts.app')

@section('title', 'Produksi')

@push('styles')
  <x-datatables type="styles" />
@endpush

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Produksi</h1>
    
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center">
        <h6 class="m-0 font-weight-bold text-primary mr-auto">Data Produksi</h6>
        <button class="btn btn-primary btn-sm" type="button" onclick="location.assign('{{ route('productions.create') }}')">Tambah</button>
      </div>
      <div class="card-body">

        <x-alert-messages />

        <div class="table-responsive py-1 pr-1">
          <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Permintaan</th>
                <th>Sisa</th>
                <th>Kekurangan</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($productions as $production)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $production->created_at }}</td>
                  <td>{{ $production->demand }}</td>
                  <td>{{ $production->balance }}</td>
                  <td>{{ $production->deficit }}</td>
                  <td><a href="{{ route('productions.show', ['production' => $production->id]) }}">lihat detail</a></td>
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
