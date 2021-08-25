
    <section class="container mb-3 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Content-->
            <section class="col-lg-8 pt-2 pt-lg-4 pb-4 mb-lg-3">
              <div class="pt-3 px-4 pe-lg-0 ps-xl-5">
                <!-- Product gallery-->
                <div class="gallery">
                  <a class="gallery-item rounded-3 mb-grid-gutter" href="{{url('assets/img/marketplace/single/01.jpg')}}" data-sub-html="&lt;h6 class=&quot;fs-sm text-light&quot;&gt;Simple iPhone X Mockups&lt;/h6&gt;">
                    <img src="{{url('assets/img/marketplace/single/01.jpg')}}" alt="Gallery preview">
                    <span class="gallery-item-caption">Simple iPhone X Mockups</span>
                  </a>
                  <div class="row">
                    @foreach ($item->images() as $image)
                    <div class="col-4">
                        <a class="gallery-item rounded-3 mb-grid-gutter" href="{{url('assets/img/marketplace/single/02.jpg')}}" data-sub-html="&lt;h6 class=&quot;fs-sm text-light&quot;&gt;UI Psd iPhone X Monochrome&lt;/h6&gt;">
                            <img src="{{url('assets/img/marketplace/single/02.jpg')}}" alt="Gallery preview">
                            <span class="gallery-item-caption">UI Psd iPhone X Monochrome</span>
                        </a>
                    </div>    
                    
                    <div class="col-4">
                        <a class="gallery-item rounded-3 mb-grid-gutter" href="{{url('assets/img/marketplace/single/02.jpg')}}" data-sub-html="&lt;h6 class=&quot;fs-sm text-light&quot;&gt;UI Psd iPhone X Monochrome&lt;/h6&gt;">
                            <img src="{{url('assets/img/marketplace/single/02.jpg')}}" alt="Gallery preview">
                            <span class="gallery-item-caption">UI Psd iPhone X Monochrome</span>
                        </a>
                    </div>    
                    
                    <div class="col-4">
                        <a class="gallery-item rounded-3 mb-grid-gutter" href="{{url('assets/img/marketplace/single/02.jpg')}}" data-sub-html="&lt;h6 class=&quot;fs-sm text-light&quot;&gt;UI Psd iPhone X Monochrome&lt;/h6&gt;">
                            <img src="{{url('assets/img/marketplace/single/02.jpg')}}" alt="Gallery preview">
                            <span class="gallery-item-caption">UI Psd iPhone X Monochrome</span>
                        </a>
                    </div>    
                    @endforeach
                </div>
                </div>
                <!-- Wishlist + Sharing-->
                <div class="d-flex flex-wrap justify-content-between align-items-center border-top pt-3">
                  <div class="py-2 me-2">
                    <button class="btn btn-outline-accent" type="button"><i class="ci-heart fs-lg me-2"></i>Add to Favorites</button>
                  </div>
                  <div class="py-2"><i class="ci-share-alt fs-lg align-middle text-muted me-2"></i><a class="btn-social bs-outline bs-facebook bs-sm ms-2" href="#"><i class="ci-facebook"></i></a><a class="btn-social bs-outline bs-twitter bs-sm ms-2" href="#"><i class="ci-twitter"></i></a><a class="btn-social bs-outline bs-pinterest bs-sm ms-2" href="#"><i class="ci-pinterest"></i></a><a class="btn-social bs-outline bs-instagram bs-sm ms-2" href="#"><i class="ci-instagram"></i></a></div>
                </div>
              </div>
            </section>
            <!-- Sidebar-->
            <aside class="col-lg-4 ps-xl-5">
              <hr class="d-lg-none">
              <div class="bg-white h-100 p-4 ms-auto border-start">
                <div class="px-lg-2">
                    <div class="mb-3">
                        <span class="h3 fw-normal text-accent me-1">
                            {{$item->price_format}}
                        </span>
                    </div>
                  <hr>
                  <button class="btn btn-primary btn-shadow d-block w-100 mt-4" type="button" data-id="{{$item->id}}" id="tambah_keranjang_belanja"><i class="ci-cart fs-lg me-2"></i>Tambahkan Ke Keranjang</button>
                  <a href="{{url('chat/'.$item->user->username)}}" class="btn btn-success btn-shadow d-block w-100 mt-4"><i class="ci-chat fs-lg me-2"></i>Hubungi Penjual</a>
                  <div class="bg-secondary rounded p-3 mt-4 mb-2"><a class="d-flex align-items-center" href="{{url($item->user->username)}}"><img class="rounded-circle" src="{{url('assets/img/testimonials/01.jpg')}}" width="50" alt="{{$item->user->name}}">
                      <div class="ps-2"><span class="fs-ms text-muted">Created by</span>
                        <h6 class="fs-sm mb-0">{{$item->user->name}}</h6>
                      </div></a></div>
                  <div class="bg-secondary rounded p-3 mb-2"><i class="ci-download h5 text-muted align-middle mb-0 mt-n1 me-2"></i><span class="d-inline-block h6 mb-0 me-1">715</span><span class="fs-sm">Terjual</span></div>
                  <div class="bg-secondary rounded p-3 mb-4">
                    @include('components.shops.stars.default',['rating' => $item->average_rating])
                    <span class="fs-ms ms-2">{{$item->average_rating}}/5</span>
                    <div class="fs-ms text-muted">Berdasarkan dari {{count($item->reviews)}} reviews</div>
                  </div>
                  <ul class="list-unstyled fs-sm">
                    <li class="d-flex justify-content-between mb-3 pb-3 border-bottom"><span class="text-dark fw-medium">Update</span><span class="text-muted">{{$item->updated_at}}</span></li>
                    <li class="d-flex justify-content-between mb-3 pb-3 border-bottom"><span class="text-dark fw-medium">Rilis</span><span class="text-muted">{{$item->created_at}}</span></li>
                    <li class="d-flex justify-content-between mb-3 pb-3 border-bottom"><span class="text-dark fw-medium">Kategori</span><a class="product-meta" href="#">{{}}</a></li>
                  </ul>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </section>