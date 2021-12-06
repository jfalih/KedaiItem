@extends('layouts.app')
@section('main')
    
<main class="page-wrapper">
    <!-- Navbar Marketplace-->
    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
    @include('components.headers.default')
    <!-- Hero section-->
    @if($setting)
    @include('components.sections.hero',  ['title' =>  $setting->title, 'subtitle' => $setting->description])
    @else
    @include('components.sections.hero',  ['title' =>  'You can change it on setting admin panel', 'subtitle' => 'Change subtitle on setting admin panel'])
    @endif
    <!-- Featured products (Carousel)-->
    @include('components.sections.recomended',['items' => $items])
    <!-- Recent products grid-->
    <section class="container pb-5 mb-lg-3">
      <!-- Heading-->
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 me-2">Item Item Terbaru</h2>
      </div>
      <!-- Grid-->
      <div class="row pt-2 mx-n2">
        @foreach($newitem as $new)
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
          <!-- Product-->
          <div class="card product-card-alt">
            <div class="product-thumb">
              <a class="product-thumb-overlay" href="{{ url('http://127.0.0.1:8000/penjual/'.$new->user->username.'/item/'.$new->slug) }}"></a>
              <img src="{{Storage::url($new->images->first()->name)}}" alt="{{$new->slug}}">
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted fs-xs me-1">by <a class="product-meta fw-medium" href="{{url('penjual/'.$new->user->username)}}">{{ $new->user->username }}</a></div>
               
                @include('components.shops.stars.default',['rating' => $new->average_rating])
               
              </div>
              <h3 class="product-title fs-sm mb-2">
                <a href="">{{ $new->title }}</a>
              </h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>{{$new->sold}}<span class="fs-xs ms-1">Terjual</span></div>
                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">{{$new->price_format}}</div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <!-- More button-->
    </section>
    <!-- Marketplace features-->
    <section class="bg-accent bg-size-cover bg-position-center pt-5 pb-4 pb-lg-5" style="background-image: url(img/marketplace/features/features-bg.jpg);">
      <div class="container pt-lg-3">
        <h2 class="h3 mb-3 pb-4 text-light text-center">Fitur Kami</h2>
        <div class="row pt-lg-2 text-center">
          @forelse ($features as $feature)
            <div class="col-lg-3 col-sm-6 mb-grid-gutter">
              <div class="d-inline-flex align-items-center text-start"><img src="{{Storage::url($feature->image->name)}}" width="52" alt="{{$feature->image->caption}}">
                <div class="ps-3">
                  <h6 class="text-light fs-base mb-1">{{$feature->title}}</h6>
                  <p class="text-light fs-ms opacity-70 mb-0">{{$feature->description}}</p>
                </div>
              </div>
            </div>
          @empty
            <div class="col-lg-12 col-sm-6 mb-grid-gutter">
              <div class="d-inline-flex align-items-center text-start">
                <div class="ps-3">
                  <h6 class="text-light fs-base mb-1">Tidak Ada</h6>
                  <p class="text-light fs-ms opacity-70 mb-0">Tidak ada feature yang ditambahkan</p>
                </div>
              </div>
            </div>
          @endforelse
        </div>
      </div>
    </section>
    <!-- Blog posts carousel-->
  </main>
@endsection