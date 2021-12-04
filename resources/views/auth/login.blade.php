@extends('auth.app')

@push('styles')
  <style type="text/css">
    .bg-login-image {
      background: url("{{ asset('img/undraw_Login_re_4vu2.png') }}");
      background-position: center;
      background-size: contain;
      background-repeat: no-repeat;
    }
  </style>
@endpush

@section('title', 'Login')

@section('content')
  <!-- Outer Row -->
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Masuk ke Dashboard Panel</h1>
                </div>
                <x-alert-messages />
                <x-validation-errors />
                <form class="user" method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group">
                    <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email" value="{{ old('email') }}" autofocus required>
                  </div>
                  <div class="form-group">
                    <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" autocomplete="current-password" required>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                      <input name="remember" type="checkbox" class="custom-control-input" id="customCheck">
                      <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">LOG IN</button>
                </form>
                @if (Route::has('password.request'))
                  <hr>
                  <div class="text-center">
                    <a class="small" href="{{ route('password.request') }}">Lupa Password?</a>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection