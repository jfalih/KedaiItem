@extends('layouts.user')
@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/datatables.css')}}">
@endsection
@section('content') 
  <!-- Page Sidebar Ends-->
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3>Topup Saldo</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
              <li class="breadcrumb-item active">Topup</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <form method="POST" action="{{route('topup.saldo')}}" class="card">
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
            <div class="card-header pb-0">
              <h5>Isi saldo</h5>
              <span>Kamu bisa mengisi saldu kamu disini.</span>
            </div>
            <div class="card-body">
              <div class="theme-form">
                <div class="mb-3">
                  <label class="col-form-label pt-0" for="nominal">Nominal</label>
                  <input class="form-control" id="nominal" name="nominal" type="number" aria-describedby="nominalHelp" placeholder="Nominal">
                  @error('nominal')
                  <small class="form-text text-danger">{{$message}}</small>
                  @else
                  <small class="form-text text-muted" id="nominalHelp">Masukan jumlah nominal yang ingin kamu isi.</small>
                  @enderror
                </div>
                <div class="row">
                  @error('method')
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @enderror     
                  @foreach($categoryPayment as $payment)
                  <div class="col-sm-6">
                    <div class="card">
                      <div class="media p-20">
                        <div class="radio radio-primary me-3">
                          <input id="{{$payment->code}}" type="radio" name="method" value="{{$payment->id}}">
                          <label for="{{$payment->code}}"></label>
                        </div>
                        <div class="media-body">
                          <h6 class="mt-0 mega-title-badge">{{$payment->name}}<span class="badge badge-primary pull-right digits">{{$payment->code}}</span></h6>
                          <p>Biaya Admin: Rp{{number_format($payment->fee_admin,0,',','.')}}</p>
                          <img style="object-fit: cover; width:auto;height:80px;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/BANK_BRI_logo.svg/2560px-BANK_BRI_logo.svg.png"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
          </form>
        </div>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>History Topup</h5>
              <span>Berikut ini history topup kamu di {{env('APP_NAME')}}</span>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display datatables" id="datatables1">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>ID</th>
                      <th>METODE</th>
                      <th>NOMINAL</th>
                      <th>KODEUNIK</th>
                      <th>STATUS</th>
                      <th>TOTAL</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>NO</th>
                      <th>ID</th>
                      <th>METODE</th>
                      <th>NOMINAL</th>
                      <th>KODEUNIK</th>
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
        ajax: "{{ route('topup') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name: 'id'},
            {data: 'method', name: 'method'},
            {data: 'nominal', name: 'nominal'},
            {data: 'kode_unik', name: 'kode_unik'},
            {data: 'status', name: 'status'},
            {data: 'total', name: 'total'},
            {data: 'action', name: 'action'},
          ]
    });
  });
</script>
@endsection