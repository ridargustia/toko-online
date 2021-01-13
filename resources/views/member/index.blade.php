@extends('layout/member')     <!-- Bisa .(titik) atau / -->

 @section('judul','GustiaMart - Member')
  
 @section('content')

	@if (session('notif'))
	<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">{{ session('notif') }}</h3>
			<p class="panel-subtitle">Anda sekarang telah bergabung menjadi member kami. Terimakasih.</p>
		</div>
	</div>
	@endif
	@if (session('notif_login'))
	<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">{{ session('notif_login') }}</h3>
			<!-- <p class="panel-subtitle">Anda sekarang telah bergabung menjadi member kami. Terimakasih.</p> -->
		</div>
	</div>
	@endif

	<h3 class="page-title">Produk Terbaru</h3>

	@if (session()->has('success_message'))
    <div class="alert alert-success">
        {{ session()->get('success_message') }}
    </div>
    @endif
    @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
    @endif

 	<!-- OVERVIEW -->
	{{-- <div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Dashboard</h3>
			<!-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> -->
		</div>
		<div class="panel-body">
			<div class="row">
                <!-- @if (session('notif'))
                  <div class="alert alert-success">
                      <h3>{{ session('notif') }}</h3>
                  </div>
                @endif -->
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-shopping-bag"></i></span>
						<p>
							<span class="number">1,252</span>
							<span class="title">Downloads</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-smoking"></i></span>
						<p>
							<span class="number">203</span>
							<span class="title">Sales</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-prescription-bottle-alt"></i></span>
						<p>
							<span class="number">274,678</span>
							<span class="title">Visits</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-bar-chart"></i></span>
						<p>
							<span class="number">35%</span>
							<span class="title">Conversions</span>
						</p>
					</div>
				</div>
			</div>
			
		</div>
	</div> --}}
	<!-- END OVERVIEW -->

	<div class="row">
 		@foreach( $items as $item )
 		<div class="col-lg-3">
 			<div class="panel hovers">
	 			<div class="panel-heading no-padding">
					<img src="{{url('gambar_barang/'.$item->gambar)}}" style="width:100%;" alt="...">
				</div>
	 			<div class="panel-body">
					<h3>{{ $item->nama_barang }}</h3>
					<p>Panel to display most important information</p>
					<a href="{{url('/member_detail/'.$item->id)}}" class="btn btn-primary btn-sm" >Detail</a>
					<a href="{{url('/cartmember/'.$item->id)}}"><div class="btn btn-danger btn-sm" data-toggle="tooltip" title="Masukkan Keranjang">Rp. {{ $item->harga_jual }}</div></a>
	 			</div>
			</div>
 		</div>
 		@endforeach
 	</div>

 @endsection