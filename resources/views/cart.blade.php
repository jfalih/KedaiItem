@extends('layouts.app')
@section('main')
    
<main class="page-wrapper">
<!-- Page Title-->
    @include('components.headers.default')
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item"><a class="text-nowrap" href="{{url('/')}}"><i class="ci-home"></i>Home</a></li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">Keranjang Belanja</li>
            </ol>
            </nav>
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">Keranjang Belanja</h1>
        </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <!-- List of items-->
            <section class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-4 pb-sm-5 mt-1">
                <h2 class="h6 text-light mb-0">Item</h2><a class="btn btn-outline-primary btn-sm ps-2" href=""><i class="ci-arrow-left me-2"></i>Lanjutkan Belanja</a>
            </div>
            <!-- Item--> 
            @forelse (Cart::getContent() as $item)
            <div class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
                <div class="d-block d-sm-flex align-items-center text-center text-sm-start"><a class="d-inline-block flex-shrink-0 mx-auto me-sm-4" href="shop-single-v1.html"><img src="{{url('assets/img/shop/cart/01.jpg')}}" width="160" alt="Product"></a>
                <div class="pt-2">
                    <h3 class="product-title fs-base mb-2"><a href="shop-single-v1.html">{{$item->name}}</a></h3>
                    <div class="fs-lg text-accent pt-2">Rp{{number_format($item->price*$item->quantity,2,',','.')}}</div>
                </div>
                </div>
                <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-start" style="max-width: 9rem;">
                <label class="form-label" for="quantity1">Jumlah</label>
                <input class="form-control" type="number" id="quantity1" min="1" value="{{$item->quantity}}">
                <form method="POST" action="{{route('cart.remove')}}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{$item->id}}"/>    
                <button class="btn btn-link px-0 text-danger" data-id="{{$item->id}}" type="submit"><i class="ci-close-circle me-2"></i><span class="fs-sm">Remove</span></button>
                </form>    
                </div>
            </div>
            @empty
            <span>Masih Kosong</span>
            @endforelse
            <button class="btn btn-outline-accent d-block w-100 mt-4" type="submit"><i class="ci-loading fs-base me-2"></i>Update cart</button>
            </section>
            <!-- Sidebar-->
            <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
            <div class="bg-white rounded-3 shadow-lg p-4">
                <div class="py-2 px-xl-2">
                <div class="text-center mb-4 pb-3 border-bottom">
                    <h2 class="h6 mb-3 pb-1">Subtotal</h2>
                    <h3 class="fw-normal">Rp{{number_format(Cart::getTotal(),2,',','.')}}</h3>
                </div>
                <a class="btn btn-primary btn-shadow d-block w-100 mt-4" href="checkout-details.html"><i class="ci-card fs-lg me-2"></i>Proceed to Checkout</a>
                </div>
            </div>
            </aside>
        </div>
    </div>
</main>
  
@endsection