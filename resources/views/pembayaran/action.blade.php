<a href="{{route('payment',['id' => $data->id])}}" class="btn btn-primary">Lihat Detail</a>
@if($data->status !== 'success' && $data->status !== 'canceled')
<a href="" class="btn btn-danger">Batalkan</a>
@endif