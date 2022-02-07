@if($stok > 0)
<span class="badge rounded-pill badge-success tag-pills-sm-mb">Sisa Stok:{{$stok}}</span>
@else
<span class="badge rounded-pill badge-danger tag-pills-sm-mb">Stok Habis</span>
@endif