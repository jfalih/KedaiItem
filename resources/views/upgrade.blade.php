@extends('layouts.user')
@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/dropzone.css')}}">
@endsection
@section('content') 
  <!-- Page Sidebar Ends-->
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3>Upgrade Akun</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
              <li class="breadcrumb-item active">Upgrade akun</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Ingin Jadi Penjual?</h5>
              <span>Isi formulir dibawah ini untuk mengupgrade akun kamu menjadi</span>
            </div>
            <div class="card-body">
            @if(Auth::user()->tabungan_id != null)
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              Proses verifikasi sudah diajukan pada {{Auth::user()->updated_at}}
            </div>
            @endif
              <form method="POST"  enctype="multipart/form-data" action="{{ route('upgrade.add') }}">
                @csrf
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <label class="form-label" >Nama Toko</label>
                    <input class="form-control @error('nama_toko') is-invalid @enderror" type="text" name="nama_toko" required>
                    @error('name')
                      <small class="form-text text-danger">{{$message}}</small>
                    @else
                    <small class="form-text text-muted">Hanya dapat alfabet, angka, dan underscore. Nama toko tidak dapat diganti.</small>
                    @endif
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Nomor Rekening</label>
                    <input class="form-control @error('nomor_rekening') is-invalid @enderror" name="nomor_rekening" type="number" >
                    @error('nomor_rekening')
                      <small class="form-text text-danger">{{$message}}</small>
                    @else
                    <small class="form-text text-muted">Hanya dapat memasukan angka. Nomor rekening harus sesuai dengan buku tabungan.</small>  
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Atas Nama</label>
                    <input class="form-control @error('atas_nama') is-invalid @enderror" name="atas_nama" type="text">
                    @error('atas_nama')
                      <small class="form-text text-danger">{{$message}}</small>
                    @else
                    <small class="form-text text-muted">Hanya dapat alfabet dan spasi. Atas nama harus sesuai dengan buku tabungan</small>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Foto Buku Tabungan</label>
                    <input class="form-control @error('tabungan') is-invalid @enderror" type="file" name="tabungan" >
                    @error('tabungan')
                      <small class="form-text text-danger">{{$message}}</small>
                    @else
                      <small class="form-text text-muted">Kami tidak akan menyebarkan data hanya digunakan untuk verifikasi.</small>
                    @endif
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Foto Ktp</label>
                    <input class="form-control @error('ktp') is-invalid @enderror" type="file" name="ktp">
                    @error('ktp')
                      <small class="form-text text-danger">{{$message}}</small>
                    @else  
                      <small class="form-text text-muted" id="ktp">Kami tidak akan menyebarkan data hanya digunakan untuk verifikasi.</small>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Foto Ktp + Selfie</label>
                    <input class="form-control @error('selfie') is-invalid @endif" type="file" name="selfie">
                    @error('selfie')
                      <small class="form-text text-danger">{{$message}}</small>
                    @else
                      <small class="form-text text-muted">Kami tidak akan menyebarkan data hanya digunakan untuk verifikasi.</small>
                    @endif
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>   
@endsection
@section('js')
@parent
<script src="{{asset('assets_users/assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets_users/assets/js/dropzone/dropzone-script.js')}}"></script>
<script type="text/javascript">
  Dropzone.options.imageUpload = {
      maxFilesize : 1,
      maxFiles: 1,
      url: "{{route('change_avatar')}}",
      init : function() {     
            this.on("success", function(file, response) {                               
              if(response.success) {
                $("#alert").html(`
                <div class="alert alert-success dark alert-dismissible fade show mb-3" role="alert">
                <span>${response.message}</span>
                </div>
                `)
              } else {
                $("#alert").html(`
                <div class="alert alert-danger dark alert-dismissible fade show mb-3" role="alert">
                <span>${response.message}</span>
                </div>
                `)
              }
            });  
            this.on("maxfilesexceeded", function(file){
              $("#alert").html(`
                <div class="alert alert-danger dark alert-dismissible fade show mb-3" role="alert">
                <span>Tidak bisa mengupload lebih dari 1 file</span>
                </div>
                `)
            });
      },
      acceptedFiles: ".jpeg,.jpg,.png,.gif"
  };
</script>
@endsection