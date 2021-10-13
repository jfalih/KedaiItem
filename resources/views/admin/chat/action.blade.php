<form method="POST" action="{{route('admin.chat.destroy', ['chat' => $data])}}">
    @csrf
    @method('DELETE')
    <a href="{{route('admin.chat.show',['chat' => $data])}}" class="btn btn-primary waves-effect waves-light">
        <i class="fa fa-eye"></i>
    </a>
    <button type="submit" class="btn btn-danger waves-effect waves-light">
        <i class="fa fa-trash"></i>
    </button>
</form>