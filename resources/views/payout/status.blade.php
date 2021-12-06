@if($data->status == 'pending')
<span class="badge bg-warning rounded-pill">Menunggu Penarikan Dana</span>
@endif
@if($data->status == 'success')
<span class="badge bg-success rounded-pill">Penarikan Dana Berhasil</span>
@endif
@if($data->status == 'failed')
<span class="badge bg-danger rounded-pill">Penarikan Dana Ditolak</span>
@endif