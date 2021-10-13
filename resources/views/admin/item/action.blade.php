<form method="POST" action="{{route('admin.kategori.destroy', ['kategori' => $data])}}">
    @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger waves-effect waves-light">
            <i class="fa fa-trash"></i>
        </button>
    </form>