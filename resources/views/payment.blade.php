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
                    <!-- Steps-->
                    <div class="steps steps-light pt-2 pb-3 mb-5">
                        <a class="step-item ">
                        <div class="step-progress">
                            <span class="step-count">1</span>
                        </div>
                        <div class="step-label">
                            <i class="ci-cart"></i>Cart
                        </div>
                        </a>
                        </a><a class="step-item active">
                        <div class="step-progress">
                            <span class="step-count">2</span>
                        </div>
                        <div class="step-label">
                            <i class="ci-check-circle"></i>Review
                        </div>
                        </a>
                    </div>
                    <div class="bg-secondary rounded-3 px-4 pt-4 pb-2">
                        
                        @foreach ($payment->purchases as $purchase)
                            <div class="d-sm-flex justify-content-between my-4 pb-3 border-bottom">
                                <div class="d-sm-flex text-center text-sm-start">
                                    <a class="d-inline-block flex-shrink-0 mx-auto me-sm-4" href="{{url('penjual/'.$purchase->user->username.'/item/'.$purchase->item->slug)}}">
                                        <img src={{Storage::url($purchase->item->images->first()->name)}} width="160" alt="Product">
                                    </a>
                                <div class="pt-2">
                                    <h3 class="product-title fs-base mb-2"><a href="{{url('penjual/'.$purchase->user->username.'/item/'.$purchase->item->slug)}}">{{ $purchase->item->name }}</a></h3>
                                    <div class="fs-sm"><span class="text-muted me-2">Seller:</span>{{ $purchase->item->user->username }}</div>
                                    <div class="fs-lg text-accent pt-2">Rp{{ number_format($purchase->item->price,2,',','.') }}</div>
                                </div>
                                </div>
                                <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-end" style="max-width: 9rem;">
                                    <p class="mb-0">
                                        <span class="text-muted fs-sm">Quantity:</span>
                                        <span>&nbsp;{{ $purchase->quantity }}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                      </div>
                </section>
                <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
                    <div class="bg-white rounded-3 shadow-lg p-4">
                      <h5>Intruksi Pembayaran</h5>
                      <div class="py-2 px-xl-2">
                        <div class="accordion" id="accordionExample">

                          @foreach($response->data->instructions as $index => $res)
                            <!-- Item -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$index}}">
                                  <button class="accordion-button @if($index != 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$index}}" aria-expanded="true" aria-controls="collapse{{$index}}">{{$res->title}}</button>
                                </h2>
                                <div class="accordion-collapse p-3 collapse @if($index == 0) show @endif" id="collapse{{$index}}" aria-labelledby="heading{{$index}}" data-bs-parent="#accordionExample">
                                    @foreach($res->steps as $step)
                                    <p>{!! $step !!}</p>
                                    @endforeach
                                </div>
                              </div>
                          @endforeach
                          
                        </div><button class="btn btn-primary btn-shadow d-block w-100 mt-4"><i class="ci-card fs-lg me-2"></i>Periksa Pembayaran</button>
                      </div>
                    </div>
                  </aside>
            </div>
        </div>
        
</main>
@endsection