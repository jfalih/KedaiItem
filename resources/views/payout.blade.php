@extends('layouts.user')
@section('content')
    <div class="d-sm-flex mb-4 flex-wrap justify-content-between align-items-center border-bottom">
      <h2 class="h3 py-2 me-2 text-center text-sm-start">Payouts (Penarikan Dana)</h2>
      <div class="py-2">
        <div class="d-flex flex-nowrap align-items-center pb-3">
          <!-- Launch default modal -->
          <form method="POST" action="{{route('reseller.payout')}}">
            @csrf
          <button class="btn btn-outline-secondary" type="submit" data-bs-toggle="offcanvas" data-bs-target="#filterRight">
            <i class="ci-dollar me-2"></i>Lakukan Penarikan Dana
          </button>
          </form>
        </div>
      </div>
    </div>
    <div class="row mx-n2 pt-2">
      <div class="col-md-4 col-sm-6 px-2 mb-4">
        <div class="bg-secondary h-100 rounded-3 p-4 text-center">
          <h3 class="fs-sm text-muted">Total Penarikan</h3>
          <p class="h2 mb-2">
            @php
              $jumlah = 0;
              foreach(\App\Models\Payout::get() as $pay){
                $jumlah += $pay->jumlah;
              }   
            @endphp
            Rp{{number_format($jumlah,2,',','.')}}
          </p>
          <p class="fs-ms text-muted mb-0">Penarikan Terakhir {{\App\Models\Payout::latest('created_at')->first()->created_at}}</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 px-2 mb-4">
        <div class="bg-secondary h-100 rounded-3 p-4 text-center">
          <h3 class="fs-sm text-muted">Saldo Kamu</h3>
          <p class="h2 mb-2">Rp{{Auth::user()->balance}}</p>
          <p class="fs-ms text-muted mb-0">Saldo pada {{\Carbon\Carbon::now()}}</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 px-2 mb-4">
        <div class="bg-secondary h-100 rounded-3 p-4 text-center">
          <h3 class="fs-sm text-muted">Jumlah Penarikan</h3>
          <p class="h2 mb-2">{{App\Models\Payout::count()}}</p>
          <p class="fs-ms text-muted mb-0">Total jumlah penarikan yang sudah kamu lakukan</p>
        </div>
      </div>
    </div>
    <!-- Products list-->
    <!-- Product-->
    <div class="table-responsive fs-md mb-4">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>Payout ID #</th>
            <th>Tanggal Payout</th>
            <th>Status</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          @forelse($payouts as $payout)
          <tr>
            <td class="py-3"><a class="nav-link-style fw-medium fs-sm" href="#order-details" data-bs-toggle="modal">{{$payout->id}}</a></td>
            <td class="py-3">{{$payout->created_at}}</td>
            <td class="py-3">@include('payout.status',['data' => $payout])</td>
            <td class="py-3">Rp{{number_format(Auth::user()->balance,2,',','.')}}</td>
          </tr>
          @empty
          <tr>
            <td colspan="5">Penarikan Dana Masih Kosong</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <!-- Pagination-->
    {{$payouts->links('components.paginations.default')}}
@endsection