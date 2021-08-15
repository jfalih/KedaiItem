
<section class="col-lg-8">
    
<!-- Toolbar-->
    {{$items->links('components.paginations.header')}}
    <!-- Products grid-->
    <div class="row mx-n2">
    <!-- Product-->
    @foreach ($items as $item)
    <div class="col-md-4 col-sm-6 px-2 mb-4">
        <div class="card product-card">
        <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="{{url('assets/img/shop/catalog/01.jpg')}}" alt="Product"></a>
        <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Sneakers &amp; Keds</a>
            <h3 class="product-title fs-sm"><a href="shop-single-v1.html">{{$item->name}}</a></h3>
            <div class="d-flex justify-content-between">
            <div class="product-price"><span class="text-accent"><small>{{$item->price_format}}</small></span></div>
            @include('components.shops.stars.default',['rating' => $item->average_rating])
            </div>
        </div>
        <div class="card-body card-body-hidden">
            <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-cart fs-sm me-1"></i>Add to Cart</button>
            <div class="text-center"><a class="nav-link-style fs-ms" href="#quick-view" data-bs-toggle="modal"><i class="ci-eye align-middle me-1"></i>Quick view</a></div>
        </div>
        </div>
        <hr class="d-sm-none">
    </div>
    @endforeach
    </div>
    <!-- Banner-->
    <hr class="my-3">
    <!-- Pagination-->
    {{$items->links('components.paginations.default')}}
</section>