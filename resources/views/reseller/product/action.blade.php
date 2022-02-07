<form class="mb-1" method="POST" action={{route('reseller.product.delete',['item' => $action])}}>
    @method('DELETE')
    @csrf
<button class="btn btn-danger"><i class="fa fa-trash"></i> Buang</button>
</form>
<div class="mb-1">
<a href="{{route('reseller.product.edit',['item' => $action])}}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
</div>
<div>
<a href="{{route('item.detail',[
    'seller' => $action->user->username,
    'product' => $action->slug
])}}" class="btn btn-primary"><i class="fa fa-eye"></i> Detail</a>
</div>