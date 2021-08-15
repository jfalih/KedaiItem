
    <section class="container position-relative pt-3 pt-lg-0 pb-5 mt-lg-n10" style="z-index: 10;">
        <div class="card px-lg-2 border-0 shadow-lg">
          <div class="card-body px-4 pt-5 pb-4">
            <h2 class="h3 text-center">Rekomendasi item untukmu</h2>
            <p class="text-muted text-center">
                Kami selalu berusaha merekomendasikan item game terbaik untukmu.
            </p>
            <!-- Carousel-->
            <div class="tns-carousel pt-4">
              <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;gutter&quot;: 15, &quot;controls&quot;: false, &quot;nav&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}, &quot;992&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 30}}}">
                <!-- Product-->
                @forelse ($items as $item)
                <div>
                  <div class="card product-card-alt">
                    <div class="product-thumb">
                      <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                      <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                        <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                      </div><a class="product-thumb-overlay" href="{{url('penjual/'.$item->user->username.'/item/'.$item->slug)}}"></a><img src="{{url('assets/img/marketplace/products/02.jpg')}}" alt="Product">
                    </div>
                    <div class="card-body">
                      <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                        <div class="text-muted fs-xs me-1">by <a class="product-meta fw-medium" href="{{url('penjual/'.$item->user->username)}}">{{$item->user->name}}</a> in <a class="product-meta fw-medium" href="#">Graphics</a></div>
                       
                        <div class="star-rating">
                          @php
                           $i = 0;
                           $y = floor((float)$item->average_rating);   
                          @endphp
                          @for($i; $i < $y; $i++)
                          <i class="star-rating-icon ci-star-filled active"></i>
                          @endfor
                          @if(strpos($item->average_rating, '.5'))
                          <i class="star-rating-icon ci-star-half active"></i>
                            @for($i; $i < 4; $i++)
                            <i class="star-rating-icon ci-star"></i>
                            @endfor
                          @else
                            @for($i; $i < 5; $i++)
                            <i class="star-rating-icon ci-star"></i>
                            @endfor    
                          @endif
                          
                        </div>
                      </div>
                      <h3 class="product-title fs-sm mb-2"><a href="{{url('penjual/'.$item->user->username.'/item/'.$item->slug)}}">
                          {{$item->name}}</a></a></h3>
                      <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>{{$item->sold}}<span class="fs-xs ms-1">Sales</span></div>
                        <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">
                            {{$item->price_format}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @empty
                  <p class="text-muted text-center">
                    Tidak Ada Data Masih Kosong Bos.
                  </p>   
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </section>