
<!-- Sidebar-->
<aside class="col-lg-4 pe-xl-5">
    <!-- Account menu toggler (hidden on screens larger 992px)-->
    <div class="d-block d-lg-none p-4"><a class="btn btn-outline-accent d-block" href="#account-menu" data-bs-toggle="collapse"><i class="ci-menu me-2"></i>Account menu</a></div>
    <!-- Actual menu-->
    <div class="h-100 border-end mb-2">
        <div class="d-lg-block collapse" id="account-menu">
        <div class="bg-secondary p-4">
            <h3 class="fs-sm mb-0 text-muted">Account</h3>
        </div>
        <ul class="list-unstyled mb-0">
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 @if(Request::segments()[0] === 'pengaturan') active @endif" href="{{route('pengaturan')}}"><i class="ci-settings opacity-60 me-2"></i>Pengaturan</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 @if(Request::segments()[0] === 'galeri') active @endif" href="{{route('galeri')}}"><i class="ci-image opacity-60 me-2"></i>Galeri</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 @if(Request::segments()[0] === 'chat') active @endif" href="{{route('login')}}"><i class="ci-chat opacity-60 me-2"></i>Chat</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 @if(Request::segments()[0] === 'pembelian') active @endif" href="{{route('pembelian')}}"><i class="ci-basket opacity-60 me-2"></i>Pembelian</a></li>
            <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 @if(Request::segments()[0] === 'favorit') active @endif" href="dashboard-favorites.html"><i class="ci-heart opacity-60 me-2"></i>Favorit<span class="fs-sm text-muted ms-auto">4</span></a></li>
        </ul>
        @if(in_array('reseller',Auth::user()->role_name))
        <div class="bg-secondary p-4">
            <h3 class="fs-sm mb-0 text-muted">Dashboard Penjual</h3>
        </div>
        <ul class="list-unstyled mb-0">
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-sales.html"><i class="ci-dollar opacity-60 me-2"></i>Sales<span class="fs-sm text-muted ms-auto">$1,375.00</span></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-products.html"><i class="ci-package opacity-60 me-2"></i>Products<span class="fs-sm text-muted ms-auto">5</span></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-add-new-product.html"><i class="ci-cloud-upload opacity-60 me-2"></i>Add New Product</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-payouts.html"><i class="ci-currency-exchange opacity-60 me-2"></i>Payouts</a></li>
            <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-signin.html"><i class="ci-sign-out opacity-60 me-2"></i>Sign out</a></li>
        </ul>
        @endif
        <hr>
        </div>
    </div>
    </aside>