@extends('layouts.user')
@section('content')
  <h2 class="h3 py-2 text-center text-sm-start">Pengaturan</h2>
  <!-- Tabs-->
  <ul class="nav nav-tabs nav-justified" role="tablist">
    <li class="nav-item"><a class="nav-link px-0 active" href="#profile" data-bs-toggle="tab" role="tab">
        <div class="d-none d-lg-block"><i class="ci-user opacity-60 me-2"></i>Profil</div>
        <div class="d-lg-none text-center"><i class="ci-user opacity-60 d-block fs-xl mb-2"></i><span class="fs-ms">Profil</span></div></a></li>
    <li class="nav-item"><a class="nav-link px-0" href="#notifications" data-bs-toggle="tab" role="tab">
        <div class="d-none d-lg-block"><i class="ci-locked opacity-60 me-2"></i>Ganti Password</div>
        <div class="d-lg-none text-center"><i class="ci-locked opacity-60 d-block fs-xl mb-2"></i><span class="fs-ms">Ganti Password</span></div></a></li>
  </ul>
  <!-- Tab content-->
  <div class="tab-content">
    <!-- Profile-->
    <div class="tab-pane fade show active" id="profile" role="tabpanel">
      <div class="bg-secondary rounded-3 p-4 mb-4">
        <div class="d-flex align-items-center"><img class="rounded" src="@if(Auth::user()->profile != null) {{Storage::url(Auth::user()->profile->name)}} @else {{url('assets/img/marketplace/account/avatar.png')}} @endif" width="90" alt="@if(Auth::user()->profile != null) {{Auth::user()->profile->caption}} @else @endif">
          <div class="ps-3">
            <button href="#imagepicker-modal" data-bs-toggle="modal" class="btn btn-light btn-shadow btn-sm mb-2" type="button"><i class="ci-loading me-2"></i>Ganti <span class='d-none d-sm-inline'>foto profil</span></button>
            <div class="p mb-0 fs-ms text-muted">Upload dengan format JPG, JPEG dan PNG.</div>
          </div>
        </div>
      </div>
      <div class="row">
      @if(Auth::user()->email_verified_at == null)
      <div class="@if(Auth::user()->nomorhp_verified_at != null) col-sm-12 @endif">
        <div class="bg-danger rounded-3 p-4 mb-4">
          <p class="fs-sm text-white mb-2">Alamat email kamu belum terverifikasi.</p>
          <form method="POST" action="{{route('verification.send')}}">
            @csrf
            <button class="btn btn-light btn-shadow btn-sm" type="submit"><i class="ci-mail me-2"></i>Kirim verifikasi email</span></button>
          </form>
        </div>
      </div>
      @endif
      </div>
      <form method="POST" action="{{route('change_profile')}}" class="row gx-4 gy-3">
        @csrf
        <div class="col-sm-6">
          <label class="form-label" for="dashboard-fn">Nama Lengkap</label>
          <input class="form-control" name="name" type="text" id="dashboard-fn" value="{{Auth::user()->name}}">
        </div>
        <div class="col-sm-6">
          <label class="form-label" for="dashboard-profile-name">Username</label>
          <input class="form-control" name="username" type="text" id="dashboard-profile-name" value="{{Auth::user()->username}}">
        </div>
        <div class="col-sm-6">
          <label class="form-label" for="dashboard-email">Email address</label>
          <input class="form-control" type="text" id="dashboard-email" value="{{Auth::user()->email}}" disabled>
        </div>
        <div class="col-sm-6">
          <label class="form-label" for="dashboard-phone">Nomor Handphone</label>
          <input class="form-control" type="text" id="dashboard-phone" value="{{Auth::user()->nomorhp}}" disabled>
        </div>
        <div class="col-12">
          <hr class="mt-2 mb-4">
          <div class="d-sm-flex justify-content-between align-items-center">
            <button class="btn btn-primary mt-3 mt-sm-0" type="submit">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
    
    <div class="tab-pane fade" id="notifications" role="tabpanel">
      <form method="POST" action="{{route('change_password')}}" class="row gx-4 gy-3">
        @csrf
        <div class="col-sm-12">
          <label class="form-label" for="dashboard-fn">Password Lama</label>
          <input class="form-control" name="password" type="password" id="dashboard-fn" placeholder="Password Lama">
          <div class="form-text"><a href="">Lupa password?</a></div>
        </div>
        <div class="col-sm-12">
          <label class="form-label" for="dashboard-profile-name">Password Baru</label>
          <input class="form-control" name="new_password" type="password" id="dashboard-profile-name" placeholder="Password Baru"">
        </div>
        <div class="col-sm-12">
          <label class="form-label" for="dashboard-email">Konfirmasi Password Baru</label>
          <input class="form-control" name="c_password" type="password" id="dashboard-email" placeholder="Konfirmasi Password Baru">
        </div>
        
        <div class="col-12">
          <hr class="mt-2 mb-4">
          <div class="d-sm-flex justify-content-between align-items-center">
            <button class="btn btn-primary mt-3 mt-sm-0" type="submit">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection