@extends('layouts.user')
@section('content')
    <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom mb-5">
      <h2 class="h3 py-2 me-2 text-center text-sm-start">Galeri</h2>
    </div>
    <!-- Products list-->
    <!-- Gallery grid with gutters -->

    <!-- Gallery grid with gutters -->
    <div class="row gallery">
        @foreach ($images as $item)    
        <!-- Item -->
            <div class="col-xl-4 col-sm-6 mb-grid-gutter">
                <button type="button" class="btn btn-danger btn-icon position-absolute" style="z-index: 100 !important;">
                    <i class="ci-trash"></i>
                </button>

                <a href="path-to-large-image" class="gallery-item rounded-3" data-sub-html='<h6 class="fs-sm text-light">Gallery image caption</h6>'>
                    <!-- Danger outline icon button -->
                    <img src="{{Storage::url($item->name)}}" alt="{{$item->caption}}">
                    <span class="gallery-item-caption">{{$item->caption}}</span>    
                </a>
            </div>
        @endforeach
    <!-- Add as many columns with gallery item inside as you need -->
    </div>
    <!-- Pagination-->
    <div class="col-12">
        <hr class="mt-2 mb-4">
        <div class="d-sm-flex justify-content-between align-items-center">
          <button class="btn btn-primary mt-3 mt-sm-0" href="#upload-modal" data-bs-toggle="modal" type="button"><i class="ci-add-circle me-2"></i> Tambah Gambar</button>
        </div>
    </div>
@endsection