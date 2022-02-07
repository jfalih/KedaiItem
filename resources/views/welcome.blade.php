@extends('layouts.app')
@section('content')
	
	<!-- home -->
	<section class="section section--bg section--first" data-bg="{{asset('assets/img/bg.jpg')}}">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<div class="section__title-wrap">
						<h2 class="section__title section__title--title"><b>Recommended Items</b> For You</h2>

						<div class="section__nav-wrap">
							<button class="section__nav section__nav--bg section__nav--prev" type="button" data-nav="#carousel0">
								<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='328 112 184 256 328 400' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
							</button>

							<button class="section__nav section__nav--bg section__nav--next" type="button" data-nav="#carousel0">
								<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='184 112 328 256 184 400' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
							</button>
						</div>
					</div>
				</div>
				<!-- end title -->
			</div>
		</div>

		<!-- carousel -->
		<div class="owl-carousel section__carousel section__carousel--big" id="carousel0">
			<!-- big card -->
			@foreach($random_items as $random_item)
			<div class="card card--big">
				<a href="{{route('item.detail', ['seller' => $random_item->user->username,
					'product' => $random_item->slug ])}}" class="card__cover">
					<img src="{{asset('assets/img/cards/4.jpg')}}" alt="">
				</a>

				<div class="card__wrap">
					<div class="card__title">
						<h3><a href="{{route('item.detail', ['seller' => $random_item->user->username,
							'product' => $random_item->slug ])}}">{{Str::title($random_item->name)}}</a></h3>
					</div>

					<ul class="card__list">
						<li><span>Dirilis:</span> {{$random_item->created_at}}</li>
						<li><span>Kategori:</span>{{$random_item->subcategories->first()->categories->first()->name}}</li>
					</ul>
					<div class="card__price">
						<span>Rp{{number_format($random_item->price,0,',','.')}}</span>
					</div>

					<div class="card__actions">
						<button id="tambah_keranjang_belanja" data-id="{{$random_item->id}}" class="card__buy" >Beli</button>

						<button class="card__favorite" type="button">
							<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><path d='M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg>
						</button>
					</div>
				</div>
			</div>
			<!-- end big card -->
			@endforeach
			<!-- end big card -->
		</div>
		<!-- end carousel -->
	</section>
	<!-- end home -->

	<!-- section -->
	<section class="section">
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
			@foreach($latest_items as $last)
				<!-- card -->
				<div class="card">
					<a href="{{route('item.detail', [
						'seller' => $last->user->username,
						'product' => $last->slug
					])}}" class="card__cover">
						<img src="{{asset('assets/img/cards/5.jpg')}}" alt="">
						<span class="card__new">New</span>
					</a>
					<div class="card__title">
						<h3><a href="{{route('item.detail', ['seller' => $last->user->username,
						'product' => $last->slug ])}}">{{Str::title($last->name)}}</a></h3>
						<span>Rp{{number_format($last->price,2,',','.')}}</span>
					</div>

					<div class="card__actions">
						<button id="tambah_keranjang_belanja" data-id="{{$random_item->id}}" class="card__buy" type="button">Beli</button>

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


	<!-- section -->
	<section class="section">
		<div class="container">
			<div class="row">
				@foreach($subcategories as $sub)
				<div class="col-12 col-md-6 col-xl-4">
					<div class="row">
						<div class="col-12">
							<!-- title -->
							<div class="section__title-wrap section__title-wrap--single">
								<h2 class="section__title section__title--small">{{$sub->name}}</h2>

								<div class="section__nav-wrap">
									<a href="#" class="section__view">View All</a>
								</div>
							</div>
							<!-- end title -->

							<!-- cards -->
							<ul class="list list--mb">
								@foreach($sub->items()->limit(3)->get() as $item)
								<li class="list__item">
									<a href="#" class="list__cover">
										<img src="{{asset('assets/img/cards/5.jpg')}}" alt="">
									</a>

									<div class="list__wrap">
										<h3 class="list__title">
											<a href="#">{{$item->name}}</a>
										</h3>

										<div class="list__price">
											<span>Rp{{number_format($item->price,2,',','.')}}</span><s>$4.99</s><b>60% OFF</b>
										</div>

										<button class="list__buy" type="button">
											<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><line x1='256' y1='112' x2='256' y2='400' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='400' y1='256' x2='112' y2='256' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg>
										</button>
									</div>
								</li>
								@endforeach
							</ul>
							<!-- end cards -->
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- end section -->


	<!-- section -->
	<div class="section section--last">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="partners owl-carousel">
						<a href="#" class="partners__img">
							<img src="{{asset('assets/img/partners/3docean-light-background.png')}}" alt="">
						</a>

						<a href="#" class="partners__img">
							<img src="{{asset('assets/img/partners/activeden-light-background.png')}}" alt="">
						</a>

						<a href="#" class="partners__img">
							<img src="{{asset('assets/img/partners/3docean-light-background.png')}}" alt="">
						</a>

						<a href="#" class="partners__img">
							<img src="{{asset('assets/img/partners/activeden-light-background.png')}}" alt="">
						</a>

						<a href="#" class="partners__img">
							<img src="{{asset('assets/img/partners/3docean-light-background.png')}}" alt="">
						</a>

						<a href="#" class="partners__img">
							<img src="{{asset('assets/img/partners/activeden-light-background.png')}}" alt="">
						</a>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end section -->
@endsection
@section('js')
	@parent
@endsection