<form method="POST" action="{{route('admin.features.destroy', ['feature' => $data])}}">
    @csrf
        @method('DELETE')
        <a href="{{route('admin.features.edit',['feature' => $data])}}" class="btn btn-warning waves-effect waves-light">
            <i class="fa fa-edit"></i>
        </a>
        <button type="submit" class="btn btn-danger waves-effect waves-light">
            <i class="fa fa-trash"></i>
        </button>
    </form>