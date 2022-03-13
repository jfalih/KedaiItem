@extends('layouts.user')
@section('content') 
  <!-- Page Sidebar Ends-->
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3>Ganti Password</h3>
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
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Ganti Password</h5>
              <span>Ganti password lama kamu dengan password baru disini.</span>
            </div>
            <div class="card-body">
              <form method="POST" action="{{route('change_password')}}">
                @csrf
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{session('error')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="row g-3 mb-3">
                  <div class="col-md-12">
                    <label class="form-label" >Password Lama</label>
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" >
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                  </div>
                  <div class="col-md-12">
                    <label class="form-label" >Password Baru</label>
                    <input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password" >
                    @error('new_password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                  </div>
                  <div class="col-md-12">
                    <label class="form-label" >Konfirmasi Password Baru</label>
                    <input class="form-control @error('c_password') is-invalid @enderror" type="password" name="c_password" >
                    @error('c_password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Ganti Password</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-12">

        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>   
@endsection