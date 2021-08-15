<section class="container mb-4 mb-lg-5">
    <!-- Nav tabs-->
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item"><a class="nav-link p-4 active" href="#details" data-bs-toggle="tab" role="tab">Deskripsi</a></li>
      <li class="nav-item"><a class="nav-link p-4" href="#reviews" data-bs-toggle="tab" role="tab">Reviews</a></li>
    </ul>
    <div class="tab-content pt-2">
      <!-- Product details tab-->
      <div class="tab-pane fade show active" id="details" role="tabpanel">
        <div class="row">
          <div class="col-lg-8">
            {!! $item->description !!}
          </div>
        </div>
      </div>
      <!-- Reviews tab-->
      <div class="tab-pane fade" id="reviews" role="tabpanel">
        <!-- Reviews-->
        <div class="row pt-2 pb-3">
          <div class="col-lg-4 col-md-5">
            <h3 class="h4 mb-4">{{count($item->reviews)}} Reviews</h3>
            @include('components.shops.stars.blue', ['rating' => $item->average_rating])
            <span class="d-inline-block align-middle">{{$item->average_rating}} rata-rata</span>
          </div>
          <div class="col-lg-8 col-md-7">
            <div class="d-flex align-items-center mb-2">
              <div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">5</span><i class="ci-star-filled fs-xs ms-1"></i></div>
              <div class="w-100">
                <div class="progress" style="height: 4px;">
                  <div class="progress-bar bg-success" role="progressbar" style="width: {{($item->getPercentage(5))}}%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="{{$item->getCountReview()}}"></div>
                </div>
              </div><span class="text-muted ms-3">{{$item->getCountReview(5)}}</span>
            </div>
            <div class="d-flex align-items-center mb-2">
              <div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">4</span><i class="ci-star-filled fs-xs ms-1"></i></div>
              <div class="w-100">
                <div class="progress" style="height: 4px;">
                  <div class="progress-bar" role="progressbar" style="width:  {{($item->getPercentage(4))}}%; background-color: #a7e453;" aria-valuenow="27" aria-valuemin="0" aria-valuemax="{{$item->getCountReview()}}"></div>
                </div>
              </div><span class="text-muted ms-3">{{$item->getCountReview(4)}}</span>
            </div>
            <div class="d-flex align-items-center mb-2">
              <div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">3</span><i class="ci-star-filled fs-xs ms-1"></i></div>
              <div class="w-100">
                <div class="progress" style="height: 4px;">
                  <div class="progress-bar" role="progressbar" style="width:  {{($item->getPercentage(3))}}%; background-color: #ffda75;" aria-valuenow="17" aria-valuemin="0" aria-valuemax="{{$item->getCountReview()}}"></div>
                </div>
              </div><span class="text-muted ms-3">{{$item->getCountReview(3)}}</span>
            </div>
            <div class="d-flex align-items-center mb-2">
              <div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">2</span><i class="ci-star-filled fs-xs ms-1"></i></div>
              <div class="w-100">
                <div class="progress" style="height: 4px;">
                  <div class="progress-bar" role="progressbar" style="width: {{($item->getPercentage(2))}}%; background-color: #fea569;" aria-valuenow="{{$item->getCountReview(2)}}" aria-valuemin="0" aria-valuemax="{{$item->getCountReview()}}"></div>
                </div>
              </div><span class="text-muted ms-3">{{$item->getCountReview(2)}}</span>
            </div>
            <div class="d-flex align-items-center">
              <div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">1</span><i class="ci-star-filled fs-xs ms-1"></i></div>
              <div class="w-100">
                <div class="progress" style="height: 4px;">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: {{($item->getPercentage(1))}}%;" aria-valuenow="{{$item->getCountReview(1)}}" aria-valuemin="0" aria-valuemax="{{$item->getCountReview()}}"></div>
                </div>
              </div><span class="text-muted ms-3">{{$item->getCountReview(1)}}</span>
            </div>
          </div>
        </div>
        <hr class="mt-4 mb-3">
        <div class="row py-4">
          <!-- Reviews list-->
          <div class="col-md-7">
            <!-- Review-->
            @forelse ($item->reviews()->take(5)->get() as $review)
                
            <div class="product-review pb-4 mb-4 border-bottom">
              <div class="d-flex mb-3">
                <div class="d-flex align-items-center me-4 pe-2"><img class="rounded-circle" src="{{url('assets/img/shop/reviews/01.jpg')}}" width="50" alt="{{$item->user->name}}">
                  <div class="ps-3">
                    <h6 class="fs-sm mb-0">{{$review->user->name}}</h6><span class="fs-ms text-muted">{{$review->created_at}}</span>
                  </div>
                </div>
                <div>  
                  @include('components.shops.stars.default', ['rating' => $review->rating])
                </div>
              </div>
              <p class="fs-md mb-2">
                  {{$review->comment}}
              </p>
            </div>
            @empty
                <span>Belum ada review yang diberikan</span>
            @endforelse
          </div>
          <!-- Leave review form-->
          <div class="col-md-5 mt-2 pt-4 mt-md-0 pt-md-0">
            <div class="bg-secondary py-grid-gutter px-grid-gutter rounded-3">
              <h3 class="h4 pb-2">Berikan review</h3>
              @if(session('success'))              
              <!-- Success alert -->
              @include('components.alerts.success', ['message' => session('success')])
              @endif
              @if(session('error'))              
              <!-- Success alert -->
              @include('components.alerts.danger', ['message' => session('error')])
              @endif
              <form class="needs-validation" action="{{route('review.store', ['id' => $item->id])}}" method="post" >
                @csrf
                <div class="mb-3">
                  <label class="form-label" for="review-rating">Rating<span class="text-danger">*</span></label>
                  <select class="form-select" name="rating" required id="review-rating">
                    <option value="">Choose rating</option>
                    <option value="5">5 stars</option>
                    <option value="4">4 stars</option>
                    <option value="3">3 stars</option>
                    <option value="2">2 stars</option>
                    <option value="1">1 star</option>
                  </select>
                  @error('rating')
                  <div class="invalid-feedback">{{ $message }}</div>    
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label" for="review-text">Review<span class="text-danger">*</span></label>
                  <textarea class="form-control" name="review" minlength="10" maxlength="255" rows="6" required id="review-text"></textarea>
                  @error('review')
                  <div class="invalid-feedback">{{ $message }}</div>    
                  @enderror
                  <small class="form-text text-muted">Minimal memiliki 10 karakter.</small>
                </div>
                <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Submit a Review</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Comments tab-->
    </div>
  </section>