@extends('layouts.auth')
@section('content') 
	<!-- sign in -->
	<div class="sign section--full-bg" data-bg="{{asset('assets/img/bg2.jpg')}}">
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
								<label for="remember">Remember Me</label>
							</div>
							<button type="submit" class="sign__btn" type="button">Sign in</button>
							<span class="sign__delimiter">or</span>
							<span class="sign__text">Don't have an account? <a href="{{route('register')}}">Sign up!</a></span>
							<span class="sign__text"><a href="">Forgot password?</a></span>
						</form>
						<!-- end authorization form --></div>
				</div>
			</div>
		</div>
	</div>
	<!-- end sign in -->
@endsection