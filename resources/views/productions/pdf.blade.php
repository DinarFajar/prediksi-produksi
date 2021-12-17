@extends('layouts.pdf')

@section('title', "Rekap Data Produksi")

@section('content')
  <h2 class="text-title">Rekap Data Produksi : Permintaan, Sisa, Kekurangan</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Tanggal</th>
        <th>Permintaan</th>
        <th>Sisa</th>
        <th>Kekurangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($productions as $production)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $production->created_at->format('Y-m-d') }}</td>
          <td>{{ $production->demand }}</td>
          <td>{{ $production->balance }}</td>
          <td>{{ $production->deficit }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection