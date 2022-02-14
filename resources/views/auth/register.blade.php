@extends('layouts.auth')
@section('content')
	<!-- sign in -->
	<div class="sign section--full-bg" data-bg="{{asset('assets/img/bg2.jpg')}}">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="sign__content">
						<!-- authorization form -->
						<form method="POST" action="{{route('register')}}" class="sign__form">
              @csrf
							<a href="{{url('/')}}" class="sign__logo"><img src="{{asset('assets/img/logo.svg')}}" alt=""></a>
							@if(session('error_register')) 
							<!-- Danger alert -->
							<div class="sign__group">
								<div class="alert alert-danger">
									<span>Error:</span> {{session('error_register')}}
								</div>
							</div>
							@endif 
              @if($errors->any())
              <div class="sign__group">
								<div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                  <span>{{ Str::title($error) }}</span><br>
                  @endforeach
                </div>
              </div>
              @endif
							<div class="sign__group">
								<input type="text" name="name" class="sign__input" placeholder="Nama Lengkap">
              </div>
							<div class="sign__group">
								<input type="email" name="email" class="sign__input" placeholder="Email">
              </div> 
							<div class="sign__group">
								<input type="text" name="nomorhp" class="sign__input" placeholder="Nomor Handphone">
              </div>
							<div class="sign__group">
								<input type="password" name="password" class="sign__input" placeholder="Password">
              </div>
							<div class="sign__group">
								<input type="password" name="c_password" class="sign__input" placeholder="Konfirmasi Password">
              </div>
							<button type="submit" class="sign__btn" type="button">Daftar</button>
							<span class="sign__delimiter">atau</span>
							<span class="sign__text">Sudah punya akun? <a href="{{route('login')}}">Masuk!</a></span>
							<span class="sign__text"><a href="">Lupa password?</a></span>
						</form>
						<!-- end authorization form --></div>
				</div>
			</div>
		</div>
	</div>
	<!-- end sign in -->
@endsection