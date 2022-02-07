@extends('layouts.app')
@section('content') 
	<!-- section -->
	<section class="section section--first section--bg" data-bg="img/bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="details">
						<div class="details__head">
							<div class="details__cover">
								<img src="img/cards/4.jpg" alt="">
                            </div>
							<div class="details__wrap">
								<h3 class="details__title">{{ Str::title($item->name) }}</h3>

								<ul class="details__list">
									<li><span>Dirilis:</span> {{ $item->created_at }}</li>
									<li><span>Kategori:</span> {{ $item->subcategories->first()->categories->first()->name }}</li>
									<li><span>Penjual:</span> {{ $item->user->username }}</li>
								</ul>
								<div class="details__text">
									{!! $item->description !!}
								</div>
							</div>
						</div>
						<div class="details__gallery">
							<div class="details__carousel owl-carousel" id="details__carousel">
								<a href="img/details/1-1.jpg" >
									<img src="img/details/1.jpg" alt="">
								</a>
								<a href="img/details/2-2.jpg" >
									<img src="img/details/2.jpg" alt="">
								</a>
								<a href="img/details/3-3.jpg" >
									<img src="img/details/3.jpg" alt="">
								</a>
								<a href="img/details/4-4.jpg" >
									<img src="img/details/4.jpg" alt="">
								</a>
								<a href="img/details/5-5.jpg" >
									<img src="img/details/5.jpg" alt="">
								</a>
								<a href="img/details/6-6.jpg" >
									<img src="img/details/6.jpg" alt="">
								</a>
							</div>

							<button class="details__nav details__nav--prev" data-nav="#details__carousel" type="button">
								<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='328 112 184 256 328 400' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
							</button>
							<button class="details__nav details__nav--next" data-nav="#details__carousel" type="button">
								<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='184 112 328 256 184 400' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
							</button>
						</div>

						<div class="details__cart">
							<span class="details__cart-title">PRICE</span>
							<div class="details__price">
								<span>Rp{{number_format($item->price,0,',','.')}}</span>
							</div>

							<div class="details__actions">
								<button class="details__buy" type="button">Buy now</button>

								<button id="tambah_keranjang_belanja" data-id="{{$item->id}}" class="details__favorite" type="button">
									<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><path d='M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg>Add to favorites
								</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end section -->

	<!-- section -->
	<section class="section section--last">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<div class="section__title-wrap">
						<h2 class="section__title">Latest releases</h2>

						<div class="section__nav-wrap">
							<a href="catalog.html" class="section__view">View All</a>

							<button class="section__nav section__nav--prev" type="button" data-nav="#carousel1">
								<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='328 112 184 256 328 400' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
							</button>

							<button class="section__nav section__nav--next" type="button" data-nav="#carousel1">
								<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='184 112 328 256 184 400' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
							</button>
						</div>
					</div>
				</div>
				<!-- end title -->
			</div>
		</div>

		<!-- carousel -->
		<div class="owl-carousel section__carousel section__carousel--catalog" id="carousel1">
			@foreach ($latest as $last)
                <!-- card -->
                <div class="card">
                    <a href="details.html" class="card__cover">
                        <img src="{{asset('img/cards/5.jpg')}}" alt="">
                    </a>
                    <div class="card__title">
                        <h3><a href="details.html">{{ Str::title($last->name) }}</a></h3>
                        <span>Rp{{ number_format($last->price,0,',','.') }}</span>
                    </div>

                    <div class="card__actions">
                        <button class="card__buy" type="button">Buy</button>

                        <button class="card__favorite" type="button">
                            <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><path d='M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg>
                        </button>
                    </div>
                </div>
                <!-- end card -->    
            @endforeach
		</div>
		<!-- end carousel -->
	</section>
	<!-- end section -->
@endsection