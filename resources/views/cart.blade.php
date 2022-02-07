@extends('layouts.app')
@section('content')
	<!-- page title -->
	<section class="section section--first section--last section--head" data-bg="img/bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h2 class="section__title">Checkout</h2>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="index-2.html">Home</a></li>
							<li class="breadcrumb__item breadcrumb__item--active">Checkout</li>
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
			<div class="row">
				<div class="col-12 col-lg-8">
					<!-- cart -->
					<div class="cart">
						<div class="table-responsive">
							<table class="cart__table">
								<tbody>
									@foreach(Session::get('cart') as $cartKey => $cartVal)
										<tr>
											<td colspan="2">
												<h5>Penjual</h5>
												<h2><a href="#">{{Str::title($cartKey)}}</a></h2>	
											</td>
											<td colspan="3"></td>
										</tr>
										@foreach($cartVal as $value)
										@php
										$item = App\Models\Item::find($value['id']);
										@endphp
											<tr>
												<td rowspan="2">
													<div class="cart__img">
														<img src="{{asset('assets/img/cards/8.jpg')}}" alt="">
													</div>
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
												<td colspan="4">
													<select name="systems" class="form__select">
														<option value="visa">Visa</option>
														<option value="mastercard">Mastercard</option>
														<option value="paypal">Paypal</option>
													</select>
												</td>
											</tr>
										@endforeach
									@endforeach
								</tbody>
							</table>
						</div>

						<div class="cart__info">
							<div class="cart__total">
								<p>Total:</p>
								<span>$27.98</span>
							</div>
						</div>
					</div>
					<!-- end cart -->
				</div>

				<div class="col-12 col-lg-4">
					<!-- checkout -->
					<form action="#" class="form form--first form--coupon">
						<input type="text" class="form__input" placeholder="Coupon code">
						<button type="button" class="form__btn">Apply</button>
					</form>
					<!-- end checkout -->

					<!-- checkout -->
					<form action="#" class="form">
						<input type="text" name="name" class="form__input" placeholder="John Doe">
						<input type="text" name="email" class="form__input" placeholder="gg@template.buy">
						<input type="text" name="phone" class="form__input" placeholder="+1 234 567-89-00">
						<select name="systems" class="form__select">
							<option value="visa">Visa</option>
							<option value="mastercard">Mastercard</option>
							<option value="paypal">Paypal</option>
						</select>
						<span class="form__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</span>
						<button type="button" class="form__btn">Complete</button>
					</form>
					<!-- end checkout -->
				</div>
			</div>	
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