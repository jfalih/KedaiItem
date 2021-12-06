
    <footer class="footer bg-dark pt-5">
        <div class="container pt-2 pb-3">
          <div class="row">
            <div class="col-md-6 text-center text-md-start mb-4">
              <div class="text-nowrap mb-3">
                <a class="d-inline-block align-middle mt-n2 me-2" href="#">
                  <img class="d-block" @if(App\Models\Setting::first()->logo) src={{App\Models\Setting::first()->logo->name}} @else src="{{url('assets/img/logo-light.png')}}" @endif width="117" alt=@if(App\Models\Setting::first()->name) {{App\Models\Setting::first()->name}} @else {{config('app.name')}} @endif />
                </a>
              </div>
              <p class="fs-sm text-white opacity-70 pb-1">{{App\Models\Setting::first()->description}}</p>
              <h6 class="d-inline-block pe-3 me-3 border-end border-light"><span class="text-primary">{{App\Models\Item::count()}} </span><span class="fw-normal text-white">Item Game</span></h6>
              <h6 class="d-inline-block pe-3 me-3 border-end border-light"><span class="text-primary">{{\App\Models\User::whereHas('roles', function($q){ return $q->where('name','member'); })->count()}} </span><span class="fw-normal text-white">Member</span></h6>
              <h6 class="d-inline-block me-3"><span class="text-primary">{{\App\Models\User::whereHas('roles', function($q){ return $q->where('name','reseller'); })->count()}} </span><span class="fw-normal text-white">Penjual</span></h6>
            </div>
            <!-- Mobile dropdown menu (visible on screens below md)-->
            <div class="col-12 d-md-none text-center mb-4 pb-2">
              <div class="btn-group dropdown d-block mx-auto mb-3">
                <button class="btn btn-outline-light border-light dropdown-toggle" type="button" data-bs-toggle="dropdown">Categories</button>
                <ul class="dropdown-menu my-1">
                  @php
                      $category = \App\Models\Category::whereHas('status', function($q){
                          return $q->where('id', 1);
                      })->get();   
                  @endphp    
                  @forelse($category as $item)
                  <li><a class="dropdown-item" href="{{url('category/'.$item->slug)}}">{{$item->name}}</a></li>
                  @empty
                  <li><a class="dropdown-item" href="#">Belum ada kategori</a></li>
                  @endforelse
                </ul>
              </div>
              <div class="btn-group dropdown d-block mx-auto">
                <button class="btn btn-outline-light border-light dropdown-toggle" type="button" data-bs-toggle="dropdown">For members</button>
                <ul class="dropdown-menu my-1">
                  <li><a class="dropdown-item" href="#">Licenses</a></li>
                  <li><a class="dropdown-item" href="#">Return policy</a></li>
                  <li><a class="dropdown-item" href="#">Payment methods</a></li>
                  <li><a class="dropdown-item" href="#">Become a vendor</a></li>
                  <li><a class="dropdown-item" href="#">Become an affiliate</a></li>
                  <li><a class="dropdown-item" href="#">Marketplace benefits</a></li>
                </ul>
              </div>
            </div>
            <!-- Desktop menu (visible on screens above md)-->
            <div class="col-md-3 d-none d-md-block text-center text-md-start mb-4">
              <div class="widget widget-links widget-light pb-2">
                <h3 class="widget-title text-light">Kategori</h3>
                <ul class="widget-list">
                @php
                    $category = \App\Models\Category::whereHas('status', function($q){
                        return $q->where('id', 1);
                    })->get();   
                @endphp    
                @forelse($category as $item)
                  <li class="widget-list-item"><a class="widget-list-link" href="{{url('category/'.$item->slug)}}">{{$item->name}}</a></li>
                  @empty
                  <li><a class="dropdown-item" href="#">Belum ada kategori</a></li>
                @endforelse
                </ul>   
              </div>
            </div>
            <div class="col-md-3 d-none d-md-block text-center text-md-start mb-4">
              <div class="widget widget-links widget-light pb-2">
                <h3 class="widget-title text-light">Halaman</h3>
                <ul class="widget-list">
                  <li class="widget-list-item"><a class="widget-list-link" href="#">Licenses</a></li>
                  <li class="widget-list-item"><a class="widget-list-link" href="#">Return policy</a></li>
                  <li class="widget-list-item"><a class="widget-list-link" href="#">Payment methods</a></li>
                  <li class="widget-list-item"><a class="widget-list-link" href="#">Become a vendor</a></li>
                  <li class="widget-list-item"><a class="widget-list-link" href="#">Become an affiliate</a></li>
                  <li class="widget-list-item"><a class="widget-list-link" href="#">Marketplace benefits</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- Second row-->
        <div class="pt-5 bg-darker">
          <div class="container">
            <div class="d-md-flex justify-content-between pt-4">
              <div class="pb-4 fs-xs text-light opacity-50 text-center text-md-start">© All rights reserved. Made by <a class="text-light" href="https://id.linkedin.com/in/jan-falih-fadhillah-a7bb7318b" target="_blank" rel="noopener">Jan Falih Fadhillah</a></div>
              <div class="widget widget-links widget-light pb-4">
                <ul class="widget-list d-flex flex-wrap justify-content-center justify-content-md-start">
                  <li class="widget-list-item ms-4"><a class="widget-list-link fs-ms" href="#">Help Center</a></li>
                  <li class="widget-list-item ms-4"><a class="widget-list-link fs-ms" href="#">Affiliates</a></li>
                  <li class="widget-list-item ms-4"><a class="widget-list-link fs-ms" href="#">Support</a></li>
                  <li class="widget-list-item ms-4"><a class="widget-list-link fs-ms" href="#">Terms &amp; Conditions</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </footer>