@forelse($data->categories as $category)
<span class="badge @if($category->status->id === 1) bg-success @else bg-danger @endif rounded-pill">{{$category->name}}</span>
@empty
<span class="badge bg-default rounded-pill">Nothing</span>
@endforelse
