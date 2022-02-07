@extends('layouts.user')
@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_users/assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_users/assets/css/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_users/assets/css/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_users/assets/css/prism.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_users/assets/css/vector-map.css') }}">
@endsection
@section('content')
    <!-- Page Sidebar Ends-->
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid dashboard-default-sec">
            <div class="row">
                <div class="col-xl-5 box-col-12 des-xl-100">
                    <div class="row">
                        <div class="col-xl-12 col-md-6 box-col-6 des-xl-50">
                            <div class="card profile-greeting">
                                <div class="card-body text-center ">
                                    <h3 class="font-light">Selamat datang, {{ Auth::user()->name }}!!</h3>
                                    <p>Selamat datang di {{ env('APP_NAME') }}, kamu bisa mulai membeli item game dan juga
                                        menjualnya.</p>
                                    <button class="btn btn-light">Jadi Penjual</button>
                                </div>
                                <div class="confetti">
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                    <div class="confetti-piece"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-3 col-sm-6 box-col-3 des-xl-25 rate-sec">
                            <div class="card income-card card-primary">
                                <div class="card-body text-center">
                                    <div class="round-box">
                                        <i data-feather="credit-card"></i>
                                    </div>
                                    <h5>Rp{{ Auth::user()->balance }}</h5>
                                    <p>Uangku</p>
                                    <button class="btn btn-primary">Isi Saldo</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-3 col-sm-6 box-col-3 des-xl-25 rate-sec">
                            <div class="card income-card card-secondary">
                                <div class="card-body text-center">
                                    <div class="round-box">
                                    </div>
                                    <h5>2,03,59</h5>
                                    <p>Total Pembelian</p>
                                    <button class="btn btn-secondary">Cek history</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 box-col-12 des-xl-100 dashboard-sec">
                    <div class="card income-card">
                        <div class="card-header">
                            <div class="header-top d-sm-flex align-items-center">
                                <h5>Grafik pembelian</h5>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div id="chart-timeline-dashbord"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 xl-100 box-col-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5>5 Pembelian Terakhir</h5>
                        </div>
                        <div class="card-body">
                            <div class="user-status table-responsive">
                                <table class="table table-bordernone">
                                    <thead>
                                        <tr>
                                            <th scope="col">Details</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="f-w-600">Simply dummy text of the printing</td>
                                            <td>1</td>
                                            <td class="font-primary">Pending</td>
                                            <td>
                                                <div class="span badge rounded-pill pill-badge-secondary">6523</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="f-w-600">Long established</td>
                                            <td>5</td>
                                            <td class="font-secondary">Cancle</td>
                                            <td>
                                                <div class="span badge rounded-pill pill-badge-success">6523</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="f-w-600">sometimes by accident</td>
                                            <td>10</td>
                                            <td class="font-secondary">Cancle</td>
                                            <td>
                                                <div class="span badge rounded-pill pill-badge-warning">6523</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="f-w-600">Classical Latin literature</td>
                                            <td>9</td>
                                            <td class="font-primary">Return</td>
                                            <td>
                                                <div class="span badge rounded-pill pill-badge-primary">6523</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="f-w-600">keep the site on the Internet</td>
                                            <td>8</td>
                                            <td class="font-primary">Pending</td>
                                            <td>
                                                <div class="span badge rounded-pill pill-badge-danger">6523</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="f-w-600">Molestiae consequatur</td>
                                            <td>3</td>
                                            <td class="font-secondary">Cancle</td>
                                            <td>
                                                <div class="span badge rounded-pill pill-badge-info">6523</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="f-w-600">Pain can procure</td>
                                            <td>8</td>
                                            <td class="font-primary">Return</td>
                                            <td>
                                                <div class="span badge rounded-pill pill-badge-primary">6523</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
@section('js')
    @parent

    <script src="{{ asset('assets_users/assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/prism/prism.min.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/custom-card/custom-card.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/vector-map/map/jquery-jvectormap-au-mill.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/vector-map/map/jquery-jvectormap-in-mill.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/vector-map/map/jquery-jvectormap-asia-mill.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets_users/assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
@endsection
