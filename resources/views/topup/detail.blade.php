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
                              @if(session('success'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  {{session('success')}}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                              @endif
                              @if(session('error'))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  {{session('error')}}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                              @endif
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
                                <div class="col-xl-8">
                                  <div class="text-xl-end" id="project">
                                    <h6>Status Pembayaran</h6>
                                    @if($data_api['data']['status'] == 'UNPAID')
                                      <h2><span class="badge badge-danger">Belum Dibayar</span></h2>
                                    @else
                                      <h2><span class="badge badge-primary">Sudah Dibayar</span></h2>
                                    @endif
                                  </div>
                                </div>
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
                                        <td class="subtotal">
                                          <h6 class="p-2 mb-0">Sub-total</h6>
                                        </td>
                                      </tr>
                                      @foreach($data_api['data']['order_items'] as $order)
                                        <tr>
                                          <td>
                                            <label>{{$order['sku']}}</label>
                                            <p class="m-0">{{$order['name']}}</p>
                                          </td>
                                          <td>
                                            <p class="itemtext digits">Rp{{number_format($order['price'],0,',','.')}}</p>
                                          </td>
                                        </tr>
                                      @endforeach
                                      <tr>
                                        <td>
                                          <label>Fee customer</label>
                                          <p class="m-0">Fee yang dibayarkan customer sebagai biaya admin.</p>
                                        </td>
                                        <td>
                                          <p class="itemtext digits">Rp{{number_format($topup->paymentcategory->fee_admin,0,',','.')}}</h6>
                                        </td>
                                      </tr>
                                      @if($topup->method_id)
                                      <tr>
                                        <td class="Rate">
                                          <h6 class="mb-0 p-2">Total</h6>
                                        </td>
                                        <td class="payment digits">
                                          <h6 class="mb-0 p-2">Rp{{number_format($topup->nominal+$topup->kode_unik+$data_api['data']['fee_customer'],0,',','.')}}</h6>
                                        </td>
                                      </tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                                <!-- End Table-->
                                
                                <div class="col mt-3">
                                  <div class="col-md-12">
                                    <center>
                                      <h2>Dibayarkan Sebelum:</h2>
                                      <h1 class="text-danger">{{date('Y-m-d H:i:s',$data_api['data']['expired_time'])}}</h1>
                                    </center>
                                  </div>
                                  <div class="col-md-12">
                                    <h6>Intruksi pembayaran:</h6>
                                    <p>Berikut intruksi pembayaran yang dapat kamu lakukan, silahkan refresh halaman ini jika sudah melakukan pembayaran.</p>
                                  </div>
                                  <div class="col-sm-12 mt-3">
                                    <div class="default-according" id="accordion">
                                      @foreach($data_api['data']['instructions'] as $stepKey => $stepVal)
                                      <div class="card">
                                        <div class="card-header" id="heading{{$stepKey}}">
                                          <h5 class="mb-0">
                                            <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse{{$stepKey}}" aria-expanded="true" aria-controls="collapse{{$stepKey}}">{{$stepVal['title']}}</button>
                                          </h5>
                                        </div>
                                        <div class="collapse @if($stepKey == 0) show @endif" id="collapse{{$stepKey}}" aria-labelledby="heading{{$stepKey}}" data-bs-parent="#accordion" style="">
                                          <div class="card-body">
                                            <ul>
                                              @foreach($stepVal['steps'] as $stepChild)
                                              <li>{!! $stepChild !!}</li>
                                              @endforeach
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                      @endforeach
                                    </div>
                                  </div>
                                </div>
                                <div class="d-flex text-center mt-3">
                                  @if($topup->status == 'pending')
                                  <form  method="POST" action="{{route('topup.check',['id'=> $topup->id])}}">
                                    @csrf  
                                    <button class="btn btn btn-primary me-2" type="submit">Cek Topup</button>
                                  </form>
                                  <form  method="POST" action="{{route('topup.cancel')}}">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Batalkan Topup</button>
                                  </form>
                                  @else 
                                    <a href="{{route('topup')}}" class="btn btn-secondary"  type="button">Kembali</a>
                                  @endif
                                </div>
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