
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Dashboard | Minible - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets_admin/images/favicon.ico')}}">
        @section('css')
        <!-- Bootstrap Css -->
        <link href="{{asset('assets_admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets_admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets_admin/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        @show
    </head>

    
    <body>
    <!-- <body data-layout="horizontal" data-topbar="colored"> -->
        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">

                </div>
            </header>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-dark.png" alt="" height="20">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="20">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <div data-simplebar class="sidebar-menu-scroll">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>
                            <li>
                                <a href="{{route('admin.dashboard')}}">
                                    <i class="uil-home-alt"></i><span class="badge rounded-pill bg-primary float-end">01</span>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.kategori.index')}}">
                                    <i class="uil-window-section"></i>
                                    <span>Kategori</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.subcategory.index')}}">
                                    <i class="uil-window-section"></i>
                                    <span>Subkategori</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-user"></i>
                                    <span>User</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('admin.user.index')}}">Pengaturan User</a></li>
                                    <li><a href="{{route('admin.user.verified')}}">Verified User</a></li>
                                    <li><a href="{{route('admin.user.verified')}}">List Laporan User <b>(It's Soon)</b></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-chat"></i>
                                    <span>Chat</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('admin.chat.index')}}">List Chat</a></li>
                                    <li><a href="{{route('admin.user.verified')}}">Laporan Chat <b>(It's Soon)</b></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-shopping-cart"></i>
                                    <span>Pembelian</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('admin.pembelian.index')}}">List Pembelian</a></li>
                                    <li><a href="{{route('admin.user.verified')}}">List Review <b>(It's Soon)</b></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-cog"></i>
                                    <span>Pengaturan</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('admin.pengaturan.index')}}">Pengaturan Website</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-database"></i>
                                    <span>Item</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('admin.item.index')}}">List Item</a></li>
                                    <li><a href="{{route('admin.user.verified')}}">List Laporan Item</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    @yield('content')
                </div>
                <!-- End Page-content -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Minible.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://themesbrand.com/" target="_blank" class="text-reset">Themesbrand</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">

                <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>



                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" />
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-3.jpg" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" />
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-4.jpg" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                        <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
                    </div>

            
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        @section('js')
        <!-- JAVASCRIPT -->
        <script src="{{asset('assets_admin/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>

        <!-- apexcharts -->
        <script src="{{asset('assets_admin/libs/apexcharts/apexcharts.min.js')}}"></script>

        <script src="{{asset('assets_admin/js/pages/dashboard.init.js')}}"></script>            
        @show
        <!-- App js -->
        <script src="{{asset('assets_admin/js/app.js')}}"></script>
    
    </body>

</html>