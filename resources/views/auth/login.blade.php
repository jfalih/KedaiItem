@extends('layouts.app')

@section('main')
<main class="page-wrapper">
    <!-- Navbar 3 Level (Light)-->
    @include('components.headers.default')
    <div class="container py-4 py-lg-5 my-4">
      <div class="row">
        <div class="col-md-6 offset-md-3 pt-4 mt-3 mt-md-0">
          <h2 class="h4 mb-3">Masuk ke akun untuk melanjutkan</h2>
          <p class="fs-sm text-muted mb-4">Silahkan masuk ke akunmu untuk melanjutkan transaksi di {{config('app.name')}}.</p>
          <form method="POST" action="{{route('login')}}" class="needs-validation" novalidate>
            @if(session('error_login'))
                <!-- Danger alert -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="fw-medium">Error:</span> {{session('error_login')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @csrf
            <div class="row gx-4 gy-3">
              <div class="col-sm-12">
                <label class="form-label" for="reg-fn">Alamat email</label>
                <div class="input-group">
                    <i class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                    <input class="form-control rounded-start" name="email" type="email" placeholder="Email" required>
                </div>
              </div>
              <div class="col-sm-12">
                <label class="form-label" for="reg-pass">Password</label>
                <div class="input-group">
                    <i class="ci-locked position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                    <input class="form-control rounded-start" name="password" type="password" placeholder="Password" required>
                </div>
              </div>
              <div class="d-flex flex-wrap justify-content-between">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" checked="" id="remember_me">
                  <label class="form-check-label" for="remember_me">Remember me</label>
                </div><a class="nav-link-inline fs-sm" href="">Forgot password?</a>
              </div>
              <div class="col-12 d-flex align-items-center justify-content-between">
                  <span class="fs-sm">
                    Belum punya akun?
                    <a class="nav-link-inline fs-sm" href="{{route('register')}}">Daftar</a>
                  </span>
                  <button class="btn btn-primary" type="submit"><i class="ci-sign-in me-2 ms-n1"></i>Masuk</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection