@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Dashboard</h4>


            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="fas fa-shopping-cart text-success"></i>
                    </div>
                    <div>
                        @php 
                            $quantity = 0;
                            foreach (App\Models\Purchase::get() as $pembelian) {
                                $quantity += $pembelian->quantity * $pembelian->item->price;
                            }
                        @endphp
                        <h4 class="mb-1 mt-1">Rp{{number_format($quantity,2,',','.')}}</h4>
                        <p class="text-muted mb-0">Total Pembelian Dari {{App\Models\Purchase::count()}} Order</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="fas fa-database text-warning"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{App\Models\Item::count()}} </span></h4>
                        <p class="text-muted mb-0">Total Item</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="fas fa-user text-primary"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{App\Models\User::count()}}</span></h4>
                        <p class="text-muted mb-0">Total Pengguna</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

    </div> <!-- end row-->
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                <a class="dropdown-item" href="#">Monthly</a>
                                <a class="dropdown-item" href="#">Yearly</a>
                                <a class="dropdown-item" href="#">Weekly</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title mb-4">Sales Analytics</h4>
                    <div class="mt-1">
                        <ul class="list-inline main-chart mb-0">
                            <li class="list-inline-item chart-border-left me-0 border-0">
                                <h3 class="text-primary">$<span data-plugin="counterup">2,371</span><span class="text-muted d-inline-block font-size-15 ms-3">Income</span></h3>
                            </li>
                            <li class="list-inline-item chart-border-left me-0">
                                <h3><span data-plugin="counterup">258</span><span class="text-muted d-inline-block font-size-15 ms-3">Sales</span>
                                </h3>
                            </li>
                            <li class="list-inline-item chart-border-left me-0">
                                <h3><span data-plugin="counterup">3.6</span>%<span class="text-muted d-inline-block font-size-15 ms-3">Conversation Ratio</span></h3>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <div id="sales-analytics-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">10 Top Reseller</h4>
                    <div data-simplebar style="max-height: 336px;">
                        <div class="table-responsive">
                            <table class="table table-borderless table-centered table-nowrap">
                                <tbody>
                                    @forelse ($resellers as $reseller)
                                    <tr>
                                        <td style="width: 20px;">
                                            <img src="@if($reseller->profile){{Storage::url($reseller->profile->name)}}@else{{url('assets/img/marketplace/account/avatar.png')}}@endif" class="avatar-xs rounded-circle " alt="@if($reseller->profile){{$reseller->profile->caption}}@else'Caption'@endif">
                                        </td>
                                        <td>
                                            <h6 class="font-size-15 mb-1 fw-normal">{{$reseller->name}}</h6>
                                            <p class="text-muted font-size-13 mb-0">Penjualan: {{$reseller->sold}}</p>
                                        </td>
                                        <td class="text-muted fw-semibold text-end">
                                            <i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>Rp{{$reseller->pendapatan}}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>Tidak ada reseller</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> <!-- enbd table-responsive-->
                    </div> <!-- data-sidebar-->
                </div><!-- end card-body-->
            </div> <!-- end card-->
        </div><!-- end col -->

    </div> <!-- end row-->
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Top 10 Item</h4>
                    <div data-simplebar style="max-height: 336px;">
                        <div class="table-responsive">
                            <table class="table table-borderless table-centered table-nowrap">
                                <tbody>
                                    <thead class="table-light">
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Nama</th>
                                            <th>Terjual</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @forelse($ten_item as $item)
                                    <tr>
                                        <td style="width: 20px;">
                                            <img src="{{Storage::url($item->images->first()->name)}}" class="avatar-xs rounded-circle" alt="{{$item->caption}}">
                                        </td>
                                        <td>
                                            <h6 class="font-size-15 mb-1 fw-normal">{{$item->user->name}}</h6>
                                            <p class="text-muted font-size-13 mb-0">{{$item->name}}</p>
                                        </td>
                                        <td><span class="font-size-13">{{$item->sold}}</span></td>
                                        <td class="text-muted fw-semibold text-end">
                                            <i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>
                                            Rp{{$item->sold*$item->price}}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td>Tidak ada item</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> <!-- enbd table-responsive-->
                    </div> <!-- data-sidebar-->
                </div><!-- end card-body-->
            </div> <!-- end card-->
        </div><!-- end col -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">5 Transaksi Terakhir</h4>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Billing Name</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Payment Status</th>
                                    <th>Payment Method</th>
                                    <th>View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($purchases as $purchase)
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body fw-bold">#TRX{{$purchase->id}}</a> </td>
                                    <td>{{$purchase->user->name}}</td>
                                    <td>
                                        {{$purchase->created_at}}
                                    </td>
                                    <td>
                                        Rp{{number_format($purchase->quantity*$purchase->item->price,2,',','.')}}
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-soft-success font-size-12">{{$purchase->status}}</span>
                                    </td>
                                    <td>
                                        <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>Tidak ada pembelian</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div> <!-- container-fluid -->
@endsection