<form method="POST" action="{{route('admin.user.destroy', ['user' => $data])}}">
    @csrf
    @method('DELETE')
    <a href="{{route('admin.user.show',['user' => $data])}}" class="btn btn-primary waves-effect waves-light">
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{route('admin.user.edit',['user' => $data])}}" class="btn btn-warning waves-effect waves-light">
        <i class="fa fa-edit"></i>
    </a>
    <button type="submit" class="btn btn-danger waves-effect waves-light">
        <i class="fa fa-trash"></i>
    </button>
</form>