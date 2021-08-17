@extends('layouts.app')

@section('main')
<main class="page-wrapper">
    <!-- Navbar 3 Level (Light)-->
    @include('components.headers.default')
    <div class="container py-4 py-lg-5 my-4">
      <div class="row">
        <div class="col-md-6 offset-md-3 pt-4 mt-3 mt-md-0">
          <h2 class="h4 mb-3">Ingin mulai bertransaksi?</h2>
          <p class="fs-sm text-muted mb-4">Buat akunmu untuk memulai transaksi di {{config('app.name')}}.</p>
          <form method="POST" action="{{route('register')}}" class="needs-validation" novalidate>
            @csrf
            <div class="row gx-4 gy-3">
            <div class="col-sm-12">
                <label class="form-label" for="reg-name">Nama Lengkap</label>
                <div class="input-group">
                    <i class="ci-user position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                    <input class="form-control @error('name') is-invalid @enderror rounded-start" name="name" id="reg-name" type="text" placeholder="Nama Lengkap" required="">
                </div>
                @error('name')
                <div class="form-text text-danger">{{$message}}</div>
                @enderror
            </div>
              <div class="col-sm-12">
                <label class="form-label" for="reg-fn">Alamat email</label>
                <div class="input-group">
                    <i class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                    <input class="form-control rounded-start" name="email" id="reg-fn" type="email" placeholder="Email" required="">
                </div>
                @error('email')
                <div class="form-text text-danger">{{$message}}</div>
                @enderror
              </div>
              <div class="col-sm-12">
                <label class="form-label" for="reg-hp">Nomor Handphone</label>
                <div class="input-group">
                    <i class="ci-phone position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                    <input class="form-control rounded-start" id="reg-hp" type="number" placeholder="Nomor Handphone" required="">
                </div>
                @error('nomorhp')
                <div class="form-text text-danger">{{$message}}</div>
                @enderror
              </div>
              
              <div class="col-sm-12">
                <label class="form-label" for="reg-pw">Password</label>
                <div class="input-group">
                    <i class="ci-locked position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                    <input class="form-control rounded-start" id="reg-pw" type="password" name="password" placeholder="Password" required="">
                    <label class="password-toggle-btn" aria-label="Show/hide password">
                        <input class="password-toggle-check" type="checkbox">
                        <span class="password-toggle-indicator"></span>
                    </label>
                </div>
                @error('password')
                <div class="form-text text-danger">{{$message}}</div>
                @enderror
              </div>
              <div class="col-sm-12">
                <label class="form-label" for="reg-pass">Konfirmasi Password</label>
                <div class="input-group">
                    <i class="ci-locked position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
                    <input class="form-control rounded-start" id="reg-pass" name="c_password" type="password" placeholder="Konfirmasi Password" required>
                    <label class="password-toggle-btn" aria-label="Show/hide password">
                        <input class="password-toggle-check" type="checkbox">
                        <span class="password-toggle-indicator"></span>
                    </label>
                </div>
                @error('c_password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
              </div>
              <div class="col-12 d-flex align-items-center justify-content-between">
                <span class="fs-sm">
                    Sudah punya akun?
                    <a class="nav-link-inline fs-sm" href="{{route('login')}}">Masuk</a>
                </span>
                <button class="btn btn-primary" type="submit"><i class="ci-add-user me-2 ms-n1"></i>Daftar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection