@extends('layouts.app')
@section('main')
    
<main class="page-wrapper">
    <!-- Navbar Marketplace-->
    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
    @include('components.headers.default')
    <!-- Hero section-->
    @include('components.sections.hero', ['title' => $setting->title, 'subtitle' => $setting->description])
    <!-- Featured products (Carousel)-->
    @include('components.sections.recomended',['items' => $items])
    <!-- Recent products grid-->
    <section class="container pb-5 mb-lg-3">
      <!-- Heading-->
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 me-2">The most recent releases</h2>
        <div class="pt-3">
          <select class="form-select me-2">
            <option>All categories</option>
            <option>Photos</option>
            <option>Graphics</option>
            <option>UI Design</option>
            <option>Web Themes</option>
            <option>Fonts</option>
            <option>Add-Ons</option>
          </select>
        </div>
      </div>
      <!-- Grid-->
      <div class="row pt-2 mx-n2">
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
          <!-- Product-->
          <div class="card product-card-alt">
            <div class="product-thumb">
              <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
              </div><a class="product-thumb-overlay" href="marketplace-single.html"></a><img src="img/marketplace/products/01.jpg" alt="Product">
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted fs-xs me-1">by <a class="product-meta fw-medium" href="#">Createx Std. </a>in <a class="product-meta fw-medium" href="#">UI Design</a></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-half active"></i><i class="star-rating-icon ci-star"></i>
                </div>
              </div>
              <h3 class="product-title fs-sm mb-2"><a href="marketplace-single.html">Square Style Mobile UI Kit (Sketch)</a></h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>153<span class="fs-xs ms-1">Sales</span></div>
                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$24.<small>00</small></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
          <div class="card product-card-alt">
            <div class="product-thumb">
              <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
              </div><a class="product-thumb-overlay" href="marketplace-single.html"></a><img src="img/marketplace/products/04.jpg" alt="Product">
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted fs-xs me-1">by <a class="product-meta fw-medium" href="#">Createx Std. </a>in <a class="product-meta fw-medium" href="#">Graphics</a></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                </div>
              </div>
              <h3 class="product-title fs-sm mb-2"><a href="marketplace-single.html">Flat-line E-Commerce Icons (AI)</a></h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>26<span class="fs-xs ms-1">Sales</span></div>
                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$18.<small>00</small></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
          <div class="card product-card-alt">
            <div class="product-thumb">
              <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
              </div><a class="product-thumb-overlay" href="marketplace-single.html"></a><img src="img/marketplace/products/09.jpg" alt="Product">
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted fs-xs me-1">by <a class="product-meta fw-medium" href="#">pixels </a>in <a class="product-meta fw-medium" href="#">UI Design</a></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                </div>
              </div>
              <h3 class="product-title fs-sm mb-2"><a href="marketplace-single.html">Isometric Device Mockups (PSD)</a></h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>36<span class="fs-xs ms-1">Sales</span></div>
                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$16.<small>00</small></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
          <div class="card product-card-alt">
            <div class="product-thumb">
              <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
              </div><a class="product-thumb-overlay" href="marketplace-single.html"></a><img src="img/marketplace/products/10.jpg" alt="Product">
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted fs-xs me-1">by <a class="product-meta fw-medium" href="#">theDesigner </a>in <a class="product-meta fw-medium" href="#">Graphics</a></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                </div>
              </div>
              <h3 class="product-title fs-sm mb-2"><a href="marketplace-single.html">Coffe Paper Cup Mockup</a></h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>57<span class="fs-xs ms-1">Sales</span></div>
                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$10.<small>00</small></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
          <div class="card product-card-alt">
            <div class="product-thumb">
              <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
              </div><a class="product-thumb-overlay" href="marketplace-single.html"></a><img src="img/marketplace/products/06.jpg" alt="Product">
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted fs-xs me-1">by <a class="product-meta fw-medium" href="#">Createx Std. </a>in <a class="product-meta fw-medium" href="#">Graphics</a></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                </div>
              </div>
              <h3 class="product-title fs-sm mb-2"><a href="marketplace-single.html">Travel &amp; Landmark Icon Pack (AI)</a></h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>21<span class="fs-xs ms-1">Sales</span></div>
                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$17.<small>00</small></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
          <div class="card product-card-alt">
            <div class="product-thumb">
              <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
              </div><a class="product-thumb-overlay" href="marketplace-single.html"></a><img src="img/marketplace/products/05.jpg" alt="Product">
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted fs-xs me-1">by <a class="product-meta fw-medium" href="#">Createx Std. </a>in <a class="product-meta fw-medium" href="#">UI Design</a></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                </div>
              </div>
              <h3 class="product-title fs-sm mb-2"><a href="marketplace-single.html">Minimal Mobile App UI Kit (Sketch)</a></h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>117<span class="fs-xs ms-1">Sales</span></div>
                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$23.<small>00</small></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
          <div class="card product-card-alt">
            <div class="product-thumb">
              <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
              </div><a class="product-thumb-overlay" href="marketplace-single.html"></a><img src="img/marketplace/products/11.jpg" alt="Product">
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted fs-xs me-1">by <a class="product-meta fw-medium" href="#">pixels </a>in <a class="product-meta fw-medium" href="#">Graphics</a></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-half active"></i><i class="star-rating-icon ci-star"></i><i class="star-rating-icon ci-star"></i>
                </div>
              </div>
              <h3 class="product-title fs-sm mb-2"><a href="marketplace-single.html">Printed T-Shirt Mockup (PSD)</a></h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>94<span class="fs-xs ms-1">Sales</span></div>
                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$12.<small>00</small></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter">
          <div class="card product-card-alt">
            <div class="product-thumb">
              <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
              </div><a class="product-thumb-overlay" href="marketplace-single.html"></a><img src="img/marketplace/products/12.jpg" alt="Product">
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted fs-xs me-1">by <a class="product-meta fw-medium" href="#">pixels </a>in <a class="product-meta fw-medium" href="#">Graphics</a></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                </div>
              </div>
              <h3 class="product-title fs-sm mb-2"><a href="marketplace-single.html">Corporate Branding Mockup (PSD)</a></h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>122<span class="fs-xs ms-1">Sales</span></div>
                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$18.<small>00</small></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- More button-->
      <div class="text-center"><a class="btn btn-outline-accent" href="marketplace-category.html">View more products<i class="ci-arrow-right fs-ms ms-1"></i></a></div>
    </section>
    <!-- Seller of the month-->
    <section class="border-top py-5">
      <div class="container py-lg-2">
        <h2 class="h3 mb-3 pb-3 pb-lg-4 text-center text-lg-start">Seller of the month</h2>
        <div class="row">
          <div class="col-lg-4 text-center text-lg-start pb-3 pt-lg-2">
            <div class="d-inline-block text-start">
              <div class="d-flex align-items-center pb-3">
                <div class="img-thumbnail rounded-circle flex-shrink-0" style="width: 6.375rem;"><img class="rounded-circle" src="img/marketplace/account/avatar.png" alt="Createx Studio"></div>
                <div class="ps-3">
                  <h3 class="fs-lg mb-0">Createx Studio</h3><span class="d-block text-muted fs-ms pt-1 pb-2">Member since November 2019</span><a class="btn btn-primary btn-sm" href="marketplace-vendor.html">View products</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="tns-carousel">
              <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;gutter&quot;: 16, &quot;controls&quot;: false, &quot;nav&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}}}">
                <div>
                  <div class="card product-card-alt">
                    <div class="product-thumb">
                      <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                      <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                        <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                      </div><a class="product-thumb-overlay" href="marketplace-single.html"></a><img src="img/marketplace/products/13.jpg" alt="Product">
                    </div>
                    <div class="card-body">
                      <h3 class="product-title fs-sm mb-2"><a href="marketplace-single.html">Hardcover Book Catalog Mockup</a></h3>
                      <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>39<span class="fs-xs ms-1">Sales</span></div>
                        <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$12.<small>00</small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="card product-card-alt">
                    <div class="product-thumb">
                      <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                      <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                        <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                      </div><a class="product-thumb-overlay" href="marketplace-single.html"></a><img src="img/marketplace/products/14.jpg" alt="Product">
                    </div>
                    <div class="card-body">
                      <h3 class="product-title fs-sm mb-2"><a href="marketplace-single.html">Top View Smartwatch 3D Render</a></h3>
                      <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>28<span class="fs-xs ms-1">Sales</span></div>
                        <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$14.<small>00</small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="card product-card-alt">
                    <div class="product-thumb">
                      <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                      <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="marketplace-single.html"><i class="ci-eye"></i></a>
                        <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                      </div><a class="product-thumb-overlay" href="marketplace-single.html"></a><img src="img/marketplace/products/07.jpg" alt="Product">
                    </div>
                    <div class="card-body">
                      <h3 class="product-title fs-sm mb-2"><a href="marketplace-single.html">Gravity Device Mockups (PSD)</a></h3>
                      <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="fs-sm me-2"><i class="ci-download text-muted me-1"></i>234<span class="fs-xs ms-1">Sales</span></div>
                        <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$16.<small>00</small></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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