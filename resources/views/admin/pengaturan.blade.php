@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form method="POST" action="{{ route('admin.pengaturan.store') }}" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title">Pengaturan Website</h4>
                        <p class="card-title-desc">Disini kamu bisa merubah logo dan halaman depan website.</p>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Logo</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama Website</label>
                            <div class="col-md-10">
                                <input class="form-control @error('name') is-invalid @enderror" placeholder="Nama Website" value="{{$setting->name}}" name="website_name">
                                
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Judul</label>
                            <div class="col-md-10">
                                <input class="form-control" value="{{$setting->title}}"  placeholder="Judul" name="title">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Slogan / Deskripsi</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="deskripsi" placeholder="Slogan / Deskripsi">{{$setting->description}}</textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="reset" class="btn btn-danger w-md">Reset</button>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
@endsection