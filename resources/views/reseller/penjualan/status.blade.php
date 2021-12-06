@if($data === 'success')
<span class="badge bg-success rounded-pill">Berhasil Melakukan Transaksi</span>
@endif
@if($data == 'waiting')
<span class="badge bg-info rounded-pill">Menunggu Pengiriman Produk</span>
@endif
@if($data == 'canceled')
<span class="badge bg-danger rounded-pill">Produk Di Cancel Pembeli</span>
@endif
@if($data == 'pending')
<span class="badge bg-warning rounded-pill">Menunggu Pembayaran Pembeli</span>
@endif