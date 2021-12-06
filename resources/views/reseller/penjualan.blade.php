@extends('layouts.user')
@section('content')
    <div class="d-sm-flex mb-4 flex-wrap justify-content-between align-items-center border-bottom">
      <h2 class="h3 py-2 me-2 text-center text-sm-start">Penjualan</h2>
      <div class="py-2">
        <div class="d-flex flex-nowrap align-items-center pb-3">
          <!-- Launch default modal -->
          <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterRight">
            <i class="ci-dollar me-2"></i>Lakukan Penarikan Dana
          </button>
        </div>
      </div>
    </div>
    <div class="row mx-n2 pt-2">
      <div class="col-md-4 col-sm-6 px-2 mb-4">
        <div class="bg-secondary h-100 rounded-3 p-4 text-center">
          <h3 class="fs-sm text-muted">Total Dana Penjualan</h3>
          <p class="h2 mb-2">
            @php
              $penjual = App\Models\Purchase::where([
                ['status','!=','pending'],
                ['status', '!=', 'waiting'],
                ['status', '!=', 'failed'],
              ])->whereHas('item', function($q){
                $q->where('user_id', Auth::user()->id);
              })->get();
              $jumlah = 0;
              foreach($penjual as $pay){
                $jumlah += ($pay->quantity * $pay->item->price);
              }   
            @endphp
            Rp{{number_format($jumlah,2,',','.')}}
          </p>
          @if(App\Models\Payout::first())
          <p class="fs-ms text-muted mb-0">Penarikan Terakhir {{\App\Models\Payout::latest('created_at')->first()->created_at}}</p>
          @else
          <p class="fs-ms text-muted mb-0">Penarikan Terakhir (Belum Ada Data)</p>
          @endif
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
          <h3 class="fs-sm text-muted">Jumlah Penjualan</h3>
          <p class="h2 mb-2">{{$penjual->count()}}</p>
          <p class="fs-ms text-muted mb-0">Total jumlah penjualan yang sudah kamu lakukan</p>
        </div>
      </div>
    </div>
    <!-- Products list-->
    <!-- Product-->
    <div class="table-responsive fs-md mb-4">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>Purchase ID #</th>
            <th>Tanggal Pembelian</th>
            <th>Status</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          @forelse($penjualans as $penjualan)
          <tr>
            <td>#Penjualan-{{$penjualan->id}}</td>
            <td>{{$penjualan->created_at}}</td>
            <td>@include('reseller.penjualan.status',['data' => $penjualan->status])</td>
            <td>{{$penjualan->quantity}}</td>
          </tr>
          @empty
          <tr>
            <td colspan="5">Penjualan Masih Kosong</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <!-- Pagination-->
    {{$penjualans->links('components.paginations.default')}}
@endsection