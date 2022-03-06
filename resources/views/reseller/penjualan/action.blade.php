<a href="{{route('chat',['id' => $data->id])}}" class="btn btn-secondary mb-2">Chat</a>
@if($data->status == 'success')
<a href="" class="btn btn-primary">Review</a>
@endif