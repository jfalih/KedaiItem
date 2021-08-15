@extends('layouts.app')
@section('main')
    <main class="page-wrapper">  
      @include('components.headers.default')
      <!-- Dashboard header-->
      @include('components.users.pagetitle')
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            @include('components.profiles.aside')      
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <!-- Title-->
                <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom mb-5">
                  <h2 class="h3 py-2 me-2 text-center text-sm-start">Galeri</h2>
                </div>
                <!-- Products list-->
                <!-- Gallery grid with gutters -->
                <div class="row gallery">
                    @foreach (Auth::user()->images as $img)
                    <!-- Item -->
                    <div class="col-6 col-sm-3 mb-grid-gutter">
                        <a href="{{Storage::url($img->name)}}" class="gallery-item rounded-3" data-sub-html='<h6 class="fs-sm text-light">Gallery image caption</h6>'>
                            <img src="{{Storage::url($img->name)}}" alt="{{url($img->name)}}">
                            <span class="gallery-item-caption">{{url($img->name)}}</span>
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
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
@endsection
@section('js')
    @parent
@endsection