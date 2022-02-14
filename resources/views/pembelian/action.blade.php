<a href="{{route('chat',['id' => $data->id])}}" class="btn btn-secondary mb-2">Chat Penjual</a>
<a href="{{route('payment',['id' => $data->payments->first()->id])}}" class="btn btn-primary mb-2">Detail</a>
@if($data->status == 'success')
<a href="" class="btn btn-primary">Berikan Review</a>
@endif