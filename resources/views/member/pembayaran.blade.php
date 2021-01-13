@extends('layout/member')     <!-- Bisa .(titik) atau / -->

@section('judul','GustiaMart - Member')
  
@section('content')

<div class="row" style="margin-left: auto; margin-right: auto;">
	<div class="col-md-auto">
		<!-- PANEL HEADLINE -->
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h2 class="panel-title">Konfirmasi Pembelian</h2>
				<p class="panel-subtitle">Setelah melakukan pemesanan produk, mohon untuk mengisi form pengiriman pada kolom di bawah ini dengan detail alamat pengiriman yang benar. Kami menerima pembayaran di tempat. Setelah melakukan konfirmasi pembelian, kami akan mengirimkan barang pesanan ke tempat anda.</p>
			</div>
			<div class="panel-body">
				<div class="row">
		            <div class="col-md-12">
 					 	<div class="btn btn-md btn-success">Total belanja anda: Rp. {{ Cart::subtotal() }}</div><br><br>
		            </div>
				</div>
				<div class="row">
		            <div class="col-md-7">
		            	<h4>Input Alamat Pengiriman</h4>
 					 	<form action="{{url('/pesanan')}}" method="post">
 					 		{{ csrf_field() }}
 					 	 	<div class="form-group">
 					 	 		<input type="text" name="nama" class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}" placeholder="Nama Lengkap Anda" value="{{ old('nama') }}">
 					 	 		@if ($errors->has('nama'))
			                        <span class="invalid-feedback text-danger" role="alert">
			                          {{ $errors->first('nama') }}
			                        </span>
			                    @endif
 					 	 	</div>
 					 	 	<div class="row">
	 					 	 	<div class="col-md-6">
		 					 	 	<div class="form-group">
		 					 	 		<input type="text" name="jln" class="form-control {{ $errors->has('jln') ? ' is-invalid' : '' }}" placeholder="Nama Jalan (misal : Jl. Makam Raja-raja)" value="{{ old('jln') }}">
		 					 	 		@if ($errors->has('jln'))
					                        <span class="invalid-feedback text-danger" role="alert">
					                          {{ $errors->first('jln') }}
					                        </span>
					                    @endif
		 					 	 	</div>
	 					 	 	</div>
	 					 	 	<div class="col-md-6">
		 					 	 	<div class="form-group">
		 					 	 		<input type="text" name="rt" class="form-control {{ $errors->has('rt') ? ' is-invalid' : '' }}" placeholder="Nama Kampung/RT" value="{{ old('rt') }}">
		 					 	 		@if ($errors->has('rt'))
					                        <span class="invalid-feedback text-danger" role="alert">
					                          {{ $errors->first('rt') }}
					                        </span>
					                    @endif
		 					 	 	</div>
	 					 	 	</div>
 					 	 	</div>
 					 	 	<div class="row">
	 					 	 	<div class="col-md-6">
		 					 	 	<div class="form-group">
		 					 	 		<input type="text" name="kel" class="form-control {{ $errors->has('kel') ? ' is-invalid' : '' }}" placeholder="Kelurahan" value="{{ old('kel') }}">
		 					 	 		@if ($errors->has('kel'))
					                        <span class="invalid-feedback text-danger" role="alert">
					                          {{ $errors->first('kel') }}
					                        </span>
					                    @endif
		 					 	 	</div>
	 					 	 	</div>
	 					 	 	<div class="col-md-6">
		 					 	 	<div class="form-group">
		 					 	 		<input type="text" name="kec" class="form-control {{ $errors->has('kec') ? ' is-invalid' : '' }}" placeholder="Kecamatan" value="{{ old('kec') }}">
		 					 	 		@if ($errors->has('kec'))
					                        <span class="invalid-feedback text-danger" role="alert">
					                          {{ $errors->first('kec') }}
					                        </span>
					                    @endif
		 					 	 	</div>
	 					 	 	</div>
 					 	 	</div>
 					 	 	<div class="row">
	 					 	 	<div class="col-md-6">
		 					 	 	<div class="form-group">
		 					 	 		<input type="text" name="kab" class="form-control {{ $errors->has('kab') ? ' is-invalid' : '' }}" placeholder="Kabupaten" value="{{ old('kab') }}">
		 					 	 		@if ($errors->has('kab'))
					                        <span class="invalid-feedback text-danger" role="alert">
					                          {{ $errors->first('kab') }}
					                        </span>
					                    @endif
		 					 	 	</div>
	 					 	 	</div>
	 					 	 	<div class="col-md-6">
		 					 	 	<div class="form-group">
		 					 	 		<input type="text" name="prov" class="form-control {{ $errors->has('prov') ? ' is-invalid' : '' }}" placeholder="Provinsi" value="{{ old('prov') }}">
		 					 	 		@if ($errors->has('prov'))
					                        <span class="invalid-feedback text-danger" role="alert">
					                          {{ $errors->first('prov') }}
					                        </span>
					                    @endif
		 					 	 	</div>
	 					 	 	</div>
 					 	 	</div>
 					 	 	<div class="form-group">
 					 	 		<input type="text" name="patokan" class="form-control {{ $errors->has('patokan') ? ' is-invalid' : '' }}" placeholder="Patokan (misal : Depan Taman Kuliner Imogiri)" value="{{ old('patokan') }}">
 					 	 		@if ($errors->has('patokan'))
			                        <span class="invalid-feedback text-danger" role="alert">
			                          {{ $errors->first('patokan') }}
			                        </span>
			                    @endif
 					 	 	</div>
 					 	 	<div class="form-group">
 					 	 		<input type="text" name="no_telpon" class="form-control {{ $errors->has('no_telpon') ? ' is-invalid' : '' }}" placeholder="Nomor Telepon Anda" value="{{ old('no_telpon') }}">
 					 	 		@if ($errors->has('no_telpon'))
			                        <span class="invalid-feedback text-danger" role="alert">
			                          {{ $errors->first('no_telpon') }}
			                        </span>
			                    @endif
 					 	 	</div>
 					 	 	<!-- <div class="form-group">
 					 	 		<select class="form-control" name="pengiriman">
									<option value="">--Pilih Jasa Pengiriman--</option>
									<option value="GRAB">GRAB</option>
									<option value="GOJEK">GOJEK</option>
									<option value="POS Indonesia">POS Indonesia</option>
								</select>
 					 	 	</div>
 					 	 	<div class="form-group">
 					 	 		<select class="form-control" name="bank">
									<option value="">--Pilih BANK--</option>
									<option value="Mandiri">Mandiri - xxxxxxxxx</option>
									<option value="BCA">BCA - xxxxxxxxx</option>
									<option value="BNI">BNI - xxxxxxxxx</option>
									<option value="BRI">BRI - xxxxxxxxx</option>
								</select>
 					 	 	</div> -->
 					 	 	<button type="submit" class="btn btn-primary" style="float: right;" @if(Cart::count() === 0) disabled @endif>Konfirmasi</button>
 					 	</form>
		            </div>
		        </div> 
			</div>
		</div>
		<!-- END PANEL HEADLINE -->
	</div>
</div>

@endsection