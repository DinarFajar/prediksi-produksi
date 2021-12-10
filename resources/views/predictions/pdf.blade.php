<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Rekap Hasil Prediksi Produksi</title>
  </head>
  <body>
    <h4 class="mb-4 text-center">Rekap Hasil Prediksi Produksi</h4>
    <table class="table table-bordered">
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
            <td>{{ $production->created_at->format('Y-m-d H:i') }}</td>
            <td>{{ $production->demand }}</td>
            <td>{{ $production->balance }}</td>
            <td>{{ $production->deficit }}</td>
            <td class="text-success">{{ $production->prediction }}</td>
            <th>{{ $production->production }}</th>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>