@extends('layout/main')

@section('judul','GustiaMart - Keranjang Belanja')

@section('container')
  <div class="col-md-10">
	<div class="row">
		<div class="col-md-12">
			<div class="card my-5 mx-3">
				<div class="bg-light">
					<h5 class="card-header">Keranjang Belanja</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
						@if (session()->has('success_message'))
							<div class="alert alert-success">
								{{ session()->get('success_message') }}
							</div>
						@endif

						<table class="table table-bordered mt-2 table-hover">
							<thead>
								<tr>
									<th scope="col" class="text-center" style="width: 5px;">No</th>
									<th scope="col" class="text-center column-primary" data-header="Belanjaan"><span>Nama Barang</span></th>
									<th scope="col" class="text-center">Jumlah</th>
									<th scope="col" class="text-center">Harga Satuan</th>
									<th scope="col" class="text-center column-primary" style="width: 10px;">Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach( $items as $item)
								<tr>
									<td class="text-center sembunyikan">{{ $loop->iteration }}</td>
									<td class="posisi-teks title" data-header="Nama">{{ $item->name }}</td>
									<td class="posisi-teks" data-header="Jumlah">
										<form action="{{url('/cart/'.$item->rowId)}}" method="post">
											{{ method_field('patch') }}
											{{ csrf_field() }}
											<input type="number" style="width: 50px;" name="qty" value="{{ $item->qty }}">
											<button type="submit" class="badge badge-primary badge-sm mb-2">Ok</button>
										</form>
									</td>
									<td class="posisi-teks" data-header="Harga/pcs">Rp. {{ number_format($item->price, 0,',','.') }}</td>
									<th scope="row" class="text-center">
										<div class="toolbox">
											<form action="{{url('/cart/'.$item->rowId)}}" method="post" class="d-inline">
											{{ method_field('delete') }}
											{{ csrf_field() }}
												<button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus dari keranjang"><i class="fa fa-trash"></i></button>
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


								<!-- <tr class="text-dark bg-light">
									<th class="text-center" style="width: 5px;">No</th>
									<th class="text-center">Nama Barang</th>
									<th class="text-center">Jumlah</th>
									<th class="text-center">Harga Satuan</th>
									<th class="text-center" style="width: 10px;">Aksi</th>
								</tr>
								@foreach( $items as $item)
								<tr>
									<td class="text-center">{{ $loop->iteration }}</td>
									<td class="text-center">{{ $item->name }}</td>
									<td class="text-center">
										<form action="{{url('/cart/'.$item->rowId)}}" method="post">
											{{ method_field('patch') }}
											{{ csrf_field() }}
											<input type="number" style="width: 50px;" name="qty" value="{{ $item->qty }}">
											<button type="submit" class="badge badge-primary badge-sm mb-2">Ok</button>
										</form>
									</td>
									<td class="text-center">Rp. {{ number_format($item->price, 0,',','.') }}</td>
									<td class="text-center">
										<form action="{{url('/cart/'.$item->rowId)}}" method="post" class="d-inline">
										{{ method_field('delete') }}
										{{ csrf_field() }}
											<button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus dari keranjang"><i class="fa fa-trash"></i></button>
										</form>
									</td>
								</tr>
								@endforeach
								<tr class="bg-light">
									<td colspan="2" class="text-center"><strong>Total</strong></td>
									<td class="text-center"><strong>{{ Cart::count() }}</strong></td>
									<td class="text-center"><strong>Rp. {{ Cart::subtotal() }}</strong></td>
									<td></td>
								</tr> -->
						</table>
						@if(empty($item))
							<div class="alert alert-danger" role="alert">
							Belum ada barang dikeranjang anda.
							</div>
						@endif

						<a href="{{url('/')}}" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Lanjutkan Belanja</a>
						<form action="{{url('/emptycart')}}" method="POST" class="d-inline">
							{{ method_field('delete') }}
							{{ csrf_field() }}
							<button type="submit" class="btn btn-danger" @if(Cart::count() === 0) disabled @endif><i class="fa fa-trash"></i> Hapus Semua</button>
						</form>
						<a href="{{url('/payment')}}" class="btn btn-success @if(Cart::count() === 0) disabled @endif"><i class="fas fa-shopping-bag"></i> Pesan Sekarang</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
@endsection