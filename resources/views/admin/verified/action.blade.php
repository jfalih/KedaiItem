<div class="row">
    <form method="POST" action="{{route('admin.user.verified.add', ['user' => $data])}}">
        @csrf
        <button type="submit" class="btn btn-success waves-effect waves-light">
            <i class="fa fa-user-check"></i> Verif User
        </button>
    </form>
    <form method="POST" action="{{route('admin.user.verified.declined',['user' => $data])}}">
        @csrf
        <button type="submit" class="btn btn-danger waves-effect waves-light">
            <i class="fa fa-times-circle"></i> Tolak User
        </button>
    </form>
</div>