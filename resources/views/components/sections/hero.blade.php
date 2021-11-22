
    <section class="bg-accent bg-position-top-center bg-repeat-0 py-5" style="background-image: url(img/home/marketplace-hero.jpg);">
        <div class="pb-lg-5 mb-lg-3">
          <div class="container py-lg-5 my-lg-5">
            <div class="row mb-4 mb-sm-5">
              <div class="col-lg-7 col-md-9 text-center text-sm-start">
                <h1 class="text-white lh-base">{{$title}}</h1>
                <h2 class="h5 text-white fw-light">{{$subtitle}}</h2>
              </div>
            </div>
            <div class="row pb-lg-5 mb-4 mb-sm-5">
              <div class="col-lg-6 col-md-8">
                <form method="POST" action="{{route('welcome.search')}}">
                <div class="input-group input-group-lg flex-nowrap"><i class="ci-search position-absolute top-50 translate-middle-y ms-3"></i>
                  @csrf
                  <input style="padding-left: 50px" class="form-control rounded-start" type="text" name="search" placeholder="Start your search">
                  <button class="btn btn-primary btn-lg dropdown-toggle fs-base" type="button" data-bs-toggle="dropdown">All categories</button>
                  <div class="dropdown-menu dropdown-menu-end my-1">
                    @foreach($recomended_categories as $cat)
                    <a class="dropdown-item" href="{{url('category/'.$cat->slug)}}">{{$cat->name}}</a>
                    @endforeach
                    <a class="dropdown-item" href="#">Lihat Semua</a>
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </section>