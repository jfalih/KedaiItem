<div class="page-title-overlap bg-accent pt-4">
    <div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
      <div class="d-flex align-items-center pb-3">
        <div class="img-thumbnail rounded-circle position-relative flex-shrink-0" style="width: 6.375rem;"><img class="rounded-circle" src="{{url('assets/img/marketplace/account/avatar.png')}}" alt="{{Auth::user()->name}}"></div>
        <div class="ps-3">
          <h3 class="text-light fs-lg mb-0">{{Auth::user()->name}}</h3><span class="d-block text-light fs-ms opacity-60 py-1">Member Sejak {{Auth::user()->created_at}}</span>
        </div>
      </div>
      <div class="d-flex">
        <div class="text-sm-end me-5">
          <div class="text-light fs-base">Status</div>
          <p class="text-light">{{implode(",",Auth::user()->role_name)}}</p>
        </div>
        <div class="text-sm-end">
          <div class="text-light fs-base">Sisa saldo</div>
          <p class="text-light">{{'Rp'.number_format(Auth::user()->balance,2,',','.')}}</p>
        </div>
      </div>
    </div>
  </div>