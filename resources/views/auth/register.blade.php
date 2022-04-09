@extends('layouts.auth')
@section('content') 

<section class="user-form-part">
	<div class="user-form-banner">
		<div class="user-form-content">
			<a href="#"><img src="images/logo.png" alt="logo"></a>
			<h1>Jual beli item game,<span>Hanya dengan {{env('APP_NAME')}}.</span></h1>
			<p>
				Raih keuntungan hanya dengan menjual item game.
			</p>
		</div>
	</div>
	<div class="user-form-category">
		<div class="user-form-header">
			<a href="#"><img src="images/logo.png" alt="logo"></a><a href="{{route('welcome')}}"><i class="fas fa-arrow-left"></i></a>
		</div>
		<div class="user-form-category-btn">
			<ul class="nav nav-tabs">
				<li>
					<a href="{{route('login')}}" class="nav-link ">sign in</a>
				</li>
				<li>
					<a href="{{route('register')}}" class="nav-link active">sign up</a>
				</li>
			</ul>
		</div>
		<div class="tab-pane active" id="register-tab">
			<div class="user-form-title">
				<h2>Daftar!</h2>
				<p>
					Daftarkan akun kamu sebelum memulai di {{env('APP_NAME')}}.
				</p>
			</div>
			<form method="POST" action="{{route('register')}}">
				@csrf
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap">
							@error('name')
							<small class="text-danger">{{$message}}</small>
							@else
							<small class="form-alert">Masukan nama lengkap sesuai dengan nama mu.</small>
							@enderror
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
							@error('email')
							<small class="text-danger">{{$message}}</small>
							@else
							<small class="form-alert">Silahkan gunakan alamat email yang masih aktif.</small>
							@enderror
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<input type="text" name="nomorhp" class="form-control @error('nomorhp') is-invalid @enderror" placeholder="Nomor Handphone">
							@error('nomorhp')
							<small class="text-danger">{{$message}}</small>
							@else
							<small class="form-alert">Silahkan masukan nomor handphone kamu - 08XXXXXXXXXXX.</small>
							@enderror
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="pass1" placeholder="Password">
							<button type="button" class="form-icon"><i class="eye fas fa-eye"></i></button>
							@error('password')
							<small class="text-danger">{{$message}}</small>
							@else
							<small class="form-alert">Silahkan masukan lebih dari 6 karakter.</small>
							@enderror
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<input type="password" name="c_password" class="form-control @error('c_password') is-invalid @enderror" id="pass2" placeholder="Konfirmasi Password">
							<button type="button" class="form-icon"><i class="eye fas fa-eye"></i></button>
							@error('c_password')
							<small class="text-danger">{{$message}}</small>
							@else
							<small class="form-alert">Pastikan password dan konfirmasi password sudah sama.</small>
							@enderror
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="signin-check">
								<label class="custom-control-label" for="signin-check">Saya menyetujui semua terms & condition dari {{env('APP_NAME')}}</label>
							</div>
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
					Sudah punya akun? klik pada tombol <span>( sign in )</span> diatas.
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
	</div> --}}
	<!-- end sign in -->
@endsection