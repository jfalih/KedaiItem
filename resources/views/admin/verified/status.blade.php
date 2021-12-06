@if($data === 'success')
<span class="badge bg-success rounded-pill">Terverifikasi</span>
@endif
@if($data === 'pending')
<span class="badge bg-warning rounded-pill">Menunggu Verifikasi</span>
@endif
@if($data === 'failed')
<span class="badge bg-danger rounded-pill">Verifikasi Ditolak</span>
@endif