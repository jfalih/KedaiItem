@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card bg-primary text-white-50">
                    <div class="card-body">
                        <h5 class="mb-4 text-white"><i class="uil uil-database-alt me-3"></i>{{App\Models\Category::all()->count()}}</h5>
                        <p class="card-text">Total category di website {{config('app.name')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-success text-white-50">
                    <div class="card-body">
                        <h5 class="mb-4 text-white"><i class="uil uil-database-alt me-3"></i>{{App\Models\Category::where('status_id', 1)->count()}}</h5>
                        <p class="card-text">Total category berstatus aktif di website {{config('app.name')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-danger text-white-50">
                    <div class="card-body">
                        <h5 class="mb-4 text-white"><i class="uil uil-database-alt me-3"></i>{{App\Models\Category::where('status_id', 2)->count()}}</h5>
                        <p class="card-text">Total category berstatus tidak aktif di website {{config('app.name')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Features</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <form method="POST" enctype="multipart/form-data" action="{{route('admin.features.store')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="image">Gambar</label>
                                            <input class="form-control" type="file" name="image">
                                            @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="title">Judul</label>
                                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title">
                                            @error('title')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Deskripsi</label>
                                            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description">
                                            @error('description')
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
                        <h4 class="card-title">Features</h4>
                        <p class="card-title-desc">List features website</p>
                        <table id="datatables1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Created At</th>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if(App\Models\Setting::first())
                    <form method="POST" action="{{ route('admin.pengaturan.store') }}" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title">Pengaturan Website</h4>
                        <p class="card-title-desc">Disini kamu bisa merubah logo dan halaman depan website.</p>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Logo</label>
                            <div class="col-md-10">
                                <input class="form-control @error('logo') is-invalid @enderror" name="logo" type="file">
                                @error('logo')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Favicon</label>
                            <div class="col-md-10">
                                <input class="form-control @error('favicon') is-invalid @enderror" name="favicon" type="file">
                                @error('favicon')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama Website</label>
                            <div class="col-md-10">
                                <input class="form-control @error('name') is-invalid @enderror" placeholder="Nama Website" value="{{$setting->name}}" name="name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Judul</label>
                            <div class="col-md-10">
                                <input class="form-control @error('title') is-invalid @enderror" value="{{$setting->title}}"  placeholder="Judul" name="title">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Harga</label>
                            <div class="col-md-10">
                                <input class="form-control @error('harga') is-invalid @enderror" value="{{$setting->harga}}"  placeholder="Harga" name="harga">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <!-- Checked switch -->
                            <label for="example-text-input" class="col-md-2 col-form-label">Maintenance</label>
                            <div class="col-md-10">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="maintenance" value="1" class="@error('maintenance') is-invalid @enderror form-check-input" id="customSwitch2" @if($setting->maintenance == 1) checked @endif>
                                    <label class="form-check-label" for="customSwitch2">Website dibuat menjadi maintenance?</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Slogan / Deskripsi</label>
                            <div class="col-md-10">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" value={{$setting->description}} placeholder="Slogan / Deskripsi">{{$setting->description}}</textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="reset" class="btn btn-danger w-md">Reset</button>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                    @else
                    
                    <form method="POST" action="{{ route('admin.pengaturan.store') }}" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title">Pengaturan Website</h4>
                        <p class="card-title-desc">Disini kamu bisa merubah logo dan halaman depan website.</p>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Logo</label>
                            <div class="col-md-10">
                                <input class="form-control @error('logo') is-invalid @enderror" name="logo" type="file">
                                @error('logo')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Favicon</label>
                            <div class="col-md-10">
                                <input class="form-control @error('favicon') is-invalid @enderror" name="favicon" type="file">
                                @error('favicon')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama Website</label>
                            <div class="col-md-10">
                                <input class="form-control @error('name') is-invalid @enderror" placeholder="Nama Website" name="name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Judul</label>
                            <div class="col-md-10">
                                <input class="form-control @error('title') is-invalid @enderror" placeholder="Judul" name="title">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Harga</label>
                            <div class="col-md-10">
                                <input class="form-control @error('harga') is-invalid @enderror"  placeholder="Harga" name="harga">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <!-- Checked switch -->
                            <label for="example-text-input" class="col-md-2 col-form-label">Maintenance</label>
                            <div class="col-md-10">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="maintenance" value="1" class="@error('maintenance') is-invalid @enderror form-check-input" id="customSwitch2">
                                    <label class="form-check-label" for="customSwitch2">Website dibuat menjadi maintenance?</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Slogan / Deskripsi</label>
                            <div class="col-md-10">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Slogan / Deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="reset" class="btn btn-danger w-md">Reset</button>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div> <!-- end col -->
        </div>
    </div>
    @if(session('feature-edit'))
        <div class="modal fade" id="feature-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <form method="POST" action="{{route('admin.features.update', ['feature' => session('feature-edit')])}}" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Merubah feature dengan id {{session('feature-edit')->id}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @csrf   
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="image">Gambar</label>
                                    <input class="form-control" type="file" name="image">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="title">Judul</label>
                                    <input type="text" value="{{session('feature-edit')->title}}" name="title" class="form-control @error('title') is-invalid @enderror" id="title">
                                    @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="title">Deskripsi</label>
                                    <input type="text" value="{{session('feature-edit')->description}}" name="description" class="form-control @error('title') is-invalid @enderror" id="title">
                                    @error('description')
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
        @if(session('feature-edit'))
            <script>
                $(document).ready(function(){
                    $('#feature-edit').modal('show');
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
                  ajax: "{{ route('admin.features.index') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'title', name: 'title'},
                      {data: 'description', name: 'description'},
                      {data: 'created_at', name: 'created_at'},
                      {data: 'action', name: 'action'}
                  ]
              });
              
            });
        </script>
    @endsection