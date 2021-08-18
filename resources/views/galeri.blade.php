@extends('layouts.user')
@section('content')
    <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom mb-5">
      <h2 class="h3 py-2 me-2 text-center text-sm-start">Galeri</h2>
    </div>
    <!-- Products list-->
    <!-- Gallery grid with gutters -->
    <div class="table-responsive fs-md mb-4">
        <table class="table table-hover mb-0">
            <thead>
            <tr>
                <th>Ticket Subject</th>
                <th>Date Submitted | Updated</th>
                <th>Type</th>
                <th>Priority</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-3"><a class="nav-link-style fw-medium" href="account-single-ticket.html">My new ticket</a></td>
                <td class="py-3">09/27/2019 | 09/30/2019</td>
                <td class="py-3">Website problem</td>
                <td class="py-3"><span class="badge bg-warning m-0">High</span></td>
                <td class="py-3"><span class="badge bg-success m-0">Open</span></td>
            </tr>
            <tr>
                <td class="py-3"><a class="nav-link-style fw-medium" href="account-single-ticket.html">Another ticket</a></td>
                <td class="py-3">08/21/2019 | 08/23/2019</td>
                <td class="py-3">Partner request</td>
                <td class="py-3"><span class="badge bg-info m-0">Medium</span></td>
                <td class="py-3"><span class="badge bg-secondary m-0">Closed</span></td>
            </tr>
            <tr>
                <td class="py-3"><a class="nav-link-style fw-medium" href="account-single-ticket.html">Yet another ticket</a></td>
                <td class="py-3">11/19/2018 | 11/20/2018</td>
                <td class="py-3">Complaint</td>
                <td class="py-3"><span class="badge bg-danger m-0">Urgent</span></td>
                <td class="py-3"><span class="badge bg-secondary m-0">Closed</span></td>
            </tr>
            <tr>
                <td class="py-3"><a class="nav-link-style fw-medium" href="account-single-ticket.html">My old ticket</a></td>
                <td class="py-3">06/19/2018 | 06/20/2018</td>
                <td class="py-3">Info inquiry</td>
                <td class="py-3"><span class="badge bg-success m-0">Low</span></td>
                <td class="py-3"><span class="badge bg-secondary m-0">Closed</span></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- Pagination-->
    <div class="col-12">
        <hr class="mt-2 mb-4">
        <div class="d-sm-flex justify-content-between align-items-center">
          <button class="btn btn-primary mt-3 mt-sm-0" href="#upload-modal" data-bs-toggle="modal" type="button"><i class="ci-add-circle me-2"></i> Tambah Gambar</button>
        </div>
    </div>
@endsection