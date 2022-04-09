@extends('layouts.auth')
@section('content') 

<section class="user-form-part">
	<div class="user-form-banner">
		<div class="user-form-content">
			<a href="#"><img src="images/logo.png" alt="logo"></a>
			<h1>Advertise your assets <span>Buy what are you needs.</span></h1>
			<p>
				Biggest Online Advertising Marketplace in the World.
			</p>
		</div>
	</div>
	<div class="user-form-category">
		<div class="user-form-header">
			<a href="#"><img src="images/logo.png" alt="logo"></a><a href="index.html"><i class="fas fa-arrow-left"></i></a>
		</div>
		<div class="user-form-category-btn">
			<ul class="nav nav-tabs">
				<li>
					<a href="{{route('login')}}" class="nav-link active">sign in</a>
				</li>
				<li>
					<a href="{{route('register')}}" class="nav-link">sign up</a>
				</li>
			</ul>
		</div>
		<div class="tab-pane active" id="login-tab">
			<div class="user-form-title">
				<h2>Selamat Datang!</h2>
				<p>
					Gunakan akun kamu yang terdaftar.
				</p>
			</div>
			<form>
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Email">
							<small class="form-alert">Silahkan gunakan alamat email yang terdaftar.</small>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<input type="password" class="form-control" id="pass" placeholder="Password">
							<button type="button" class="form-icon"><i class="eye fas fa-eye"></i></button>
							<small class="form-alert">Pastikan password sudah benar.</small>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="signin-check">
								<label class="custom-control-label" for="signin-check">Ingat Saya</label>
							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group text-right">
							<a href="#" class="form-forgot">Lupa password?</a>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<button type="submit" class="btn btn-inline"><i class="fas fa-unlock"></i><span>Masuk ke akun</span></button>
						</div>
					</div>
				</div>
			</form>
			<div class="user-form-direction">
				<p>
					Tidak punya akun? klik pada tombol <span>( sign up )</span> diatas.
				</p>
			</div>
		</div>
		<div class="tab-pane" id="register-tab">
			<div class="user-form-title">
				<h2>Register</h2>
				<p>
					Setup a new account in a minute.
				</p>
			</div>
			<ul class="user-form-option">
				<li>
					<a href="#"><i class="fab fa-facebook-f"></i><span>facebook</span></a>
				</li>
				<li>
					<a href="#"><i class="fab fa-twitter"></i><span>twitter</span></a>
				</li>
				<li>
					<a href="#"><i class="fab fa-google"></i><span>google</span></a>
				</li>
			</ul>
			<div class="user-form-devider">
				<p>
					or
				</p>
			</div>
			<form>
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Phone number"><small class="form-alert">Silahkan gunakan alamat email terdaftar - contoh@kedaiitem.com</small>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password"><button class="form-icon"><i class="eye fas fa-eye"></i></button><small class="form-alert">Password must be 6 characters</small>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Repeat Password"><button class="form-icon"><i class="eye fas fa-eye"></i></button><small class="form-alert">Password must be 6 characters</small>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="signup-check"><label class="custom-control-label" for="signup-check">I agree to the all <a href="#">terms & consitions</a>of bebostha.</label>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<button type="submit" class="btn btn-inline"><i class="fas fa-user-check"></i><span>Create new account</span></button>
						</div>
					</div>
				</div>
			</form>
			<div class="user-form-direction">
				<p>
					Already have an account? click on the <span>( sign in )</span>button above.
				</p>
			</div>
		</div>
	</div>
</section>
	<!-- sign in -->
	{{-- <div class="sign section--full-bg" data-bg="{{asset('assets/img/bg2.jpg')}}">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="sign__content">
						<!-- authorization form -->
						<form method="POST" action="{{route('login')}}" class="sign__form">
							<a href="index-2.html" class="sign__logo"><img src="{{asset('assets/img/logo.svg')}}" alt=""></a>
							@if(session('error_login')) 
							<!-- Danger alert -->
							<div class="sign__group">
								<div class="alert alert-danger">
									<span>Error:</span> {{session('error_login')}}
								</div>
							</div>
							@endif @csrf
							<div class="sign__group">
								<input type="text" name="email" class="sign__input" placeholder="Email"></div>
							<div class="sign__group">
								<input type="password" name="password" class="sign__input" placeholder="Password"></div>
							<div class="sign__group sign__group--checkbox">
								<input id="remember" name="remember" type="checkbox" checked="checked">
								<label for="remember">Ingat Saya</label>
							</div>
							<button type="submit" class="sign__btn" type="button">Masuk</button>
							<span class="sign__delimiter">atau</span>
							<span class="sign__text">Tidak punya akun? <a href="{{route('register')}}">Daftar!</a></span>
							<span class="sign__text"><a href="">Lupa password?</a></span>
						</form>
						<!-- end authorization form --></div>
				</div>
			</div>
		</div>
	</div> --}}
	<!-- end sign in -->
@endsection