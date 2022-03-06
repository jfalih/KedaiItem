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
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Request Payout</h5>
              <span>Request payout jika ada masalah silahkan hubungi admin.</span>
            </div>
            <div class="card-body">
              <form method="POST" action="{{route('reseller.payout.create')}}" class="needs-validation">
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
                    <label class="form-label" >Nominal</label>
                    <input class="form-control @error('nominal') is-invalid @enderror" placeholder="Nominal" type="number" name="nominal" required>
                    @error('nominal')
                        <small class="form-text text-danger">{{$message}}</small>
                    @else
                        <small class="form-text text-muted">Nominal minimal 30.000</small>
                    @enderror
                  </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <label class="form-label" for="exampleFormControlSelect9">Pilih pengiriman</label>
                        <select name="options" class="form-select digits @error('options') is-invalid @enderror" id="exampleFormControlSelect9">
                          <option value="not">Regular</option>
                          <option value="premium">Premium Rp{{number_format(App\Models\Setting::first()->harga,0,',','.')}}</option>
                        </select>
                        @error('options')
                            <small class="form-text text-danger">{{$message}}</small>
                        @else
                            <small class="form-text text-muted">Pilih pengiriman regular atau premium</small>
                        @enderror
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