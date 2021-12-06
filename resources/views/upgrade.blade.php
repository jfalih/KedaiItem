@extends('layouts.user')
@section('content')
  @if(Auth::user()->upgrade)
    <section class="col-lg-12 pt-lg-4 pb-4 mb-3">
      <div class="d-sm-flex mb-4 flex-wrap justify-content-between align-items-center border-bottom">
        <h2 class="h3 py-2 me-2 text-center text-sm-start">Buat Toko</h2>
      </div>
      <!-- Accent alert -->
      <div class="alert alert-warning" role="alert">
        @if(App\Models\Setting::first())
        <h4 class="pt-2 alert-heading">Pembuatan Toko Di {{App\Models\Setting::first()->name}} Sedang Diverifikasi</h4>
        @else
        <h4 class="pt-2 alert-heading">Pembuatan Toko Di {{config('app.name')}} Sedang Diverifikasi</h4>    
        @endif
        <p>Pembuatan toko sedang diverifikasi oleh admin, jika sudah melebihi 2x24 jam silahkan laporkan ke customer service.</p>
      </div>
    </section>
  @else
    <section class="col-lg-12 pt-lg-4 pb-4 mb-3">
      <div class="d-sm-flex mb-4 flex-wrap justify-content-between align-items-center border-bottom">
        <h2 class="h3 py-2 me-2 text-center text-sm-start">Buat Toko</h2>
      </div>
      <!-- Accent alert -->
      <div class="alert alert-accent" role="alert">
        @if(App\Models\Setting::first())
        <h4 class="pt-2 alert-heading">Buka toko kamu di {{App\Models\Setting::first()->name}}</h4>
        @else
        <h4 class="pt-2 alert-heading">Buka toko kamu di {{config('app.name')}}</h4>    
        @endif
        <p>Harap isi terlebih dahulu form dibawah ini untuk memulai dagangan. Data kamu adalah rahasia dan privasi kamu hanya digunakan untuk verifikasi pembuatan toko.</p>
        <hr>
        <p class="pt-3 mb-2">Jangan berikan kepada siapapun kecuali melalui form ini.</p>
      </div>
      <div class="bg-secondary rounded-3 p-4 mb-3">
        <div class="d-flex align-items-center"><img class="rounded" src="@if(Auth::user()->profile != null) {{Storage::url(Auth::user()->profile->name)}} @else {{url('assets/img/marketplace/account/avatar.png')}} @endif" width="90" alt="@if(Auth::user()->profile != null) {{Auth::user()->profile->caption}} @else @endif">
          <div class="ps-3">
            <button href="#imagepicker-modal" data-bs-toggle="modal" class="btn btn-light btn-shadow btn-sm mb-2" type="button"><i class="ci-loading me-2"></i>Ganti <span class='d-none d-sm-inline'>foto profil</span></button>
            <div class="p mb-0 fs-ms text-muted">Upload dengan format JPG, JPEG dan PNG.</div>
          </div>
        </div>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{ route('upgrade.add') }}" class="row">
        @csrf
          <!-- Normal input -->
          <div class="mb-3">
            <label for="name-input" class="form-label">Nama Toko</label>
            <input class="form-control" type="text" name="nama_toko" id="name-input" placeholder="Nama Toko">
            <div class="form-text">Hanya dapat alfabet, angka, dan underscore. Dengan jumlah karakter 3-20, nama toko tidak dapat diganti.</div>
          </div>
          <div class="mb-3 col-sm-6">
            <label for="atas_nama-input" class="form-label">Atas Nama</label>
            <input class="form-control" type="text" name="atas_nama" id="atas_nama-input" placeholder="Atas Nama">
            <div class="form-text">Hanya dapat alfabet, dan spasi.</div>
          </div>
          <div class="mb-3 col-sm-6">
            <label for="rek-input" class="form-label">Nomor Rekening</label>
            <input class="form-control" type="text" name="nomor_rekening" id="rek-input" placeholder="Nomor Rekening">
            <div class="form-text">Hanya dapat angka.</div>
          </div>
          <div class="mb-3 col-12">
            <div class="row">
              <div class="col-md-4 col-sm-12">
                  <div class="file-drop-area mb-3">
                      <div class="file-drop-icon ci-cloud-upload"></div>
                      <span class="file-drop-message">
                      Upload ktp kamu disini.
                      </span>
                      <input class="file-drop-input" name="ktp" type="file">
                      <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                      <div class="form-text">
                        Ukuran maksimal 2MB, dengan format JPEG, JPG, PNG.
                      </div>
                  </div>
              </div>
              <div class="col-md-4 col-sm-12">
                  <div class="file-drop-area mb-3">
                      <div class="file-drop-icon ci-cloud-upload"></div>
                      <span class="file-drop-message">
                      Upload buku tabungan kamu disini.
                      </span>
                      <input class="file-drop-input" name="tabungan" type="file">
                      <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                      <div class="form-text">
                        Ukuran maksimal 2MB, dengan format JPEG, JPG, PNG.
                      </div>
                  </div>
              </div>
              <div class="col-md-4 col-sm-12">
                  <div class="file-drop-area mb-3">
                      <div class="file-drop-icon ci-cloud-upload"></div>
                      <span class="file-drop-message">
                      Upload selfie dan ktp kamu disini.
                      </span>
                      <input class="file-drop-input" name="selfie" type="file">
                      <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                      <div class="form-text">
                        Ukuran maksimal 2MB, dengan format JPEG, JPG, PNG dan GIF.
                      </div>
                  </div>
              </div>
            </div>
        </div>
        <div>
          <button type="reset" class="btn btn-secondary">
            <i class="ci-compare me-2"></i>
            Reset
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="ci-rocket me-2"></i>
            Buat Toko
          </button>
        </div>
      </form>
    </section>
  @endif
@endsection