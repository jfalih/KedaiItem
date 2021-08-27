
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from cartzilla.createx.studio/home-marketplace.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Aug 2021 04:19:43 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <title>Cartzilla | Multi-vendor Marketplace</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Cartzilla - Bootstrap E-commerce Template">
    <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap, html5, css3, js, gallery, slider, touch, creative, clean">
    <meta name="author" content="Createx Studio">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" color="#fe6a6a" href="safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    @section('css')
    <link rel="stylesheet" media="screen" href="{{asset('assets/vendor/simplebar/dist/simplebar.min.css')}}"/>
    <link rel="stylesheet" media="screen" href="{{asset('assets/vendor/tiny-slider/dist/tiny-slider.css')}}"/>
    @show
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="{{asset('assets/css/theme.min.css')}}">
    <!-- Jquery -->    
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous">
    </script>
  </head>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">
    <!-- Google Tag Manager (noscript)-->
    <noscript>
      <iframe src="http://www.googletagmanager.com/ns.html?id=GTM-WKV3GT5" height="0" width="0" style="display: none; visibility: hidden;"></iframe>
    </noscript>
    <!-- Sign in / sign up modal-->
    @include('components.modals.auth')
    @include('components.modals.upload')
    @auth
     @include('components.modals.imagepicker')   
    @endauth
    @yield('main')
    <!-- Footer-->
    @include('components.footers.default')
    <!-- Toolbar for handheld devices (Marketplace)-->
    <div class="handheld-toolbar">
        <div class="d-table table-layout-fixed w-100">
          <a class="d-table-cell handheld-toolbar-item" href="{{url('/')}}">
              <span class="handheld-toolbar-icon"><i class="ci-home"></i></span><span class="handheld-toolbar-label">Home</span>
          </a>
          <a class="d-table-cell handheld-toolbar-item" href="dashboard-favorites.html">
            <span class="handheld-toolbar-icon"><i class="ci-package"></i></span><span class="handheld-toolbar-label">Kategori</span>
          </a>
          <a class="d-table-cell handheld-toolbar-item" href="{{route('cart')}}">
            <span class="handheld-toolbar-icon"><i class="ci-cart"></i></span><span class="handheld-toolbar-label">Keranjang</span>
          </a>
          @if(Auth::user())
          <a class="d-table-cell handheld-toolbar-item"  href="{{route('pengaturan')}}" >
              <span class="handheld-toolbar-icon"><i class="ci-user"></i></span><span class="handheld-toolbar-label">Profil</span>
          </a>
          @else
          <a class="d-table-cell handheld-toolbar-item"  href="{{route('pengaturan')}}">
            <span class="handheld-toolbar-icon"><i class="ci-sign-in"></i></span><span class="handheld-toolbar-label">Masuk</span>
          </a>
          @endif
      </div>
    </div>

    <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span><i class="btn-scroll-top-icon ci-arrow-up">   </i></a>
    
    @section('js')
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/simplebar/dist/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js')}}"></script>
    <script src="{{asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>
    @show
    <!-- Main theme script -->
    <script src="{{asset('assets/js/theme.min.js')}}"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
  </body>
  </html>