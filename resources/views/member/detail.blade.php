@extends('layout/member')     <!-- Bisa .(titik) atau / -->

@section('judul','GustiaMart - Member')
  
@section('content')

<div class="row" style="margin-left: auto; margin-right: auto;">
	<div class="col-md-auto">
		<!-- PANEL HEADLINE -->
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h3 class="panel-title">Detail Barang</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<img src="{{url('/gambar_barang/'.$item->gambar)}}" class="" style="width:100%;">
					</div>
					<div class="col-md-8">
						<table class="table table-borderless" style="width: 100%;">
			                <tr>
			                  <td class="teks-detail posisi-detail">Nama Barang</td>
			                  <td class="posisi-detail"><strong>{{ $item->nama_barang }}</strong></td>
			                </tr>
			                <tr>
			                  <td class="posisi-detail">Kategori</td>
			                  <td class="posisi-detail"><strong>{{ $item->kategori }}</strong></td>
			                </tr>
			                <tr>
			                  <td class="posisi-detail">Stok</td>
			                  <td class="posisi-detail"><strong>{{ $item->stok }} Pcs</strong></td>
			                </tr>
			                <tr>
			                  <td class="posisi-detail">Harga</td>
			                  <td class="posisi-detail">
			                    <strong><div class="btn btn-success"> RP. {{ $item->harga_jual }},- </div></strong>
			                    <a href="{{url('/cartmember/'.$item->id.'/edit')}}"><div class="btn btn-primary "><i class="fas fa-cart-plus fa-lg" data-toggle="tooltip" title="Tambah ke Keranjang"></i></div></a>
			                  </td>
			                </tr>
			                <tr>
			                  <td class="posisi-detail">Expired</td>
			                  <td class="posisi-detail"><strong>{{ $item->expired }}</strong></td>
			                </tr>
			                <tr>
			                  <td class="posisi-detail">Keterangan</td>
			                  <td class="posisi-detail"><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</strong></td>
			                </tr>
			            </table>
					</div>
				</div>
				<div class="row" style="margin-top: 20px; float: right; margin-right: auto;">
		            <a href="{{url('/member')}}"><div class="btn btn-danger">Kembali</div></a>
		        </div>
			</div>
		</div>
		<!-- END PANEL HEADLINE -->
	</div>
</div>

@endsection