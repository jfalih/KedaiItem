@extends('layouts.user')
@section('content')
        <div class="page-body checkout">
            <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                    <h3>Pembayaran</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Pembayaran</li>
                    </ol>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container invoice">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                          <div class="card-body">                            
                            <div>
                              <div>
                                <div class="row invo-header">
                                  <div class="col-sm-6">
                                    <div class="media">
                                      <div class="media-left"><a href="index.html" data-bs-original-title="" title=""><img class="media-object img-60" src="../assets/images/logo/logo-1.png" alt=""></a></div>
                                      <div class="media-body m-l-20">
                                        <h4 class="media-heading f-w-600">{{env('APP_NAME')}}</h4>
                                        <p>kedaiitem@emailnya<br><span class="digits">0124123123128</span></p>
                                      </div>
                                    </div>
                                    <!-- End Info-->
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="text-md-end text-xs-center">
                                      <h3>Topup #<span class="digits counter">{{$topup->id}}</span></h3>
                                      <p>Dibuka Sejak: {{$topup->created_at}}</p>
                                    </div>
                                    <!-- End Title                                 -->
                                  </div>
                                </div>
                              </div>
                              <!-- End InvoiceTop-->
                              <div class="row invo-profile">
                                <div class="col-xl-4">
                                  <div class="media">
                                    <div class="media-left">
                                      <img class="media-object rounded-circle img-60" src="{{asset('assets_users/assets/images/user/1.jpg')}}" alt=""></div>
                                    <div class="media-body m-l-20">
                                      <h4 class="media-heading f-w-600">{{Auth::user()->name}}</h4>
                                      <p>{{Auth::user()->email}}<br><span class="digits">{{Auth::user()->nomorhp}}</span></p>
                                    </div>
                                  </div>
                                </div>
                                @if($topup->method)
                                <div class="col-xl-8">
                                  <div class="text-xl-end" id="project">
                                    <h6>Status Pembayaran</h6>
                                    @if($category_pembayaran['data']['status'] == 'UNPAID')
                                      <h2><span class="badge badge-danger">Belum Dibayar</span></h2>
                                    @else
                                      <h2><span class="badge badge-primary">Sudah Dibayar</span></h2>
                                    @endif
                                  </div>
                                </div>
                                @endif
                              </div>
                              <!-- End Invoice Mid-->
                              <div>
                                <div class="table-responsive invoice-table" id="table">
                                  <table class="table table-bordered table-striped">
                                    <tbody>
                                      <tr>
                                        <td class="item">
                                          <h6 class="p-2 mb-0">Deskripsi Item</h6>
                                        </td>
                                        <td class="item">
                                          <h6 class="p-2 mb-0">Pengiriman</h6>
                                        </td>
                                        <td class="Hours">
                                          <h6 class="p-2 mb-0">Quantity</h6>
                                        </td>
                                        <td class="Rate">
                                          <h6 class="p-2 mb-0">Harga</h6>
                                        </td>
                                        <td class="subtotal">
                                          <h6 class="p-2 mb-0">Sub-total</h6>
                                        </td>
                                      </tr>
                                      @php
                                       $total = 0;   
                                      @endphp
                                      @if($topup->method)
                                      <tr>
                                        <td></td>
                                        <td class="Rate">
                                          <h6 class="mb-0 p-2">Fee Customer</h6>
                                        </td>
                                        <td class="payment digits">
                                          <h6 class="mb-0 p-2">Rp{{number_format($category_pembayaran['data']['fee_customer'],0,',','.')}}</h6>
                                        </td>
                                        <td class="Rate">
                                          <h6 class="mb-0 p-2">Total</h6>
                                        </td>
                                        <td class="payment digits">
                                          <h6 class="mb-0 p-2">Rp{{number_format($total+$category_pembayaran['data']['fee_customer'],0,',','.')}}</h6>
                                        </td>
                                      </tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                                <!-- End Table-->
                              </div>
                              <!-- End InvoiceBot-->
                            </div>
                            <!-- End Invoice-->
                            <!-- End Invoice Holder-->
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
@endsection