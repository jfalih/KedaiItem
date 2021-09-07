<form method="POST" action="{{route('admin.kategori.destroy', ['kategori' => $data])}}">
@csrf
    @method('DELETE')
    <a href="{{route('admin.kategori.edit',['kategori' => $data])}}" class="btn btn-warning waves-effect waves-light">
        <i class="fa fa-edit"></i>
    </a>
    <button type="submit" class="btn btn-danger waves-effect waves-light">
        <i class="fa fa-trash"></i>
    </button>
</form>