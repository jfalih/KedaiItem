@extends('layouts.user')
@section('content')
    <!-- Toolbar-->
    <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-4">
        <div class="d-flex w-100 text-dark text-center me-3">
        
        <div class="d-flex justify-content-center align-items-center px-3">
            <img class="rounded" width="50" src="{{($seller->profile == null) ? Storage::url('public/images/user.png') : Storage::url($seller->profile->name)}}" alt="Mary Grant"/>
            <div class="px-3">
                <h6 class="fs-sm mb-n1">{{$seller->name}}</h6>
                <span class="fs-ms text-muted">{{$seller->username}}</span>
            </div>
            @if(Cache::has('user-online-'.$seller->id))
                <span class="badge bg-success">Online</span>
            @else
                <div class="px-3">
                    <span class="badge bg-danger">Terakhir Dilihat</span>
                    <span class="badge bg-danger">{{$seller->last_seen}}</span>
                </div>
            @endif
        </div>
        </div><a class="btn btn-primary btn-sm" href="account-signin.html"><i class="ci-sign-out me-2"></i>Kembali</a>
    </div>
    <!-- Ticket details (visible on mobile)-->
    <div class="d-flex d-lg-none flex-wrap bg-secondary text-center rounded-3 pt-4 px-4 pb-1 mb-4">
        
        <div class="d-flex fs-ms justify-content-center align-items-center px-3 pb-3">
            <img class="rounded" width="50" src="{{($seller->profile == null) ? Storage::url('public/images/user.png') : Storage::url($seller->profile->name)}}" alt="Mary Grant"/>
            <div class="px-3">
                <h6 class="fs-sm mb-n1">{{$seller->name}}</h6>
                <span class="fs-ms text-muted">{{$seller->username}}</span>
            </div>
            @if(Cache::has('user-online-'.$seller->id))
                <span class="badge bg-success">Online</span>
            @else
                <div class="px-3">
                    <span class="badge bg-danger">Terakhir Dilihat</span>
                    <span class="badge bg-danger">{{$seller->last_seen}}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- Accent card -->
    <!-- Secondary card -->
    <div id="chat" style="height: 400px" class="bg-secondary rounded-3 flex-column p-4 overflow-auto w-100">
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
            <textarea name="message" class="form-control" rows="8" placeholder="Kirim pesan kamu disini..."></textarea>
            <div id="invalid-message"></div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center">
        <button class="btn btn-primary my-2" id="send-message" type="submit">Submit message</button>
        </div>
    </form>
    <!-- Products list-->
@endsection
@section('extra-js')
<script type="text/javascript">
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $("#send-message").click(function(e){
        e.preventDefault();
        var message = $("textarea[name=message]").val();
        $.ajax({
           type:'POST',
           url:"{{ route('chat.create', ['user' => $seller->username]) }}",
           data:{
               message:message
            },
           success:function(data){
                $('#chat').append(data.data);
                $("#chat").animate({
                    scrollTop: $('#chat')[0].scrollHeight - $('#chat')[0].clientHeight
                }, 1000);
                $("textarea[name=message]").val('');
                if($('textarea[name=message]').hasClass('is-invalid')){
                    $("textarea[name=message]").removeClass('is-invalid');
                    $("#invalid-message").empty();
                }
            },
           error: function(xhr, status, error) 
            {
                $("textarea[name=message]").addClass('is-invalid')
                $.each(xhr.responseJSON.errors, function (key, item) 
                {
                    $("#invalid-message").append("<div class='text-danger'>"+item+"</div>");
                });

            }
        });
  
    });
</script>
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