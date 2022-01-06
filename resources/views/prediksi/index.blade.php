@extends('layouts.app')

@section('title', 'Prediksi')

@push('styles')
  <x-datatables type="styles" />
@endpush

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Prediksi</h1>
    
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <button class="btn btn-primary btn-sm" type="button" onclick="location.assign('{{ route('prediksi.print') }}')">Cetak</button>
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
                <th>Prediksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($prediksi as $p)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $p->permintaan->tanggal }}</td>
                  <td>{{ $p->permintaan->permintaan }}</td>
                  <td>{{ $p->permintaan->sisa }}</td>
                  <td>{{ $p->permintaan->kekurangan }}</td>
                  <td>{{ $p->prediksi }}</td>
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
