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
            <h3>Pengaturan akun</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
              <li class="breadcrumb-item active">Pengaturan akun</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 col-sm-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Ganti Foto Profile</h5>
              <span>Ganti foto profile kamu dengan yang baru disini.</span>
            </div>
            <div class="card-body">
              <div id="alert"></div>
              <form method="post" enctype="multipart/form-data" class="dropzone digits dz-clickable" id="image-upload" action="{{route('change_avatar')}}">
                @csrf
                <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                  <h6>Upload foto profile disini.</h6>
                  <span class="note needsclick">Ganti foto profile kamu disini..</span>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-8 col-sm-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Pengaturan Akun</h5><span>Ganti pengaturan akun kamu disini seperti nama, verifikasi email dan lainnya.</span>
            </div>
            <div class="card-body">
              <form method="POST" action="{{route('change_profile')}}" class="needs-validation">
                @csrf
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="row g-3 mb-3">
                  <div class="col-md-12">
                    <label class="form-label" >Nama Lengkap</label>
                    <input class="form-control" type="text" name="name" required value="{{Auth::user()->name}}">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="text" value="{{Auth::user()->name}}" readonly>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="validationCustom02">Nomor Handphone</label>
                    <input class="form-control" id="validationCustom02" type="text" value="{{Auth::user()->nomorhp}}" readonly>
                    <div class="valid-feedback">Looks good!</div>
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