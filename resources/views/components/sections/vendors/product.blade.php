
<section class="col-lg-8">
    
<!-- Toolbar-->
    <!-- Products grid-->
    <div class="row mx-n2">
    <!-- Product-->
    @foreach ($items as $item)
        <div class="col-md-4 col-sm-6 px-2 mb-4">
            <div class="card product-card">
                <a class="card-img-top d-block overflow-hidden" href="{{url('penjual/'.$item->user->username.'/item/'.$item->slug)}}">
                    <img src="{{Storage::url($item->images->first()->name)}}" alt="{{$item->images->first()->caption}}">
                </a>
                <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">{{$item->subcategories->first()->name}}</a>
                <h3 class="product-title fs-sm"><a href="{{url('penjual/'.$item->user->username.'/item/'.$item->slug)}}">{{$item->name}}</a></h3>
                <div class="d-flex justify-content-between">
                    <div class="product-price">
                        <span class="text-accent">Rp{{number_format($item->price,2,',','.')}}</span>
                    </div>
                    @include('components.shops.stars.default',['rating' => $item->average_rating])
                </div>
                </div>
            </div>
            <hr class="d-sm-none">
        </div>
        <!-- Product-->
    @endforeach
    </div>
    <!-- Banner-->
    <hr class="my-3">
    <!-- Pagination-->
    {{$items->links('components.paginations.default')}}
</section>