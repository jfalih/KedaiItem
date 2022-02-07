
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('assets_users/assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets_users/assets/images/favicon.png')}}" type="image/x-icon">
    <title>viho - Premium Admin Template</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    @section('css')
     
    <link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/fontawesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/icofont.css')}}">
    <!-- Themify icon-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/sweetalert2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/feather-icon.css')}}">
       
    @show
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets_users/assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/responsive.css')}}">
  </head>
  <body >
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right row m-0">
          <div class="main-header-left">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('assets_users/assets/images/logo/logo.png')}}" alt=""></a></div>
            <div class="dark-logo-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('assets_users/assets/images/logo/dark-logo.png')}}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
          </div>
          <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
              <li class="onhover-dropdown p-0">
                <button class="btn btn-primary-light" type="button">
                  <a href="{{route('welcome')}}"><i data-feather="log-out"></i>Kembali</a>
                </button>
              </li>
            </ul>
          </div>
          <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper horizontal-menu">
        <!-- Page Sidebar Start-->
        <header class="main-nav">
          <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{asset('assets_users/assets/images/dashboard/1.png')}}" alt="">
              <h6 class="mt-3 f-14 f-w-600">{{Auth::user()->name}}</h6></a>
            <p class="mb-0 font-roboto">Rp{{number_format(Auth::user()->balance,0,',','.')}}</p>
          </div>
          <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="mainnav">           
                <ul class="nav-menu custom-scrollbar">
                  <li class="back-btn">
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6>Seller Menu</h6>
                    </div>
                  </li>
                  <li>
                    <a class="nav-link menu-title link-nav" href="{{route('dashboard')}}">
                      <i data-feather="credit-card"></i><span>Payout</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav-link menu-title link-nav" href="{{route('dashboard')}}">
                      <i data-feather="shopping-cart"></i><span>Penjualan</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav-link menu-title link-nav" href="{{route('reseller.product')}}">
                      <i data-feather="shopping-cart"></i><span>Product</span>
                    </a>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6>General</h6>
                    </div>
                  </li>
                  <li>
                    <a class="nav-link menu-title link-nav" href="{{route('chat')}}">
                      <i data-feather="message-square"></i><span>Dashboard</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav-link menu-title link-nav" href="{{route('pembelian')}}">
                      <i data-feather="shopping-cart"></i><span>Pembelian</span>
                    </a>
                  </li>
                  <li>
                    <a class="nav-link menu-title link-nav" href="">
                      <i data-feather="dollar-sign"></i><span>Isi Saldo</span>
                    </a>
                  </li>
                  <li class="dropdown"><a class="nav-link menu-title">
                    <i data-feather="settings"></i><span>Pengaturan</span></a>
                    <ul class="nav-submenu menu-content">
                      <li>
                        <a href="{{route('pengaturan')}}"><span>Pengaturan User</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{route('index_change_password')}}"><span>Ganti Password</span>
                        </a>
                      </li>
                      @if(!in_array("reseller",Auth::user()->role_name))
                      <li>
                        <a href="{{route('upgrade')}}"><span>Upgrade User</span></a>
                      </li>
                      @endif
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </header>
        @yield('content')
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0">Copyright 2021-22 © viho All rights reserved.</p>
              </div>
              <div class="col-md-6">
                <p class="pull-right mb-0">Hand crafted & made with <i class="fa fa-heart font-secondary"></i></p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    @section('js')
    <!-- latest jquery-->
    <script src="{{asset('assets_users/assets/js/jquery-3.5.1.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('assets_users/assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets_users/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('assets_users/assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets_users/assets/js/config.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('assets_users/assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('assets_users/assets/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('assets_users/assets/js/form-validation-custom.js')}}"></script>
        
    @show
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('assets_users/assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets_users/assets/js/script.js')}}"></script>
    <script src="{{asset('assets_users/assets/js/theme-customizer/customizer.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $('#tambah_keranjang_belanja').click(function(e){
        e.preventDefault();
        const id = $(this).data('id');
        const quantity = 1;
        $.ajax({
          type:'POST',
          url:"{{ route('cart.add') }}",
          data:{
          id:id,
          quantity:quantity
          },
          success:function(data){
          Swal.fire(
            'Berhasil!',
            'Behasil menambahkan keranjang belanja..',
            'success'
          )
          $('#total_cart').html(data.quantity);
          }
        });
        });
      });
    </script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>