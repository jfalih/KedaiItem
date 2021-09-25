@forelse($data->roles as $roles)
<span class="badge bg-success rounded-pill">{{$roles->name}}</span>
@empty
<span class="badge bg-danger rounded-pill">Nothing</span>
@endforelse
