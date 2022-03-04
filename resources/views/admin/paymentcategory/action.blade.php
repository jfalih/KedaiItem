<form method="POST" action="{{route('admin.kategoripembayaran.destroy', ['kategoripembayaran' => $data])}}">
    @csrf
    @method('DELETE')
    <a href="{{route('admin.kategoripembayaran.edit',['kategoripembayaran' => $data])}}" class="btn btn-warning waves-effect waves-light">
        <i class="fa fa-edit"></i>
    </a>
    <button type="submit" class="btn btn-danger waves-effect waves-light">
        <i class="fa fa-trash"></i>
    </button>
</form>