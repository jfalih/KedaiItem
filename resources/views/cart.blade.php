@extends('layouts.app')
@section('content')
	<!-- page title -->
	<section class="section section--first section--last section--head" data-bg="img/bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h2 class="section__title">Keranjang belanja</h2>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="{{route('welcome')}}">Home</a></li>
							<li class="breadcrumb__item breadcrumb__item--active">Keranjang belanja</li>
						</ul>
						<!-- end breadcrumb -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->
	<!-- section -->
	<div class="section">
		<div class="container">
			<form method="POST" action="{{route('checkout')}}" class="row">
				@csrf
				<div class="col-12 col-lg-12">
					<!-- cart -->
					
					<div method="POST" action="{{route('checkout')}}" class="cart">
						@php
						$jumlah = 0;
						@endphp
						<div class="table-responsive">
							@if(!empty(Session::get('cart')))
							<table class="cart__table">
								<tbody>
									@foreach(Session::get('cart') as $cartKey => $cartVal)
										<tr>
											<td colspan="2">
												<h5>Penjual</h5>
												<h2><a href="#">{{Str::title($cartKey)}}</a></h2>	
											</td>
											<td colspan="4"></td>
										</tr>
										@foreach($cartVal as $value)
											@php
											$item = App\Models\Item::find($value['id']);
											$jumlah += ($item->price*$value['quantity']);
											@endphp
												<tr>
													<td rowspan="3">
															<img style="object-fit: cover; width:100%; height:100%;" src="{{asset('assets/img/cards/8.jpg')}}" alt="">

													</td>
													<td colspan="2">
														<span>{{Str::title($item->subcategories->first()->name)}}</span><br>
														<a href="{{ route('item.detail',[
															'product' => $item->slug,
															'seller' => $item->user->username
														]) }}">{{ Str::title(strlen($value['name']) > 50 ? substr($value['name'],0,50)."..." : $value['name']) }} x {{$value['quantity']}}</a>
													</td>
													<td>
														<span>Harga</span><br>
														<span class="cart__price">Rp{{ number_format($value['price']*$value['quantity'],0,',','.') }}</span>
													</td>
													<td><button class="cart__delete" type="button"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><line x1='368' y1='368' x2='144' y2='144' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='368' y1='144' x2='144' y2='368' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg></button></td>
												</tr>
												<tr>
													<td colspan="2">
														<span>Pengiriman</span><br>
														<select name="options[{{$value['id']}}]" class="form__select mt-2">
															<option value="not">Biasa</option>
															<option value="premium">Premium (Penambahan Fee Rp1.000)</option>
														</select>
													</td>
													<td colspan="2">
														<span>Username/Nickname</span><br>
														<input type="text" name="gusername[{{$value['id']}}]" class="form__input mt-2" placeholder="Username/Nickname Game">
													</td>
												</tr>
												<tr>
													
													<td colspan="4">
														<span>Catatan Untuk Penjual</span><br>
														<textarea style="padding:20px; height:180px;" name="catatan[{{$value['id']}}]" type="text" class="form__input mt-2" placeholder="Catatan"></textarea>
													</td>
												</tr>
										@endforeach
										
									@endforeach
								</tbody>
							</table>
							@else
							
							<table class="cart__table">
								<tr>
									<td>
										<center>
											<img width="300" height="300" src="{{asset('assets/img/empty_cart.svg')}}"/>
										</center>
									</td>
								</tr>
								<tr>
									<td>
										<center>
											<h1>Keranjang belanja masih kosong..</h1>
										</center>
									</td>
								</tr>
							</table>
							@endif
						</div>

						<div class="cart__info">
							<div class="cart__total">
								<p>Total:</p>
								<span id="total"></span>
							</div>
						</div>
					</div>
					<!-- end cart -->
				</div>

				<div class="col-12">
					<!-- checkout -->
					<div class="form form--first form--coupon">
						<div class="row">
							<div class="col-lg-8 col-12">
								<span class="form__text">Pastikan item yang dibeli, jumlah, catatan dan username game sudah benar.</span>
							</div>
							<div class="col-lg-4 col-12">
								<button type="submit" class="card__buy">Lanjutkan Pembayaran</button>	
							</div>
						</div>
					</div>
					<!-- end checkout -->

					<!-- checkout -->
					<!-- end checkout -->
				</div>
			</form>	
		</div>
	</div>
	<!-- end section -->
	<!-- section -->
	<div class="section section--last">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="partners owl-carousel">
						<a href="#" class="partners__img">
							<img src="img/partners/3docean-light-background.png" alt="">
						</a>

						<a href="#" class="partners__img">
							<img src="img/partners/activeden-light-background.png" alt="">
						</a>

						<a href="#" class="partners__img">
							<img src="img/partners/audiojungle-light-background.png" alt="">
						</a>

						<a href="#" class="partners__img">
							<img src="img/partners/codecanyon-light-background.png" alt="">
						</a>

						<a href="#" class="partners__img">
							<img src="img/partners/photodune-light-background.png" alt="">
						</a>

						<a href="#" class="partners__img">
							<img src="img/partners/themeforest-light-background.png" alt="">
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
<script type="text/javascript">
  $(document).ready(function () {
	var format = new Intl.NumberFormat('id-ID', {
		style: 'currency',
		currency: "IDR" 
	});
	$('#total').html(`${format.format({{$jumlah}})}`);
  });
</script>
@endsection