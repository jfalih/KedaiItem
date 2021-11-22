@extends('layouts.app')
@section('main')
    <main class="page-wrapper">
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      @include('components.headers.default')
      <!-- Dashboard header-->
      @include('components.users.pagetitle')
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            @include('components.profiles.aside')
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
                <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                  <!-- Title-->
                  <div class="d-sm-flex mb-4 flex-wrap justify-content-between align-items-center border-bottom">
                    <h2 class="h3 py-2 me-2 text-center text-sm-start">Pembelian</h2>
                  </div>
                  <!-- Products list-->
                  <!-- Product-->
                  <div class="table-responsive fs-md mb-4">
                    <table class="table table-hover mb-0">
                      <thead>
                        <tr>
                          <th>Order ID #</th>
                          <th>Tanggal Pembelian</th>
                          <th>Status</th>
                          <th>Total</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($pembelian as $pembeli)
                        <tr>
                          <td class="py-3"><a class="nav-link-style fw-medium fs-sm" href="#order-details" data-bs-toggle="modal">{{$pembeli->id}}</a></td>
                          <td class="py-3">{{$pembeli->created_at}}</td>
                          <td class="py-3"></td>
                          <td class="py-3">Rp{{number_format($pembeli->quantity*$pembeli->item->price,2,',','.')}}</td>
                          <td class="py-3">
                            @include('pembelian.action')
                          </td>
                        </tr>
                        @empty
                        <tr>
                          <td colspan="5">Pembelian Masih Kosong</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  <!-- Pagination-->
                  {{$pembelian->links('components.paginations.default')}}
                </div>
              </section>
          </div>
        </div>
      </div>
    </main>
@endsection