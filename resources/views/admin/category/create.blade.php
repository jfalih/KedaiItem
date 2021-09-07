@extends('layouts.admin')
@section('css')
        <!-- DataTables -->
        <link href="{{asset('assets_admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets_admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets_admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />  
        <!-- Responsive datatable examples -->
    @parent
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
    </div>
    <!-- End Form Layout -->
</div>
@endsection