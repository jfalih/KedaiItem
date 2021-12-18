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
        <form method="POST" action="{{ route('checkout') }}">
            @csrf
        <div class="row">
            <!-- List of items-->
            <section class="col-lg-8">
                <!-- Steps-->
                <div class="steps steps-light pt-2 pb-3 mb-5">
                    <a class="step-item active" href="shop-cart.html">
                    <div class="step-progress">
                        <span class="step-count">1</span>
                    </div>
                    <div class="step-label">
                        <i class="ci-cart"></i>Cart
                    </div>
                    </a>
                    </a><a class="step-item" href="checkout-review.html">
                    <div class="step-progress">
                        <span class="step-count">5</span>
                    </div>
                    <div class="step-label">
                        <i class="ci-check-circle"></i>Review
                    </div>
                    </a>
                </div>
                <!-- Shipping methods table-->
                <h2 class="h6 pb-3 mb-2">Pilih metode pembayaran</h2>
                @if(count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul style="margin-bottom: 0px">
                        @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover fs-sm border-top">
                        <thead>
                        <tr>
                            <th class="align-middle"></th>
                            <th class="align-middle"></th>
                            <th class="align-middle">Metode Pembayaran</th>
                            <th class="align-middle">Pajak</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data_pembayaran as $pembayaran)
                            <tr>
                                <td>
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="radio" value={{$pembayaran['code']}} name="method">
                                    <label class="form-check-label" for="courier"></label>
                                </div>
                                </td>
                                <td>
                                    <img src="{{$pembayaran['icon_url']}}" width="40" height="40"/>
                                </td>
                                <td class="align-middle">
                                    <span class="text-dark fw-medium">{{$pembayaran['group']}}</span>
                                    <br>
                                    <span class="text-muted">{{$pembayaran['name']}}</span></td>
                                <td class="align-middle">Rp{{number_format($pembayaran['total_fee']['flat'],2,',','.')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Navigation (desktop)-->
              </section>
{{--             
            <section class="col-lg-8">
                
                <div class="steps steps-light pt-2 pb-3 mb-5">
                    <a class="step-item active" href="shop-cart.html">
                        <div class="step-progress">
                            <span class="step-count">1</span>
                        </div>
                        <div class="step-label">
                            <i class="ci-cart"></i>Cart
                        </div>
                    </a>
                    <a class="step-item " href="checkout-details.html">
                        <div class="step-progress">
                            <span class="step-count">2</span>
                        </div>
                        <div class="step-label">
                            <i class="ci-card"></i>Payment
                        </div>
                    </a>
                    <a class="step-item " href="checkout-details.html">
                        <div class="step-progress">
                            <span class="step-count">3</span>
                        </div>
                        <div class="step-label">
                            <i class="ci-check-circle"></i>Reviews
                        </div>
                    </a>
                </div>
                <!-- Item--> 
                @forelse (Cart::getContent() as $item)
                <div class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
                    <div class="d-block d-sm-flex align-items-center text-center text-sm-start"><a class="d-inline-block flex-shrink-0 mx-auto me-sm-4" href="shop-single-v1.html">
                        <img src="{{Storage::url(App\Models\Item::find($item->id)->images->first()->name)}}" width="160" alt="Product">
                    </a>
                    <div class="pt-2">
                        <h3 class="product-title fs-base mb-2"><a href="shop-single-v1.html">{{$item->name}}</a></h3>
                        <div class="fs-lg text-accent pt-2" id="item_price_{{$item->id}}">Rp{{number_format($item->price*$item->quantity,2,',','.')}}</div>
                    </div>
                    </div>
                    <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-start" style="max-width: 9rem;">
                    <label class="form-label" for="quantity{{$item->id}}">Jumlah</label>
                    <input class="form-control" type="number" id="quantity{{$item->id}}" min="1" value="{{$item->quantity}}">
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
            </section> --}}
            <!-- Sidebar-->
            <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
                <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                  <div class="py-2 px-xl-2">
                    <div class="widget mb-3">
                      <h2 class="widget-title text-center">Keranjang Belanja</h2>
                        <div class="mb-3">
                            <select name="option" class="form-select" required>
                                <option>Pilih Status Pembelian</option>
                                <option value="premium">Premium</option>
                                <option value="not">Normal</option>
                            </select>
                        </div>
                        <div class="mb-3">
                        </div>
                        @forelse (Cart::getContent() as $item)  
                        <div class="d-flex align-items-center pb-2 border-bottom">
                            <a class="d-block flex-shrink-0" href="shop-single-v1.html">
                                <img style="width: 80px; height:80px; object-fit:cover;" src="{{Storage::url(App\Models\Item::find($item->id)->images->first()->name)}}" width="64" alt="Product">
                            </a>
                            <div class="ps-2">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">{{$item->name}}</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">Rp{{number_format($item->price,2,',','.')}}</span><span class="text-muted">x {{$item->quantity}}</span></div>
                            </div>
                        </div>
                        @empty
                        <span>Masih Kosong</span>
                        @endforelse
                    </div>
                    <h3 class="fw-normal text-center my-4">Rp{{number_format(Cart::getTotal(),2,',','.')}}</h3>
                    <button type="submit" class="btn btn-primary btn-shadow d-block w-100 mt-4">
                        <i class="ci-card fs-lg me-2"></i> Lanjutkan Pembayaran
                    </button>
                  </div>
                </div>
              </aside>
            {{-- <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
                <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                    <div class="py-2 px-xl-2">
                        <div class="widget mb-3">
                        <h2 class="widget-title text-center">Order summary</h2>
                        <div class="d-flex align-items-center pb-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v1.html"><img src="img/shop/cart/widget/01.jpg" width="64" alt="Product"></a>
                            <div class="ps-2">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">Women Colorblock Sneakers</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$150.<small>00</small></span><span class="text-muted">x 1</span></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v1.html"><img src="img/shop/cart/widget/02.jpg" width="64" alt="Product"></a>
                            <div class="ps-2">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">TH Jeans City Backpack</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$79.<small>50</small></span><span class="text-muted">x 1</span></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v1.html"><img src="img/shop/cart/widget/03.jpg" width="64" alt="Product"></a>
                            <div class="ps-2">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">3-Color Sun Stash Hat</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$22.<small>50</small></span><span class="text-muted">x 1</span></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v1.html"><img src="img/shop/cart/widget/04.jpg" width="64" alt="Product"></a>
                            <div class="ps-2">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">Cotton Polo Regular Fit</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$9.<small>00</small></span><span class="text-muted">x 1</span></div>
                            </div>
                        </div>
                        </div>
                        <ul class="list-unstyled fs-sm pb-2 border-bottom">
                        <li class="d-flex justify-content-between align-items-center"><span class="me-2">Subtotal:</span><span class="text-end">$265.<small>00</small></span></li>
                        <li class="d-flex justify-content-between align-items-center"><span class="me-2">Shipping:</span><span class="text-end">—</span></li>
                        <li class="d-flex justify-content-between align-items-center"><span class="me-2">Taxes:</span><span class="text-end">$9.<small>50</small></span></li>
                        <li class="d-flex justify-content-between align-items-center"><span class="me-2">Discount:</span><span class="text-end">—</span></li>
                        </ul>
                        <h3 class="fw-normal text-center my-4">$274.<small>50</small></h3>
                        <form class="needs-validation" method="post" novalidate="">
                        <div class="mb-3">
                            <input class="form-control" type="text" placeholder="Promo code" required="">
                            <div class="invalid-feedback">Please provide promo code.</div>
                        </div>
                        <button class="btn btn-outline-primary d-block w-100" type="submit">Apply promo code</button>
                        </form>
                    </div>
                </div>
            </aside> --}}
        </div>
    </form>
    </div>
</main>
  
@endsection
@section('js')
    <script>
        var data = {!! json_encode(Cart::getContent()) !!};
        var arrCart = JSON.parse(JSON.stringify(data));
        Object.keys(arrCart).map(key => {
            $('#quantity'+arrCart[key].id).change(function(){
                let val = $(this).val();
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: 'put',
                    data: {
                        id: arrCart[key].id,
                        quantity: val-arrCart[key].quantity
                    },
                    success: function(response){
                        const int = Number(response.total);
                        $('#price').text(int.toLocaleString('id-ID', {
                            style:'currency',
                            currency: 'idr'
                        }));
                    }
                });
            })
        });
    </script>
@endsection