@extends('layouts.app')
@section('content')
	<!-- page title -->
	<section class="section section--first section--last section--head" data-bg="{{asset('assets/img/bg.jpg')}}">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h2 class="section__title">{{$keyword}} <span>({{$items->count()}} items)</span></h2>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="{{route('welcome')}}">Home</a></li>
							<li class="breadcrumb__item breadcrumb__item--active">Search</li>
						</ul>
						<!-- end breadcrumb -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->
	
	<!-- section -->
	<section class="section section--last section--catalog">
		<div class="container">
			<!-- catalog -->
			<div class="row catalog">
				<!-- filter wrap -->
				<div class="col-12 col-lg-20">
					<div class="row">
						<div class="col-12">
							<div class="filter-wrap">
								<button class="filter-wrap__btn" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">Open filter</button>

								<div class="collapse filter-wrap__content" id="collapseFilter">
									<!-- filter -->
									<form method="GET" action="{{route('welcome.search')}}" class="filter">
										<h4 class="filter__title">Filter <button type="button">Clear all</button></h4>

										<div class="filter__group">
											<label class="filter__label">Kata Kunci:</label>
											<input type="text" class="filter__input" placeholder="Kata Kunci" name="keyword" value="{{$keyword}}">
										</div>

										<div class="filter__group">
											<label for="sort" class="filter__label">Berdasarkan:</label>
											<div class="filter__select-wrap">
												<select name="sort" id="sort" class="filter__select">
													<option value="0">Relefansi</option>
													<option value="1">Terbaru</option>
													<option value="2">Terlama</option>
												</select>
											</div>
										</div>

										<div class="filter__group">
											<label class="filter__label">Harga:</label>
											<div class="row">
											<div class="col-6 pr-1">
												<input type="text" class="filter__input mr-0" placeholder="Min">
											</div>
											<div class="col-6 pl-1">
												<input type="text" class="filter__input" placeholder="Max">
											</div>
											
											</div>
										</div>
										<div class="filter__group">
											<label class="filter__label">Kategori:</label>
											<ul class="filter__checkboxes">
												@forelse($categories as $cat)
												<li>
													<input id="type1" type="checkbox" name="categories[]" value="{{$cat->id}}"
														@foreach($category as $c)
															@if($c == $cat->id) checked @endif
														@endforeach
													>
													<label for="type1">{{$cat->name}}</label>
												</li>
												@empty
												<li><span style="color:#fff; font-size:12px">Kategori belum tersedia</span></li>
												@endforelse
											</ul>
										</div>

										<div class="filter__group">
											<label class="filter__label">Subkategori:</label>
											<ul class="filter__checkboxes">
												@forelse($subcategories as $sub)
												<li>
													<input id="{{$sub->name}}" type="checkbox" name="subcategories">
													<label for="{{$sub->name}}">{{$sub->name}}</label>
												</li>
												@empty
												<li><span style="color:#fff; font-size:12px">Subkategori belum tersedia</span></li>
												@endforelse
											</ul>
										</div>

										<div class="filter__group">
											<button class="filter__btn" type="submit">Terapkan</button>
										</div>
									</form>
									<!-- end filter -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end filter wrap -->

				<!-- content wrap -->
				<div class="col-12 col-lg-80">
					<div class="row">
						<!-- card -->
                        @forelse($items as $item)
						<div class="col-12 col-sm-6 col-md-4 col-xl-3">
							<div class="card card--catalog">
								<a href="{{route('item.detail',[
									'seller'=>$item->user->username,
									'product' => $item->slug
								])}}" class="card__cover">
									<img src="{{asset('assets/img/cards/5.jpg')}}" alt="">
								</a>
								<div class="card__title">
									<h3><a href="details.html">{{$item->title_format}}</a></h3>
									<span>{{$item->price_format}}</span>
								</div>

								<div class="card__actions">
									<button class="card__buy" type="button">Beli</button>
									<button class="card__favorite" type="button">
										<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><path d='M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg>
									</button>
								</div>
							</div>
						</div>
                        @empty
						<div class="col-12">
							
							<table class="cart__table">
								<tr>
									<td>
										<center>
											<img width="300" height="300" src="{{asset('assets/img/not_found.svg')}}"/>
										</center>
									</td>
								</tr>
								<tr>
									<td>
										<center>
											<h1>Produk tidak ditemukan..</h1>
										</center>
									</td>
								</tr>
							</table>
						</div>
                        @endforelse
						<!-- end card -->
						@if($items->count() > 0)
                        {{$items->links('components.paginations.default')}}
						@endif
						<!-- paginator -->
						<!-- end paginator -->
					</div>
				</div>
				<!-- end content wrap -->
			</div>
			<!-- end catalog -->	
		</div>
	</section>
	<!-- end section -->

@endsection