@extends('layouts.user')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/fontawesome.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/datatables.css')}}">
@endsection
@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3>Product</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html" data-bs-original-title="" title="">Home</a></li>
            <li class="breadcrumb-item active">Product</li>
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
          <div class="bg-secondary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg></div>
              <div class="media-body"><span class="m-0">Total Product</span>
                <h4 class="mb-0 counter">{{$products->count()}}</h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag icon-bg"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-4 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-secondary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg></div>
              <div class="media-body"><span class="m-0">Total Product</span>
                <h4 class="mb-0 counter">{{$products->count()}}</h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag icon-bg"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-4 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg></div>
              <div class="media-body"><span class="m-0">Stok Habis</span>
                <h4 class="mb-0 counter">{{App\Models\Item::where([
                  ['stok','=',0],
                  ['user_id','=', Auth::user()->id]])->count()}}</h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database icon-bg"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
                <h5>Data Product</h5>
                <span class="mb-3">Berikut ini data product yang kamu jual di {{env('APP_NAME')}}</span>
                <a href="{{route('reseller.product.add')}}" class="btn btn-primary">Tambah Product</a>
    
          </div>
          <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="table-responsive">
              <table class="display datatables" id="datatables1">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>ID</th>
                    <th>GAMBAR</th>
                    <th>ITEM</th>
                    <th>HARGA</th>
                    <th>STATUS</th>
                    <th>STOK</th>
                    <th>AKSI</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>NO</th>
                    <th>ID</th>
                    <th>GAMBAR</th>
                    <th>ITEM</th>
                    <th>HARGA</th>
                    <th>STATUS</th>
                    <th>STOK</th>
                    <th>AKSI</th>
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
        ajax: "{{ route('reseller.product') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'name', name: 'name'},
            {data: 'price', name: 'price'},
            {data: 'status', name: 'status'},
            {data: 'stok', name: 'stok'},
            {data: 'action', name: 'action'},
          ]
    });
    
  });
</script>
@endsection