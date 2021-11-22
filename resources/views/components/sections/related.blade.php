<section class="container mb-5 pb-lg-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-4 mb-4">
      <h2 class="h3 mb-0 pt-2">Item lainnya</h2>
      <div class="pt-2"><a class="btn btn-outline-accent btn-sm" href="{{url('penjual/'.$seller->username)}}">Lainnya<i class="ci-arrow-end ms-1 me-n1"></i></a></div>
    </div>
    <!-- Carousel-->
    @if($related->count() > 0)
    <div class="tns-carousel">
      <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;gutter&quot;: 16, &quot;controls&quot;: false, &quot;nav&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2 },&quot;768&quot;:{&quot;items&quot;:3}, &quot;992&quot;:{&quot;items&quot;:4}}}">
        @foreach($related as $relat)
        <!-- Product-->
        <div>
          <div class="card product-card-alt">
            <div class="product-thumb">
              <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="#"><i class="ci-eye"></i></a>
                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
              </div><a class="product-thumb-overlay" href="#"></a><img src="img/marketplace/products/02.jpg" alt="Product">
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted fs-xs me-1">by <a class="product-meta fw-medium" href="#">Createx Std. </a>in <a class="product-meta fw-medium" href="#">Graphics</a></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                </div>
              </div>
              <h3 class="product-title fs-sm mb-2"><a href="#">Floating Phone and Tablet Mockup</a></h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>109<span class="fs-xs ms-1">Sales</span></div>
                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$15.<small>00</small></div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @else
    
    <div class="row justify-content-center pt-lg-4 text-center">
      <div class="col-12">
        <img class="d-block mx-auto mb-5" src="{{Storage::url('public/website/illustration/sad.png')}}" width="340" alt="404 Error">
        <h1 class="h3">Seller tidak menjual item lainnya.</h1>
        <h3 class="h5 fw-normal mb-4">Kami tidak dapat menemukan barang yang mirip.</h3>
      </div>
    </div>
    @endif
  </section>