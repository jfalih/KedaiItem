@extends('layouts.user')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/datatables.css')}}">
@endsection
@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3>Chat</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}" data-bs-original-title="" title="">Home</a></li>
            <li class="breadcrumb-item active">Chat</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col call-chat-body">
        <div class="card">
          <div class="card-body p-0">
            <div class="row chat-box">
              <!-- Chat right side start-->
              <div class="col chat-right-aside">
                <!-- chat start-->
                <div class="chat">
                  <!-- chat-header start-->
                  <div class="media chat-header clearfix"><img class="rounded-circle" src="{{asset('assets_users/assets/images/user/8.jpg')}}" alt="">
                    <div class="media-body">
                      <div class="about">
                        <div class="name">{{$purchase->item->user->name}}</div>
                        <div class="status digits">Last seen {{$purchase->item->user->last_seen}}</div>
                      </div>
                    </div>
                    <ul class="list-inline float-start float-sm-end chat-menu-icons">
                      <li class="list-inline-item"><a href="javascript:void(0)"><i class="icon-search"></i></a></li>
                      <li class="list-inline-item"><a href="javascript:void(0)"><i class="icon-clip"></i></a></li>
                      <li class="list-inline-item"><a href="javascript:void(0)"><i class="icon-headphone-alt"></i></a></li>
                      <li class="list-inline-item"><a href="javascript:void(0)"><i class="icon-video-camera"></i></a></li>
                      <li class="list-inline-item toogle-bar"><a href="javascript:void(0)"><i class="icon-menu"></i></a></li>
                    </ul>
                  </div>
                  <!-- chat-header end-->
                  <div class="chat-history chat-msg-box custom-scrollbar">
                    <div class="col">
                        <div class="d-flex col-md-12 justify-content-end">
                            <div class="w-100 job-search border mb-4">
                                <div class="card-body">
                                <div class="media"><img class="img-40 img-fluid m-r-20" src="{{asset('assets_users/assets/images/job-search/1.jpg')}}" alt="">
                                    <div class="media-body">
                                    <h6 class="f-w-600"><a href="job-details.html">{{$purchase->item->name}}</a>@include('pembelian.status', ['data' => $purchase])</h6>
                                    <p>Rp {{number_format($purchase->item->price,0,',','.')}} x {{$purchase->quantity}}<br>Username / Nickname Game : {{$purchase->gusername}}</p>
                                    </div>
                                </div>
                                <p>Catatan:<br>{{$purchase->catatan}}.</p>
                                </div>
                            </div>
                        </div>
                        @foreach($messages as $msg)
                        <div class="d-flex col-md-12 @if($msg->from_id == Auth::user()->id) justify-content-end @endif  mb-2">
                            <div class="w-50">
                                <div class="alert  @if($msg->from_id == Auth::user()->id) alert-primary @else alert-light @endif">
                                    <p>{{$msg->message}}<br>{{date('H:i:s', strtotime($msg->created_at))}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                  </div>
                  <!-- end chat-history-->
                  <div class="chat-message clearfix">
                    <div class="row">
                      <div class="col-xl-12">
                        <div class="input-group text-box">
                          <input class="form-control input-txt-bx" id="message-to-send" type="text" name="message-to-send" placeholder="Type a message......">
                          <button class="btn btn-primary input-group-text" type="button">SEND</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end chat-message-->
                  <!-- chat end-->
                  <!-- Chat right side ends-->
                </div>
              </div>
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
<script src="{{asset('assets_users/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets_users/assets/js/datatable/datatables/datatable.custom.js')}}"></script>

@endsection