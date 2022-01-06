@extends('layouts.pdf')

@section('title', "Rekap Hasil Prediksi")

@section('content')
  <h2 class="text-title">Rekap Hasil Prediksi</h2>
  <table>
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
@endsection