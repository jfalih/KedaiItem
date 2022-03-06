@if($data->status == 'success')
<h6><span class="badge badge-primary">Transaksi Selesai</span></h6>
@endif
@if($data->status == 'refunded')
<h6><span class="badge badge-primary">Dikembalikan</span></h6>
@endif
@if($data->status == 'failed')
<h6><span class="badge badge-primary">Dibatalkan</span></h6>
@endif
@if($data->status == 'pending')
<h6><span class="badge badge-warning">Belum dibayar</span></h6>
@endif
@if($data->status == 'waiting')
<h6><span class="badge badge-info">Menunggu dikirim</span></h6>
@endif