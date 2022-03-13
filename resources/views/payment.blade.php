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
                                      <h3>Payment #<span class="digits counter">{{$payment->id}}</span></h3>
                                      <p>Dibuka Sejak: {{$payment->created_at}}</p>
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
                                @if($payment->method_id)
                                <div class="col-xl-8">
                                  <div class="text-xl-end" id="project">
                                    <h6>Status Pembayaran</h6>
                                    @include('pembelian.status', ['data' => $payment])
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
                                      @foreach($purchases as $purchase)
                                      @php
                                      if($purchase->options == 'premium'):
                                        $total += ($purchase->item->price*$purchase->quantity)+App\Models\Setting::first()->harga;   
                                      else:
                                        $total += ($purchase->item->price*$purchase->quantity);   
                                      endif;
                                      @endphp
                                      <tr>
                                        <td>
                                          <label>{{$purchase->item->subcategories()->first()->name}}</label>
                                          <p class="m-0">{{$purchase->item->name}}</p>
                                        </td>
                                        <td>
                                          @if($purchase->options == 'premium')
                                          <p class="m-0">{{Str::title($purchase->options)}} Fee: Rp{{number_format(App\Models\Setting::first()->harga,0,',','.')}}</p>
                                          @else
                                          <p class="m-0">{{Str::title($purchase->options)}}</p> 
                                          @endif
                                        </td>
                                        <td>
                                          <p class="itemtext digits">{{$purchase->quantity}}</p>
                                        </td>
                                        <td>
                                          <p class="itemtext digits">Rp{{number_format($purchase->item->price,0,',','.')}}</p>
                                        </td>
                                        <td>
                                          @if($purchase->options == 'premium')
                                          <p class="itemtext digits">Rp{{number_format($purchase->quantity*$purchase->item->price+App\Models\Setting::first()->harga,0,',','.')}}</p>
                                          @else
                                          <p class="itemtext digits">Rp{{number_format($purchase->quantity*$purchase->item->price,0,',','.')}}</p>
                                          @endif
                                        </td>
                                      </tr>
                                      @endforeach
                                      @if($payment->method_id)
                                      <tr>
                                        <td></td>
                                        <td class="Rate">
                                          <h6 class="mb-0 p-2">Fee Customer</h6>
                                        </td>
                                        <td class="payment digits">
                                          <h6 class="mb-0 p-2">Rp{{number_format($data_api['data']['fee_customer'],0,',','.')}}</h6>
                                        </td>
                                        <td class="Rate">
                                          <h6 class="mb-0 p-2">Total</h6>
                                        </td>
                                        <td class="payment digits">
                                          <h6 class="mb-0 p-2">Rp{{number_format($total+$data_api['data']['fee_customer'],0,',','.')}}</h6>
                                        </td>
                                      </tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                                <!-- End Table-->
                                @if(!$payment->method_id)
                                <form method="POST" action="{{route('purchase',['id' => $payment->id])}}" class="col mt-3">
                                  @csrf
                                  <div class="row">  
                                    <div class="col-md-12">
                                      <h6>Metode pembayaran:</h6>
                                      <p>Pilih metode pembayaran yang sesuai dan akan digunakan oleh kamu.</p>
                                    </div>
                                    @error('method')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      {{$message}}
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @enderror     
                                    @foreach($categoryPayment as $payment)
                                    <div class="col-sm-6 mt-3">
                                      <div class="card">
                                        <div class="media p-20">
                                          <div class="radio radio-primary me-3">
                                            <input id="{{$payment->code}}" type="radio" name="method" value="{{$payment->id}}">
                                            <label for="{{$payment->code}}"></label>
                                          </div>
                                          <div class="media-body">
                                            <h6 class="mt-0 mega-title-badge">{{$payment->name}}<span class="badge badge-primary pull-right digits">{{$payment->code}}</span></h6>
                                            <p>Biaya Admin: Rp{{number_format($payment->fee_admin,0,',','.')}}</p>
                                            <img style="object-fit: cover; width:auto;height:80px;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/BANK_BRI_logo.svg/2560px-BANK_BRI_logo.svg.png"/>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    @endforeach
                                  </div>
                                  <div class="col-sm-12 text-center mt-3">
                                    <button class="btn btn-secondary" type="button" data-bs-original-title="" title="">Batalkan Pembayaran</button>
                                    <button class="btn btn btn-primary me-2" type="submit" data-bs-original-title="" title="">Lanjutkan Pembayaran</button>
                                  </div>
                                </form>
                                @else
                                <div class="col mt-3">
                                  <div class="col-md-12">
                                    <center>
                                      <h2>Dibayarkan Sebelum:</h2>
                                      <h5>{{date('Y-m-d H:i:s',$data_api['data']['expired_time'])}}</h5>
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
                                  @if($purchase->status == 'pending')
                                  <form  method="POST" action="{{route('payment.check',['id'=> $purchase->id])}}">
                                    @csrf  
                                    <button class="btn btn btn-primary me-2" type="submit">Cek Pembayaran</button>
                                  </form>
                                  @else 
                                    <a href="{{route('payment')}}" class="btn btn-secondary"  type="button">Kembali</a>
                                  @endif
                                </div>
                                @endif
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