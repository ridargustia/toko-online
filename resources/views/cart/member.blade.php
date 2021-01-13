@extends('layout/member')     <!-- Bisa .(titik) atau / -->

@section('judul','GustiaMart - Keranjang Belanja')
  
@section('content')

<div class="row" style="margin-left: auto; margin-right: auto;">
	<div class="col-md-auto">
		<!-- PANEL HEADLINE -->
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h3 class="panel-title">Keranjang Belanja</h3>
			</div>
			<div class="panel-body">
				<div class="row">
		            <div class="col-md-12">
		            	@if (session()->has('success_message'))
				            <div class="alert alert-success">
				                {{ session()->get('success_message') }}
				            </div>
				        @endif

						<table class="table table-bordered table-hover">
							<thead>
								<tr class="text-dark bg-light">
									<th scope="col" class="text-center" style="width: 5px;">No</th>
									<th scope="col" class="text-center column-primary" data-header="Belanjaan"><span>Nama Barang</span></th>
									<th scope="col" class="text-center">Jumlah</th>
									<th scope="col" class="text-center">Harga Satuan</th>
									<th scope="col" class="text-center column-primary" style="width: 10px;"></th>
								</tr>
							</thead>
							<tbody>
								@foreach( $items as $item)
								<tr>
									<td class="text-center sembunyikan-nomor">{{ $loop->iteration }}</td>
									<td class="posisi-teks title" data-header="Nama">{{ $item->name }}</td>
									<td class="posisi-teks" data-header="Jumlah">
										<form action="{{url('/cartmember/'.$item->rowId)}}" method="post">
											{{ method_field('patch') }}
											{{ csrf_field() }}
											<input type="number" style="width: 50px;" name="qty" value="{{ $item->qty }}">
											<button type="submit" class="badge bg-success" style="margin-bottom: 5px;">Ok</button>
										</form>
									</td>
									<td class="posisi-teks" data-header="Harga/pcs">Rp. {{ number_format($item->price, 0,',','.') }}</td>
									<th scope="row" class="text-left">
										<div class="toolbox">
											<form action="{{url('/cartmember/'.$item->rowId)}}" method="post" class="d-inline" style="margin-right: 15px;">
											{{ method_field('delete') }}
											{{ csrf_field() }}
												<button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus dari keranjang"><i class="lnr lnr-trash"></i></button>
											</form>
										</div>
									</th>
								</tr>
								@endforeach
								<tr class="bg-light">
									<td colspan="2" class="text-center"><strong>Total</strong></td>
									<td class="text-center"><strong>{{ Cart::count() }}</strong></td>
									<td class="text-center"><strong>Rp. {{ Cart::subtotal() }}</strong></td>
									<th scope="row"></th>
								</tr>
							</tbody>
						</table>
				        @if(empty($item))
		                    <div class="alert alert-danger" role="alert">
		                       Belum ada barang dikeranjang anda.
		                    </div>
		                @endif

		            </div>
		        </div>
				<div class="row">
					<div class="col col-lg-2">
						<a href="{{url('/member')}}" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Lanjutkan Belanja</a>
					</div>
					<div class="col col-lg-2" style="width: 144px;">
						<form action="{{url('/emptycartmember')}}" method="POST" class="d-inline">
							{{ method_field('delete') }}
							{{ csrf_field() }}
							<button type="submit" class="btn btn-danger" @if(Cart::count() === 0) disabled @endif><i class="fa fa-trash"></i> Hapus Semua</button>
						</form>
					</div>
					<div class="col col-lg-2">
						<a href="{{url('/payment')}}" class="btn btn-success @if(Cart::count() === 0) disabled @endif"><i class="fas fa-shopping-bag"></i> Pesan Sekarang</a>
					</div>
				</div>
			</div>
		</div>
		<!-- END PANEL HEADLINE -->
	</div>
</div>

@endsection