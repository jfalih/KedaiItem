@extends('layouts.app')
@section('main')
<main class="page-wrapper">
    <!-- Navbar 3 Level (Light)-->
    @include('components.headers.default')
    <!-- Page Title-->
    @include('components.headers.pagetitle', ['title' => 'Kategori "'.$category->name.'"'])
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4">
            <!-- Sidebar-->
            <div class="offcanvas offcanvas-collapse bg-white w-100 rounded-3 shadow-lg py-1" id="shop-sidebar" style="max-width: 22rem;">
                <div class="offcanvas-header align-items-center shadow-sm">
                <h2 class="h5 mb-0">Filters</h2>
                <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body py-grid-gutter px-lg-grid-gutter">
                <!-- Categories-->
                <div class="widget widget-categories mb-4 pb-4 border-bottom">
                    <h3 class="widget-title">Kategori</h3>
                    <div class="accordion mt-n1" id="shop-categories">
                    <!-- Shoes-->
                    @foreach($categories as $index => $cat)
                    <div class="accordion-item">
                        <h3 class="accordion-header"><a class="accordion-button @if($category->slug != $cat->slug) collapsed @endif" href="#{{$cat->slug}}" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="{{$cat->slug}}">{{$cat->name}}</a></h3>
                        <div class="accordion-collapse collapse @if($category->slug == $cat->slug) show @endif" id="{{$cat->slug}}" data-bs-parent="#shop-categories">
                        <div class="accordion-body">
                            <div class="widget widget-links widget-filter">
                            <ul class="widget-list widget-filter-list pt-1" style="height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                                @foreach ($cat->subcategories as $sub)
                                <li class="widget-list-item widget-filter-item">
                                    <a class="widget-list-link d-flex justify-content-between align-items-center" href="{{url('category/'.$cat->slug.'/subcategory/'.$sub->slug)}}">
                                        <span class="widget-filter-item-text @if($subcategory->slug == $sub->slug) text-primary @else text-muted @endif ">{{$sub->name}}</span>
                                        <span class="fs-xs  @if($subcategory->slug == $sub->slug) text-primary @else text-muted @endif ms-3">{{$sub->items->count()}}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
                </div>
            </div>
            </aside>
            <!-- Content  -->
            <section class="col-lg-8">
            <!-- Products grid-->
            <div class="row mx-n2"> 
                <!-- Product-->
                @forelse ($items as $item)
                    <div class="col-md-4 col-sm-6 px-2 mb-4">
                        <div class="card product-card">
                            <a class="card-img-top d-block overflow-hidden" href="{{url('penjual/'.$item->user->username.'/item/'.$item->slug)}}">
                                <img src="{{Storage::url($item->images->first()->name)}}" alt="{{$item->images->first()->caption}}">
                            </a>
                            <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">{{$item->subcategories->first()->name}}</a>
                            <h3 class="product-title fs-sm"><a href="{{url('penjual/'.$item->user->username.'/item/'.$item->slug)}}">{{$item->name}}</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price">
                                    <span class="text-accent">Rp{{number_format($item->price,2,',','.')}}</span>
                                </div>
                                @include('components.shops.stars.default',['rating' => $item->average_rating])
                            </div>
                            </div>
                        </div>
                        <hr class="d-sm-none">
                    </div>
                    <!-- Product-->
                @empty
                <h1>Tidak ada data item</h1>
                @endforelse
            </div>
            <!-- Pagination-->
            {{$items->links('components.paginations.default')}}
            </section>
        </div>
    </div>
</main>
@endsection