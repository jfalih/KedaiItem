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
          <h3>Pembelian</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}" data-bs-original-title="" title="">Home</a></li>
            <li class="breadcrumb-item active">Pembelian</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>Data Pembelian</h5>
            <span>Berikut ini data pembelian kamu di {{env('APP_NAME')}}</span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display datatables" id="datatables1">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>ID</th>
                    <th>ITEM</th>
                    <th>NAME</th>
                    <th>QUANTITY</th>
                    <th>PENGIRIMAN</th>
                    <th>STATUS</th>
                    <th>TOTAL</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>NO</th>
                    <th>ID</th>
                    <th>ITEM</th>
                    <th>NAME</th>
                    <th>QUANTITY</th>
                    <th>PENGIRIMAN</th>
                    <th>STATUS</th>
                    <th>TOTAL</th>
                    <th>ACTION</th>
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
        ajax: "{{ route('pembelian') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
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