@extends('layouts.app')
@section('main')
    <main class="page-wrapper">
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      @include('components.headers.default')
      <!-- Dashboard header-->
      @include('components.users.pagetitle')
      <div class="container mb-5 pb-3">
        <!-- Danger alert -->
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            @include('components.profiles.aside')
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                @if(session('success'))
                    @include('components.alerts.success',['message' => session('success')])
                @endif
                @if(session('error'))
                    @include('components.alerts.danger',['message' => session('error')])
                @endif
                
                @if(count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul style="margin-bottom: 0px">
                        @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @yield('content')
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
@endsection
@section('js')
    @parent
    @yield('extra-js')
@endsection