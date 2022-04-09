@extends('layouts.app')
@section('content')
<section class="inner-section single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>{{$category->name}}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$category->slug}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="inner-section ad-list-part">
    <div class="container">
        <div class="row content-reverse">
            <div class="col-lg-4 col-xl-3">
                <div class="row">
                    <div class="col-md-6 col-lg-12">
                        <div class="product-widget">
                            <h6 class="product-widget-title">Filter by Price</h6>
                            <form method="GET" class="product-widget-form">
                                <div class="product-widget-group">
                                    <input type="text" name="priceMin" value="{{request()->get('priceMin')}}" placeholder="min - 00">
                                    <input type="text" name="priceMax" value="{{request()->get('priceMax')}}" placeholder="max - 1B">
                                </div>
                                <button type="submit" class="product-widget-btn">
                                    <i class="fas fa-search"></i>
                                    <span>search</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-12">
                        <div class="product-widget">
                            <h6 class="product-widget-title">Filter subcategory</h6>
                            <form method="GET" class="product-widget-form">
                                <ul class="product-widget-list">
                                    @php 
                                    if(empty(request()->get('subcategories'))){
                                        $check_sub = []; 
                                    } else {
                                        $check_sub = request()->get('subcategories');
                                    }
                                    @endphp
                                    @foreach($category->subcategories as $subcat)
                                    <li class="product-widget-item">
                                        <div class="product-widget-checkbox">
                                            <input type="checkbox" 
                                                @foreach($check_sub as $check) 
                                                    @if($check == $subcat->id)
                                                        checked
                                                        @break
                                                    @endif    
                                                @endforeach 
                                            name="subcategories[]" value="{{$subcat->id}}" id="{{$subcat->slug}}">
                                        </div>
                                        <label class="product-widget-label" for="{{$subcat->slug}}">
                                            <span class="product-widget-text">{{$subcat->name}}</span>
                                            <span class="product-widget-number">({{$subcat->count()}})</span>
                                        </label>
                                    </li>
                                    @endforeach
                                    <li class="product-widget-item">
                                        <div class="product-widget-checkbox">
                                            <input type="checkbox" name="subcategories[]" value="2" id="2">
                                        </div>
                                        <label class="product-widget-label" for="2">
                                            <span class="product-widget-type sale">Test</span>
                                            <span class="product-widget-number">(2)</span>
                                        </label>
                                    </li>
                                </ul>
                                <button type="submit" class="product-widget-btn"><i class="fas fa-broom"></i><span>Aktifkan Filter</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="GET" class="header-filter">
                            <div class="filter-show">
                                <label class="filter-label">Tampil :</label>
                                <select name="show" class="custom-select filter-select">
                                    <option @if(request()->get('show') == 12) selected @endif value="12">12</option>
                                    <option @if(request()->get('show') == 24) selected @endif value="24">24</option>
                                    <option @if(request()->get('show') == 36) selected @endif value="36">36</option>
                                </select>
                            </div>
                            <div class="filter-short">
                                <label class="filter-label">Short by :</label>
                                <select name="sort" class="custom-select filter-select">
                                    <option @if(request()->get('sort') == "terlaris") selected @endif value="terlaris">Terlaris</option>
                                    <option @if(request()->get('sort') == "priceMax") selected @endif value="priceMax">Termahal - Termurah</option>
                                    <option @if(request()->get('sort') == "priceMin") selected @endif value="priceMin">Termurah - Termahal</option>
                                </select>
                            </div>
                            <div class="filter-action">
                                <button type="submit" class="btn btn-outline"><i class="fas fa-broom"></i><span>Aktifkan Filter</span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    @foreach($items as $item)
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-img">
                                    <img src="{{asset('assets/images/product/07.jpg')}}" alt="product">
                                </div>
                                <div class="cross-vertical-badge product-badge">
                                    <i class="fas fa-clipboard-check"></i><span>recommend</span>
                                </div>
                                <div class="product-type">
                                    <span class="flat-badge booking">{{$item->subcategories->first()->name}}</span>
                                </div>
                                <ul class="product-action">
                                    <li class="view">
                                        <i class="fas fa-eye"></i><span>264</span>
                                    </li>
                                    <li class="click">
                                        <i class="fas fa-mouse"></i><span>134</span>
                                    </li>
                                    <li class="rating">
                                        <i class="fas fa-star"></i><span>4.5/7</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category">
                                    <li>
                                        <i class="fas fa-tags"></i>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{route('category.index',['slug' => $category->slug])}}">{{$category->name}}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$item->subcategories->first()->name}}</li>
                                </ol>
                                <h5 class="product-title"><a href="{{route('item.detail',[
                                    'seller' => $item->user->username,
                                    'product' => $item->slug
                                ])}}">{{Str::title($item->name)}}</a></h5>
                                <div class="product-meta">
                                    <span>Terjual {{$item->sold}}</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">Rp{{number_format($item->price,2,',','.')}}</h5>
                                    <div class="product-btn">
                                        <button type="button" title="Wishlist" class="fas fa-cart-plus"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    {{$items->links('components.paginations.default')}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection