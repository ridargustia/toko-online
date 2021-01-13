@extends('layout/dashboard')     <!-- Bisa .(titik) atau / -->

@section('judul','GustiaMart - Detail Invoice')
  
@section('content')

		<!-- Begin Page Content -->
        <div class="container-fluid">

        	<div class="row">
        		<div class="col-lg-7">
        			<!-- Basic Card Example -->
		              <div class="card shadow mb-4">
		                <div class="card-header py-3">
		                  <h6 class="m-0 font-weight-bold text-primary">Data Pemesan</h6>
		                </div>
		                <div class="card-body">
		                  <form>
							  <fieldset disabled>
							  	<div class="form-group">
							      <label for="disabledTextInput">Username</label>
							      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$username}}">
							    </div>
							    <div class="form-group">
							      <label for="disabledTextInput">Nama Pemesan</label>
							      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$nama}}">
							    </div>
							    <div class="form-group">
							      <label for="disabledTextInput">Alamat</label>
							      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$alamat}}">
							    </div>
							    <div class="form-group">
							      <label for="disabledTextInput">Nomor Telepon</label>
							      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$no_telpon}}">
							    </div>
							    <div class="form-group">
							      <label for="disabledTextInput">Jasa Pengiriman (Kurir)</label>
							      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$invoice->pengiriman}}">
							    </div>
							    <div class="form-group">
							      <label for="disabledTextInput">Bank (Transfer)</label>
							      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$invoice->bank}}">
							    </div>
							    <div class="form-group">
							      <label for="disabledTextInput">Batas Waktu Pembayaran</label>
							      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$invoice->batas_bayar}}">
							    </div>
							    <div class="form-group">
							      <label for="disabledTextInput">Tanggal Pemesanan</label>
							      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$invoice->created_at}}">
							    </div>
							  </fieldset>
							</form>
		                </div>
		              </div>
        		</div>
        		<div class="col-lg-5">

        			<!-- Collapsable Card Example -->
		              <div class="card shadow mb-4">
		                <!-- Card Header - Accordion -->
		                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
		                  <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
		                </a>
		                <!-- Card Content - Collapse -->
		                <div class="collapse show" id="collapseCardExample">
		                  <div class="card-body">
		                    <ul class="list-group">
				                @foreach( $carts as $cart )
									<li class="list-group-item d-flex justify-content-between align-items-center">
									  {{$cart->name}} | Rp. {{ number_format($cart->price, 0,',','.') }}
									  <span class="badge badge-primary badge-pill">{{$cart->qty}}</span>
									</li>
								@endforeach
							</ul>
		                  </div>
		                </div>
		                <div class="card-footer">
						    <small class="text-muted"><strong>Total Harga : Rp. {{ Cart::subtotal() }}</strong></small>
						</div>
		              </div>
		              <!-- <a href="/konfirm_invoice" style="float: right;"><div class="btn btn-md btn-primary mr-3">Konfirmasi</div></a> -->
		              <a href="{{url('/invoice')}}" style="float: right;"><div class="btn btn-md btn-danger mr-3">Kembali</div></a>
        		</div>
        	</div>
        </div>
        <!-- /.container-fluid -->

@endsection