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
          <h3>Pembayaran</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html" data-bs-original-title="" title="">Home</a></li>
            <li class="breadcrumb-item active">Pembayaran</li>
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
            <h5>Data Pembayaran</h5>
            <span>Berikut ini data pembayaran kamu di {{env('APP_NAME')}}</span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display datatables" id="datatables1">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>ID</th>
                    <th>METODE</th>
                    <th>TOTAL</th>
                    <th>STATUS</th>
                    <th></th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>NO</th>
                    <th>ID</th>
                    <th>METODE</th>
                    <th>TOTAL</th>
                    <th>STATUS</th>
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
        ajax: "{{ route('pembayaran') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name: 'id'},
            {data: 'method', name: 'method'},
            {data: 'total', name: 'total'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
          ]
    });
  });
</script>
@endsection