@extends('layouts.app')
@section('main')
    <main class="page-wrapper">
      <!-- Navbar Marketplace-->
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      @include('components.headers.default')
      <!-- Header-->
      <div class="page-title-overlap bg-accent pt-4">
        <div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
          <div class="d-flex align-items-center pb-3">
            @if($user->profile)
            <div class="img-thumbnail rounded-circle flex-shrink-0" ><img style="width: 6.375rem; height: 6.375rem; object-fit:cover;" class="rounded-circle" style="" src="{{Storage::url($user->profile->name)}}" alt="{{$user->profile->caption}}"></div>
            @else
            <div class="img-thumbnail rounded-circle flex-shrink-0" ><img style="width: 6.375rem; height: 6.375rem; object-fit:cover;" class="rounded-circle" style="" src="{{url('assets/img/marketplace/account/avatar.png')}}" alt="Demo"></div>
            @endif
            <div class="ps-3">
              <h3 class="text-light fs-lg mb-0">{{$user->username}}</h3><span class="d-block text-light fs-ms opacity-60 py-1">Member sejak {{$user->created_at}}</span><span class="badge bg-success"><i class="ci-check me-1"></i>Penjual Terverifikasi</span>
            </div>
          </div>
          <div class="d-flex">
            <div class="text-sm-end me-5">
              <div class="text-light fs-base">Total penjualan</div>
              @php  
              $penjual = App\Models\Purchase::where([
                ['status','!=','pending'],
                ['status', '!=', 'waiting'],
                ['status', '!=', 'failed'],
              ])->whereHas('item', function($q) use($user){
                $q->where('user_id', $user->id);
              })->get();
              @endphp
              <h3 class="text-light">{{$penjual->count()}}</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
          <!-- Sidebar-->
          <aside class="col-lg-4">
            <!-- Sidebar-->
            <div class="offcanvas offcanvas-collapse bg-white w-100 rounded-3 shadow-lg py-1" id="shop-sidebar" style="max-width: 22rem;">
              <div class="offcanvas-header align-items-center shadow-sm">
                <h2 class="h5 mb-0">Filters</h2>
                <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body py-grid-gutter px-lg-grid-gutter">
                <!-- Categories-->
                <div class="widget widget-categories mb-4 pb-4 border-bottom">
                  <h3 class="widget-title">Kategori</h3>
                  <div class="accordion mt-n1" id="shop-categories">
                    @foreach($categories as $index => $cat)
                    <div class="accordion-item">
                        <h3 class="accordion-header"><a class="accordion-button @if($index != 0) collapsed @endif" href="#{{$cat->slug}}" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="{{$cat->slug}}">{{$cat->name}}</a></h3>
                        <div class="accordion-collapse collapse @if($index == 0) show @endif" id="{{$cat->slug}}" data-bs-parent="#shop-categories">
                        <div class="accordion-body">
                            <div class="widget widget-links widget-filter">
                            <ul class="widget-list widget-filter-list pt-1" style="height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                                @foreach ($cat->subcategories as $sub)
                                <li class="widget-list-item widget-filter-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="#"><span class="widget-filter-item-text">{{$sub->name}}</span><span class="fs-xs text-muted ms-3">{{$sub->items->count()}}</span></a></li>
                                @endforeach
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </aside>
          <!-- Content  -->
          @include('components.sections.vendors.product',['items' => $items])
        </div>
      </div>
    </main>
@endsection