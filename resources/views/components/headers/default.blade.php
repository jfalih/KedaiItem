<header class="bg-light shadow-sm navbar-sticky">
    <div class="navbar navbar-expand-lg navbar-light">
      <div class="container"><a class="navbar-brand d-none d-sm-block flex-shrink-0 me-4 order-lg-1" href="{{url('/')}}">
        @if(\App\Models\Setting::first())
          @if(\App\Models\Setting::first()->logo)
          <img src="{{Storage::url(\App\Models\Setting::first()->logo->name)}}" width="54" alt="{{\App\Models\Setting::first()->name}}"></a>
          <a class="navbar-brand d-sm-none me-2 order-lg-1" href="{{route('welcome')}}">
            <img src="{{Storage::url(\App\Models\Setting::first()->logo->name)}}" width="74" alt="{{\App\Models\Setting::first()->name}}"></a>
          @endif
        @else
        <img src="{{url('assets/img/logo-dark.png')}}" width="142" alt="{{config('app.name')}}"></a>
        <a class="navbar-brand d-sm-none me-2 order-lg-1" href="{{route('welcome')}}"><img src="{{url('assets/img/logo-dark.png')}}" width="74" alt="{{config('app.name')}}"></a>
        @endif
        <!-- Toolbar-->
        <div class="navbar-toolbar d-flex align-items-center order-lg-3">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>
          @if (Auth::user())
          <div class="navbar-tool dropdown ms-2">
            <a class="navbar-tool-icon-box border dropdown-toggle" href="{{route('pengaturan')}}">
              @if(Auth::user()->profile != null)
              <img class="rounded-circle" style="width:32px;height:32px;object-fit: cover" src="{{Storage::url(Auth::user()->profile->name)}}">
              @else
              <img class="rounded-circle" style="width:32px;height:32px;object-fit: cover" src="{{url('assets/img/marketplace/account/avatar.png')}}">
              @endif
            </a>
            <a class="navbar-tool-text ms-n1" href="{{route('pengaturan')}}">
              <small>{{Auth::user()->name}}</small>
              Rp{{Auth::user()->balance}}
            </a>
            <div class="dropdown-menu dropdown-menu-end">
              <div style="min-width: 14rem;">
                <h6 class="dropdown-header">Akun</h6>
                <a class="dropdown-item d-flex align-items-center" href="{{route('pengaturan')}}">
                  <i class="ci-settings opacity-60 me-2"></i>Pengaturan
                </a>
                <a class="dropdown-item d-flex align-items-center" href="{{route('pembelian')}}">
                  <i class="ci-basket opacity-60 me-2"></i>Pembelian
                </a>
                <a class="dropdown-item d-flex align-items-center" href="{{route('chat')}}">
                  <i class="ci-chat opacity-60 me-2"></i>Chat
                </a>
                @if(in_array('reseller',Auth::user()->role_name))
                  <div class="dropdown-divider"></div>
                  <h6 class="dropdown-header">Seller Dashboard</h6>
                  <a class="dropdown-item d-flex align-items-center" href="{{route('reseller.penjualan')}}">
                    <i class="ci-dollar opacity-60 me-2"></i>Penjualan<span class="fs-xs text-muted ms-auto">Rp0</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="{{route('reseller.product')}}">
                    <i class="ci-package opacity-60 me-2"></i>Produk<span class="fs-xs text-muted ms-auto">{{Auth::user()->items->count()}}</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="{{route('reseller.product.add')}}">
                    <i class="ci-cloud-upload opacity-60 me-2"></i>Add New Product</a>
                    <a class="dropdown-item d-flex align-items-center" href="{{route('reseller.payout')}}">
                      <i class="ci-currency-exchange opacity-60 me-2"></i>Payouts</a>
                @endif
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}"><i class="ci-sign-out opacity-60 me-2"></i>Sign Out</a>
              </div>
            </div>
          </div>
          @else
          <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="{{route('login')}}">
            <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
            <div class="navbar-tool-text ms-n3"><small>Hello, Sign in</small>My Account</div>
          </a>
          @endif
          <div class="navbar-tool ms-4"><a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{route('cart')}}">
            <span class="navbar-tool-label" id="total_cart">{{Cart::getTotalQuantity()}}</span><i class="navbar-tool-icon ci-cart"></i></a></div>
        </div>
        <div class="collapse navbar-collapse me-auto order-lg-2" id="navbarCollapse">
          <!-- Search-->
          <form class="input-group d-lg-none my-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
            @csrf
            <input class="form-control rounded-start" name="search" type="text" placeholder="Cari Disini..">
          </form>
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
                  <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown">
                    {{$category->name}}
                  </a>
                  @if ($category->subcategories()->count() !== 0)
                  <ul class="dropdown-menu">
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
          
            <form class="input-group d-none d-lg-flex mx-4" method="POST" action="{{route('welcome.search')}}">
              @csrf
              <input class="form-control rounded-end pe-5" name="search" type="text" placeholder="Cari Disini.."><i class="ci-search position-absolute top-50 end-0 translate-middle-y text-muted fs-base me-3"></i>
            </form>
          <!-- Primary menu-->
        </div>
      </div>
    </div>
    <!-- Search collapse-->
</header>