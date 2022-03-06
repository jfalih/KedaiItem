@if($data === 'success')
<span class="badge bg-success rounded-pill">Success</span>
@endif
@if($data === 'pending')
<span class="badge bg-warning rounded-pill">Pending</span>
@endif
@if($data === 'failed')
<span class="badge bg-danger rounded-pill">Failed</span>
@endif