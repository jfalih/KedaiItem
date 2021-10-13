@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{route('admin.user.update',['user' => $user])}}" class="card">
                @method('PUT')
                @csrf
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <h4 class="card-title">Edit user</h4>
                    <p class="card-title-desc">Mengubah user {{$user->name}} dengan id {{$user->id}}.</p>

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{$user->name}}" name="name" id="example-text-input">
                        </div>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="example-search-input" class="col-md-2 col-form-label">Username</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="username" value="{{$user->username}}" id="example-search-input">
                        </div>
                        @error('username')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="example-email-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input class="form-control" type="email" name="email" value="{{$user->email}}" id="example-email-input">
                        </div>
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="example-email-input" class="col-md-2 col-form-label">Nomor Handphone</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="nomorhp" value="{{$user->nomorhp}}" id="example-email-input">
                        </div>
                        @error('nomorhp')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" for="formrow-firstname-input">Status</label>
                        <div class="col-md-10">
                            <select name="status" class="form-select select2 @error('status') is-invalid @enderror">
                                <option value="">Pilih status</option>
                                @foreach ($statuses as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Role</label>
                        <div class="col-md-10">
                            <select name="roles[]" class="select2 form-control select2-multiple  @error('roles') is-invalid @enderror" multiple="multiple" data-placeholder="Choose ...">
                                <optgroup label="Role">
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}"
                                        @foreach($user->roles as $userrole)
                                            @if($role->id == $userrole->id) selected @endif
                                        @endforeach>{{$role->name}}</option>   
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        @error('roles')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div> <!-- end col -->
    </div>
</div>
@endsection