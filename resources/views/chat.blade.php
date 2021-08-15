@extends('layouts.app')
@section('main')
    <main class="page-wrapper">  
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
                  <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom mb-5">
                    <h2 class="h3 py-2 me-2 text-center text-sm-start">Chat</h2>
                  </div>
                  <!-- Products list-->
                  <!-- Gallery grid with gutters -->
                  <div class="row">
                        <div class="table-responsive fs-md mb-4">
                            <table class="table table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Pesan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="py-3">
                                        <img src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/icons/angular.svg" class="me-2" height="20" width="20" alt="Angular"><a class="nav-link-style fw-medium" href="account-single-ticket.html">My new ticket</a></td>
                                    <td class="py-3">Lorem ipsum dolor sit amet, qui minim labore.</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                  </div>
                  <!-- Pagination-->
                  <div class="col-12">
                      <div class="d-sm-flex justify-content-between align-items-center">
                        <button class="btn btn-primary mt-3 mt-sm-0" href="#upload-modal" data-bs-toggle="modal" type="button"><i class="ci-add-circle me-2"></i> Tambah Gambar</button>
                      </div>
                  </div>
                </div>
              </section>
          </div>
        </div>
      </div>
    </main>
@endsection
@section('js')
    @parent
@endsection