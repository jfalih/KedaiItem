@extends('layouts.admin')
@section('css')

        <!-- DataTables -->
        <link href="{{asset('assets_admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />  
        <link href="{{asset('assets_admin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />        

        
        <link href="{{asset('assets_admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets_admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets_admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
    @parent
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card bg-primary text-white-50">
                    <div class="card-body">
                        <h5 class="mb-4 text-white"><i class="uil uil-database-alt me-3"></i>{{App\Models\Subcategory::all()->count()}}</h5>
                        <p class="card-text">Total subcategory di website {{config('app.name')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-success text-white-50">
                    <div class="card-body">
                        <h5 class="mb-4 text-white"><i class="uil uil-database-alt me-3"></i>{{App\Models\Subcategory::where('status_id', 1)->count()}}</h5>
                        <p class="card-text">Total subcategory berstatus aktif di website {{config('app.name')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-danger text-white-50">
                    <div class="card-body">
                        <h5 class="mb-4 text-white"><i class="uil uil-database-alt me-3"></i>{{App\Models\Subcategory::where('status_id', 2)->count()}}</h5>
                        <p class="card-text">Total subcategory berstatus tidak aktif di website {{config('app.name')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Subcategory</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <form method="POST" enctype="multipart/form-data" action="{{route('admin.subcategory.store')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Nama subcategory</label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-firstname-input">Status</label>
                                            <select name="status" class="form-select select2 @error('status') is-invalid @enderror">
                                                <option value="">Pilih status</option>
                                                @foreach ($statuses as $status)
                                                <option value="{{$status->id}}">{{$status->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kategori</label>
                                            <select name="category[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ...">
                                                @foreach($statuses as $status)
                                                <optgroup label="Status {{$status->name}}">
                                                    @foreach ($status->categories as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>   
                                                    @endforeach
                                                </optgroup>
                                                @endforeach
                                            </select>
                                            @error('category')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <h4 class="card-title">Subcategory</h4>
                        <p class="card-title-desc">List subcategory website</p>
                        <table id="datatables1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    @if(session('subcategory-edit'))
    <div class="modal fade" id="subcategory-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <form method="POST" action="{{route('admin.subcategory.update', ['subcategory' => session('subcategory-edit')])}}" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Merubah subcategory dengan id {{session('subcategory-edit')->id}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @csrf   
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama Subcategory</label>
                                <input type="text" value="{{session('subcategory-edit')->name}}" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="formrow-firstname-input">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="">Pilih status</option>
                                    @foreach ($statuses as $status)
                                    <option value="{{$status->id}}" @if(session('subcategory-edit')->status_id === $status->id) selected @endif>{{$status->name}}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="category[]" class="form-control" multiple="multiple" data-placeholder="Choose ...">
                                    @foreach($statuses as $status)
                                    <optgroup label="Status {{$status->name}}">
                                        @foreach ($status->categories as $item)
                                        <option value="{{$item->id}}"
                                            @foreach(session('subcategory-edit')->categories as $subcat)
                                            @if($subcat->id === $item->id)
                                                selected
                                            @endif
                                            @endforeach
                                            >{{$item->name}}</option>   
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endif
@endsection
@section('js')
    @parent
        @if(session('subcategory-edit'))
            <script>
                $(document).ready(function(){
                    $('#subcategory-edit').modal('show');
                })
            </script>
        @endif
        <script src="{{ asset('assets_admin/libs/select2/js/select2.min.js')}}"></script>
        <script src="{{ asset('assets_admin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        
        <!-- init js -->
        <script src="{{ asset('assets_admin/js/pages/form-advanced.init.js')}}"></script>
        <!-- Required datatable js -->
        <script src="{{ asset('assets_admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('assets_admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('assets_admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('assets_admin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('assets_admin/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ asset('assets_admin/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{ asset('assets_admin/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{ asset('assets_admin/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('assets_admin/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ asset('assets_admin/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
        
        <!-- Responsive examples -->
        <script src="{{ asset('assets_admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('assets_admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{ asset('assets_admin/js/pages/datatables.init.js')}}"></script>
        <script type="text/javascript">
            $(function () {
              var table = $('#datatables1').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('admin.subcategory.index') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'name', name: 'name'},
                      {data: 'slug', name: 'slug'},
                      {data: 'category', name: 'category'},
                      {data: 'status', name: 'status'},
                      {data: 'action', name: 'Action'},
                  ]
              });
              
            });
        </script>
    @endsection