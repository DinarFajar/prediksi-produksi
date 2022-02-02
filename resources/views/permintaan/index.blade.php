@extends('layouts.app')

@section('title', 'Permintaan')

@push('styles')
  <x-datatables type="styles" />
@endpush

@section('content')
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Permintaan</h1>
    
    <div class="card shadow mb-4">
      @if(auth()->user()->role === 'ADMIN')
        <div class="card-header py-3">
          <button class="btn btn-primary btn-sm" type="button" onclick="location.assign('{{ route('permintaan.create') }}')">Tambah Baru</button>
        </div>
      @endif
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
                @if(auth()->user()->role === 'ADMIN')
                  <th></th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($permintaan as $p)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $p->tanggal }}</td>
                  <td>{{ $p->permintaan }}</td>
                  <td>{{ $p->sisa }}</td>
                  <td>{{ $p->kekurangan }}</td>
                  @if(auth()->user()->role === 'ADMIN')
                    <td>
                      <form action="{{ route('permintaan.destroy', ['permintaan' => $p->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <a href="{{ route('permintaan.edit', ['permintaan' => $p->id]) }}">Edit</a>
                        <span class="mx-1 text-black-50">|</span>
                        <a class="text-danger" href="{{ route('permintaan.destroy', ['permintaan' => $p->id]) }}" onclick="deleteData()">Hapus</a>
                      </form>
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
@endsection

@push('scripts')
  <x-datatables type="scripts" />
  <script type="text/javascript">
    function deleteData() {
      event.preventDefault();

      if(confirm('Anda yakin ingin menghapus data ini?')) {
        event.currentTarget.closest('form').submit();
      } else {
        return false;
      }
    }
  </script>
@endpush
