<header class="bg-light shadow-sm navbar-sticky">
    <div class="navbar navbar-expand-lg navbar-light">
      <div class="container"><a class="navbar-brand d-none d-sm-block flex-shrink-0 me-4 order-lg-1" href="{{url('/')}}">
        <img src="{{url('assets/img/logo-dark.png')}}" width="142" alt="{{config('app.name')}}"></a><a class="navbar-brand d-sm-none me-2 order-lg-1" href="index.html"><img src="{{url('assets/img/logo-icon.png')}}" width="74" alt="{{config('app.name')}}"></a>
        <!-- Toolbar-->
        <div class="navbar-toolbar d-flex align-items-center order-lg-3">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>
          @if (Auth::user())
          <div class="navbar-tool dropdown ms-2"><a class="navbar-tool-icon-box border dropdown-toggle" href="dashboard-sales.html"><img src="{{url('assets/img/marketplace/account/avatar-sm.png')}}" width="32" alt="{{Auth::user()->name}}"></a><a class="navbar-tool-text ms-n1" href="dashboard-sales.html"><small>{{Auth::user()->name}}</small>Rp{{Auth::user()->balance}}</a>
            <div class="dropdown-menu dropdown-menu-end">
              <div style="min-width: 14rem;">
                <h6 class="dropdown-header">Account</h6><a class="dropdown-item d-flex align-items-center" href="dashboard-settings.html"><i class="ci-settings opacity-60 me-2"></i>Settings</a><a class="dropdown-item d-flex align-items-center" href="dashboard-purchases.html"><i class="ci-basket opacity-60 me-2"></i>Purchases</a><a class="dropdown-item d-flex align-items-center" href="dashboard-favorites.html"><i class="ci-heart opacity-60 me-2"></i>Favorites<span class="fs-xs text-muted ms-auto">4</span></a>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Seller Dashboard</h6><a class="dropdown-item d-flex align-items-center" href="dashboard-sales.html"><i class="ci-dollar opacity-60 me-2"></i>Sales<span class="fs-xs text-muted ms-auto">$1,375.00</span></a><a class="dropdown-item d-flex align-items-center" href="dashboard-products.html"><i class="ci-package opacity-60 me-2"></i>Products<span class="fs-xs text-muted ms-auto">5</span></a><a class="dropdown-item d-flex align-items-center" href="dashboard-add-new-product.html"><i class="ci-cloud-upload opacity-60 me-2"></i>Add New Product</a><a class="dropdown-item d-flex align-items-center" href="dashboard-payouts.html"><i class="ci-currency-exchange opacity-60 me-2"></i>Payouts</a>
                <div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center" href="account-signin.html"><i class="ci-sign-out opacity-60 me-2"></i>Sign Out</a>
              </div>
            </div>
          </div>
          @else
          <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="#signin-modal" data-bs-toggle="modal">
            <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
            <div class="navbar-tool-text ms-n3"><small>Hello, Sign in</small>My Account</div>
          </a>
          @endif
          <div class="navbar-tool ms-4"><a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{route('cart')}}">
            <span class="navbar-tool-label" id="total_cart">{{Cart::getTotalQuantity()}}</span><i class="navbar-tool-icon ci-cart"></i></a></div>
        </div>
        <div class="collapse navbar-collapse me-auto order-lg-2" id="navbarCollapse">
          <!-- Search-->
          <div class="input-group d-lg-none my-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
            <input class="form-control rounded-start" type="text" placeholder="Search marketplace">
          </div>
          <!-- Categories dropdown-->
          <ul class="navbar-nav navbar-mega-nav pe-lg-2 me-lg-2">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle ps-lg-0" href="#" data-bs-toggle="dropdown"><i class="ci-menu align-middle mt-n1 me-2"></i>Categories</a>
              
              <ul class="dropdown-menu py-1">
                @php
                 $categories = App\Models\Category::whereHas('status', function($q){
                   return $q->where('id',1);
                 })->get();   
                @endphp
                @forelse ($categories as $category)
                <li class="dropdown">
                  <a class="dropdown-item dropdown-toggle" href="{{url('category/'.$category->slug)}}" data-bs-toggle="dropdown">
                    {{$category->name}}
                  </a>
                  @if ($category->subcategories()->count() !== 0)
                  <ul class="dropdown-menu">                   
                      <li class="dropdown-item product-title fw-medium"><a href="{{url('category/'.$category->slug)}}">Semua {{$category->name}}<i class="ci-arrow-right fs-xs ms-1"></i></a></li>
                      <li class="dropdown-divider"></li>
                    @foreach ($category->subcategories as $item)     
                    <li><a class="dropdown-item" href="{{url('category/'.$category->slug.'/subcategory/'.$item->slug)}}">{{$item->name}}</a></li>
                    @endforeach
                  </ul>
                  @endif
                </li>
                @empty
                @endforelse
              </ul>
            </li>
          </ul>
          
            
          <div class="input-group d-none d-lg-flex mx-4">
            <input class="form-control rounded-end pe-5" type="text" placeholder="Search for products"><i class="ci-search position-absolute top-50 end-0 translate-middle-y text-muted fs-base me-3"></i>
          </div>
          <!-- Primary menu-->
        </div>
      </div>
    </div>
    <!-- Search collapse-->
</header>