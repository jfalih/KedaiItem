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
            @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{session('error')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
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

@if(session()->has('review'))
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{route('review.add',['id' => session('review')->id])}}]" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Berikan Review</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="w-100 job-search border mb-3">
          <div class="card-body">
            <div class="media">
                <img class="img-40 img-fluid m-r-20" src="http://127.0.0.1:8000/assets_users/assets/images/job-search/1.jpg" alt="">
                <div class="media-body">
                  <h6 class="f-w-600">
                    <a href="job-details.html">Coba 1231231231 Produk</a>
                  <h6>
                  <span class="badge badge-primary">Transaksi Selesai</span></h6></h6>
                  <p>Rp 250.000 x 1<br>Username / Nickname Game : asdasdasd</p>
                </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label class="form-label" for="exampleFormControlSelect9">Rating</label>
              <select name="rating" class="form-select digits" id="exampleFormControlSelect9">
                <option value="5">Bintang 5</option>
                <option value="4">Bintang 4</option>
                <option value="3">Bintang 3</option>
                <option value="2">Bintang 2</option>
                <option value="1">Bintang 1</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div>
              <label class="form-label" for="exampleFormControlTextarea4">Berikan Review</label>
              <textarea name="review" class="form-control" id="exampleFormControlTextarea4" rows="3"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-secondary">Save</button>
      </div>
    </form>
  </div>
</div>
@endif
@endsection
@section('js')
@parent
@if(session()->has('review'))
<script type="text/javascript">
  $(window).on('load', function() {
      $('#exampleModal').modal('show');
  });
</script>
@endif
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