@extends('layouts.user')
@section('content')
    <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom mb-5">
      <h2 class="h3 py-2 me-2 text-center text-sm-start">Chat</h2>
    </div>
    <!-- Gallery grid with gutters -->
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
                  @forelse($convertations as $chat)
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
                  @empty

                  @endforelse
                  </tbody>
              </table>
          </div>
    </div>
    <!-- Pagination-->
    {{$convertations->links('components.paginations.default')}}

@endsection