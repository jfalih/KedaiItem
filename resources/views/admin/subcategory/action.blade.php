<form method="POST" action="{{route('admin.subcategory.destroy', ['subcategory' => $data])}}">
    @csrf
        @method('DELETE')
        <a href="{{route('admin.subcategory.edit',['subcategory' => $data])}}" class="btn btn-warning waves-effect waves-light">
            <i class="fa fa-edit"></i>
        </a>
        <button type="submit" class="btn btn-danger waves-effect waves-light">
            <i class="fa fa-trash"></i>
        </button>
    </form>