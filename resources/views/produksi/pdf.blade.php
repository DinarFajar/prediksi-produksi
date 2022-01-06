@extends('layouts.pdf')

@section('title', "Rekap Hasil Produksi")

@section('content')
  <h2 class="text-title">Rekap Hasil Produksi</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Tanggal</th>
        <th>Permintaan</th>
        <th>Sisa</th>
        <th>Kekurangan</th>
        <th>Prediksi</th>
        <th>Produksi</th>
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
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection