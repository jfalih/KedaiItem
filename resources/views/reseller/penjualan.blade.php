@extends('layouts.user')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/datatables.css')}}">
@endsection
@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3>Penjualan</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}" data-bs-original-title="" title="">Home</a></li>
            <li class="breadcrumb-item active">Penjualan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 col-xl-4 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
              <div class="media-body"><span class="m-0">Penjualan</span>
                <h4 class="mb-0 counter">{{$purchase->count()}}</h4><i class="icon-bg" data-feather="shopping-bag"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-4 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-secondary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
              <div class="media-body"><span class="m-0">Belum Dikirim</span>
                <h4 class="mb-0 counter">{{$purchase->where('status', 'waiting')->count()}}</h4><i class="icon-bg" data-feather="shopping-bag"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
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
      <div class="col-sm-6 col-xl-4 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
              <div class="media-body"><span class="m-0">Pendapatan</span>
                <h4 class="mb-0 counter">Rp{{number_format($jumlah,0,',','.')}}</h4><i class="icon-bg" data-feather="shopping-bag"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>Data Penjualan</h5>
            <span>Berikut ini data penjualan kamu di {{env('APP_NAME')}}</span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display datatables" id="datatables1">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>ITEM</th>
                    <th>NAME</th>
                    <th>QUANTITY</th>
                    <th>PENGIRIMAN</th>
                    <th>STATUS</th>
                    <th>TOTAL</th>
                    <th></th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>ITEM</th>
                    <th>NAME</th>
                    <th>QUANTITY</th>
                    <th>PENGIRIMAN</th>
                    <th>STATUS</th>
                    <th>TOTAL</th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
            </div>
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
<script src="{{asset('assets_users/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets_users/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<script type="text/javascript">
  $(function () {
    var table = $('#datatables1').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('reseller.penjualan') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'quantity', name: 'quantity'},
            {data: 'option', name: 'option'},
            {data: 'status', name: 'status'},
            {data: 'total', name: 'total'},
            {data: 'action', name: 'action'},
          ]
    });
  });
</script>
@endsection