@if($data->status == 'success')
<h6><span class="badge badge-primary">Sudah dibayar</span></h6>
@endif
@if($data->status == 'canceled')
<h6><span class="badge badge-primary">Dibatalkan</span></h6>
@endif
@if($data->status == 'pending')
<h6><span class="badge badge-primary">Menunggu</span></h6>
@endif
@if($data->status == 'refunded')
<h6><span class="badge badge-primary">Dikembalikan</span></h6>
@endif