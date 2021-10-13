<div class="row">
    <form class="col-6 col-lg-4" method="POST" action="{{route('admin.user.verified.add', ['user' => $data])}}">
        @csrf
        <button type="submit" class="btn btn-success waves-effect waves-light">
            <i class="fa fa-user-check"></i>
        </button>
    </form>
    <form class="col-6 col-lg-4" method="POST" action="{{route('admin.user.verified.declined',['user' => $data])}}">
        @csrf
        <button type="submit" class="btn btn-danger waves-effect waves-light">
            <i class="fa fa-times-circle"></i>
        </button>
    </form>
</div>