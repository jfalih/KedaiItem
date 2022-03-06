@if($data->status == 'pending')
<div class="row">
    <form method="POST" action="{{route('admin.payout.success', ['id' => $data])}}">
        @csrf
        <button type="submit" class="btn btn-success waves-effect waves-light mb-2">
            <i class="fa fa-check"></i> Ubah Sukses
        </button>
    </form>
    <form method="POST" action="{{route('admin.payout.canceled',['id' => $data])}}">
        @csrf
        <button type="submit" class="btn btn-danger waves-effect waves-light">
            <i class="fa fa-times-circle"></i> Tolak Payout
        </button>
    </form>
</div>
@endif