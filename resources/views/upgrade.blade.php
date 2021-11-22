@extends('layouts.user')
@section('content')
@include('components.modals.tabungan')
@include('components.modals.ktp')
<section class="col-lg-12 pt-lg-4 pb-4 mb-3">
  <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
    <h2 class="h3 py-2 text-center text-sm-start">Syarat menjadi penjual</h2>
    <!-- Tabs-->
    <!-- List group with icons and badges -->
    <ul class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        @if(Auth::user()->email_verified_at === null)
        <span>
          <i class="ci-close-circle text-danger me-2"></i>
          Verifikasi alamat email
        </span>
        <form method="POST" action="{{route('verification.send')}}">
          @csrf
          <button type="submit" class="btn btn-primary">Verifikasi</button>
        </form>
        @else
        <span>
          <i class="ci-check-circle text-danger me-2"></i>
          Verifikasi alamat email
        </span>
        @endif
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        @if(Auth::user()->ktp_id != null && Auth::user()->selfie_id != null && Auth::user()->tabungan_verified_at == null)       
        <span>
          <i class="ci-announcement text-warning me-2"></i>
          Verifikasi akun dengan foto selfie dan ktp <b class="text-warning">(Dalam Proses)</b>
        </span>
        @elseif(Auth::user()->ktp_selfie_verified_at === null)
        <span>
          <i class="ci-close-circle text-danger me-2"></i>
          Verifikasi akun dengan foto selfie dan ktp
        </span>
        <button type="button" data-bs-toggle="modal" href="#ktpselfie" class="btn btn-primary">Verifikasi</button>
        @else
        <span>
          <i class="ci-check-circle text-danger me-2"></i>
          Verifikasi akun dengan foto selfie dan ktp
        </span>
        @endif  
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        @if(Auth::user()->tabungan_id != null && Auth::user()->tabungan_verified_at == null)
        <span>
          <i class="ci-announcement text-warning me-2"></i>
          Verifikasi foto buku tabungan <b class="text-warning">(Dalam Proses)</b>
        </span>
        @elseif(Auth::user()->tabungan_verified_at === null)
        <span>
          <i class="ci-close-circle text-danger me-2"></i>
          Verifikasi foto buku tabungan
        </span>
        <button type="button" data-bs-toggle="modal" href="#tabungan" class="btn btn-primary">Verifikasi</button>
        @else 
        <span>
          <i class="ci-check-circle text-danger me-2"></i>
          Verifikasi akun dengan foto selfie dan ktp
        </span>
        @endif  
      </li>
    </ul>
  </div>
</section>
@endsection