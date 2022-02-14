@if($data->status->id === 1)
<span class="badge bg-success rounded-pill">Aktif</span>
@else
<span class="badge bg-danger rounded-pill">Tidak Aktif</span>
@endif