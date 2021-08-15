@extends('layouts.app')
@section('main')
    <main class="page-wrapper">
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      @include('components.headers.default')
      <!-- Dashboard header-->
      @include('components.users.pagetitle')
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            @include('components.profiles.aside')
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
                <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                  <!-- Title-->
                  <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom">
                    <h2 class="h3 py-2 me-2 text-center text-sm-start">Pembelian</h2>
                    <div class="py-2">
                      <div class="d-flex flex-nowrap align-items-center pb-3">
                        <label class="form-label fw-normal text-nowrap mb-0 me-2" for="sorting">Sort by:</label>
                        <select class="form-select form-select-sm me-2" id="sorting">
                          <option>Date Purchased</option>
                          <option>Product Name</option>
                          <option>Price</option>
                          <option>Your Rating</option>
                          <option>Updates</option>
                        </select>
                        <button class="btn btn-outline-secondary btn-sm px-2" type="button"><i class="ci-arrow-up"></i></button>
                      </div>
                    </div>
                  </div>
                  <!-- Products list-->
                  <!-- Product-->
                  @foreach($items as $item)
                  <div class="d-block d-sm-flex align-items-center py-4 border-bottom"><a class="d-block mb-3 mb-sm-0 me-sm-4 ms-sm-0 mx-auto" href="marketplace-single.html" style="width: 12.5rem;"><img class="rounded-3" src="img/marketplace/products/th01.jpg" alt="Product"></a>
                    <div class="text-center text-sm-start">
                      <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">{{}}</a></h3>
                      <div class="text-accent fs-sm mb-1">Standard license</div>
                      <div class="form-check d-table text-start mx-auto mx-sm-0">
                        <input class="form-check-input" type="checkbox" id="update-info-1" checked>
                        <label class="form-check-label fs-ms" for="update-info-1">Notify me when this product is updated</label>
                      </div>
                      <div class="d-flex align-items-center justify-content-center justify-content-sm-start pt-2">
                        <div class="my-2">
                          <button class="btn btn-primary btn-sm me-3" type="button"><i class="ci-download me-1"></i>Download</button>
                        </div><a class="d-block text-muted text-center my-2" href="#">
                          <div class="star-rating"><i class="star-rating-icon ci-star"></i><i class="star-rating-icon ci-star"></i><i class="star-rating-icon ci-star"></i><i class="star-rating-icon ci-star"></i><i class="star-rating-icon ci-star"></i>
                          </div>
                          <div class="fs-xs">Reate this product</div></a>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  <!-- Pagination-->
                  <nav class="d-md-flex justify-content-between align-items-center text-center text-md-start mt-4" aria-label="Page navigation">
                    <div class="d-md-flex align-items-center w-100"><span class="fs-sm text-muted me-md-3">Showing 5 of 9 products</span>
                      <div class="progress w-100 my-3 mx-auto mx-md-0" style="max-width: 10rem; height: 4px;">
                        <div class="progress-bar" role="progressbar" style="width: 56%;" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                    <button class="btn btn-outline-primary btn-sm" type="button">More products</button>
                  </nav>
                </div>
              </section>
          </div>
        </div>
      </div>
    </main>
@endsection