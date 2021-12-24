@extends('layouts.pdf')

@section('title', "Rekap Hasil Prediksi Produksi")

@section('content')
  <h2 class="text-title">Rekap Hasil Prediksi Produksi</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Tanggal</th>
        <th>Permintaan</th>
        <th>Sisa</th>
        <th>Kekurangan</th>
        <th class="text-success">Prediksi</th>
        <th>Produksi</th>
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
          <td class="text-success">{{ $production->prediction }}</td>
          <td>{{ $production->production !== 0 ? $production->production : '' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection