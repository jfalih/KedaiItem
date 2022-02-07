@if($status == 'blocked')
<span class="badge rounded-pill badge-dark tag-pills-sm-mb">Blocked</span>
@endif
@if($status == 'not')
<span class="badge rounded-pill badge-danger tag-pills-sm-mb">Tidak Aktif</span>
@endif
@if($status == 'active')
<span class="badge rounded-pill badge-success tag-pills-sm-mb">Aktif</span>
@endif