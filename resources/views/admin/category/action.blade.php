<form method="POST" action="{{route('kategori.destroy', ['kategori' => $data->id])}}">
@csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger waves-effect waves-light">
        <i class="fa fa-trash"></i>
    </button>
    
</form>