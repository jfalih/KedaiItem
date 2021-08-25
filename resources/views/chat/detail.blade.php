@extends('layouts.user')
@section('content')
    <!-- Toolbar-->
    <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-4">
        <div class="d-flex w-100 text-dark text-center me-3">
        
        <div class="d-flex justify-content-center align-items-center px-3">
            <img class="rounded" width="50" src="{{Storage::url(Auth::user()->profile->name)}}" alt="Mary Grant"/>
            <div class="px-3">
                <h6 class="fs-sm mb-n1">Mary Alice Grant</h6>
                <span class="fs-ms text-muted">Desperate housewife</span>
            </div>
            <span class="badge bg-success">Online</span>
        </div>
        </div><a class="btn btn-primary btn-sm" href="account-signin.html"><i class="ci-sign-out me-2"></i>Kembali</a>
    </div>
    <!-- Ticket details (visible on mobile)-->
    <div class="d-flex d-lg-none flex-wrap bg-secondary text-center rounded-3 pt-4 px-4 pb-1 mb-4">
        
        <div class="d-flex fs-ms justify-content-center align-items-center px-3 pb-3">
            <img class="rounded" width="50" src="{{Storage::url(Auth::user()->profile->name)}}" alt="Mary Grant"/>
            <div class="px-3">
                <h6 class="fs-sm mb-n1">Mary Alice Grant</h6>
                <span class="fs-ms text-muted">Desperate housewife</span>
            </div>
            <span class="badge bg-success">Online</span>
        </div>
    </div>
    <!-- Accent card -->
    <!-- Secondary card -->
    <div style="height: 400px" class="bg-secondary rounded-3 flex-column p-4 overflow-auto w-100">
        @foreach ($messages as $msg)
        @if($msg->from_id === Auth::user()->id)
        <div style="float: right" class="card text-white mb-3 w-75 bg-dark">
            <div class="card-body">
                <p class="card-text fs-sm">{{$msg->message}}</p>
                <p class="card-text fs-sm">{{$msg->created_at}}</p>
            </div>
        </div>
        @else
        <div style="float: left" class="card text-black mb-3 w-75 bg-secondary">
            <div class="card-body">
                <p class="card-text fs-sm">{{$msg->message}}</p>
                <p class="card-text fs-sm">{{$msg->created_at}}</p>
            </div>
        </div>
        @endif
        @endforeach
    
    </div>
    <!-- Leave message-->
    <h3 class="h5 mt-2 pt-4 pb-2">Kirim Pesan</h3>
    <form class="needs-validation" novalidate="">
        <div class="mb-3">
        <textarea class="form-control" rows="8" placeholder="Kirim pesan kamu disini..." required=""></textarea>
        <div class="invalid-tooltip">Please write the message!</div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center">
        <button class="btn btn-primary my-2" type="submit">Submit message</button>
        </div>
    </form>
    <!-- Products list-->
@endsection
@section('extra-js')
    
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('5e511233887873c74a68', {
    cluster: 'mt1'
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    alert(JSON.stringify(data));
  });
</script>
@endsection