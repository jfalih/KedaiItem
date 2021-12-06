@extends('layouts.user')
@section('content')
    <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom mb-5">
      <h2 class="h3 py-2 me-2 text-center text-sm-start">Chat</h2>
    </div>
    <!-- Gallery grid with gutters -->
    @if($convertations->count() > 0)
      <div class="row">
            <div class="table-responsive fs-md mb-4">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Pesan</th>
                        <th>Terakhir Dilihat</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($convertations as $chat)
                    @php
                      $message = $chat->messages()->orderBy('created_at','DESC')->first();
                      $from = $message->from;  
                      if($chat->receiver->username == Auth::user()->username){
                        $toUsername = $from->username;
                        $toImg = $from->profile;
                        $toName = $from->name;
                        $toLastSeen = $from->last_seen;
                      } else {
                        $toUsername = $chat->receiver->username;
                        $toImg = $chat->receiver->profile;
                        $toName = $chat->receiver->name;
                        $toLastSeen = $chat->receiver->last_seen;
                      }
                    @endphp
                    <tr>
                      <td class="py-3">
                          <img src="@if($toImg != null) {{Storage::url($toImg->name)}} @else {{url('assets/img/marketplace/account/avatar.png')}} @endif"alt="@if($toImg != null) {{$toImg->caption}} @else Caption @endif" class="me-2" height="20" width="20">
                          <a class="nav-link-style fw-medium" href="{{url('http://127.0.0.1:8000/chat/'.$toUsername)}}">{{$toName}}</a>
                      </td>
                      <td class="py-3">
                        {{$message->message}}
                      </td>
                      <td class="py-3">
                        {{$toLastSeen}}
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
      </div>
      <!-- Pagination-->
      {{$convertations->links('components.paginations.default')}}
    @else
      <div class="row justify-content-center pt-lg-4 text-center">
        <div class="col-12">
          <img class="d-block mx-auto mb-5" src="{{url('assets/img/begin_chat.svg')}}" width="340" alt="404 Error">
          <h1 class="h3">Belum ada chat nih :(</h1>
          <h3 class="h5 fw-normal mb-4">Kami tidak dapat menemukan chat kamu.</h3>
          <a href="{{route('welcome')}}" class="btn btn-primary">Mulai Chatting</a>
        </div>
      </div>
    @endif
@endsection