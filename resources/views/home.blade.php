@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Selamat Datang</h1>

    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tentang Kami</h6>
        @if(auth()->user()->role === 'ADMIN')
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="{{ route('home.edit') }}">Edit</a>
            </div>
          </div>
        @endif
      </div>
      <!-- Card Body -->
      <div class="card-body">

        <x-alert-messages />

        @if($company)
          {!! $company->about !!}
        @else
          <div class="my-5">
            <h2 class="mb-0 text-center">Selamat Datang</h2>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection