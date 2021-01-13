@extends('layout/member')     <!-- Bisa .(titik) atau / -->

 @section('judul','GustiaMart - Member')
  
 @section('content')

 	<h3 class="page-title">Produk {{$categories->nama_kategori}}</h3>
 	@if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif
 	<div class="row">
 		@foreach( $items as $item )
 		<div class="col-lg-3">
 			<div class="panel hovers">
	 			<img src="{{url('gambar_barang/'.$item->gambar)}}" style="width:100%;" alt="...">
	 			<div class="panel-body">
					<h3>{{ $item->nama_barang }}</h3>
					<p>Panel to display most important information</p>
					<a href="{{url('/member_detail/'.$item->id)}}" class="btn btn-primary btn-sm" >Detail</a>
					<a href="{{url('/cartmember/'.$item->id)}}"><div class="btn btn-danger btn-sm" data-toggle="tooltip" title="Masukkan Keranjang">Rp. {{ number_format($item->harga_jual, 0,',','.') }}</div></a>
	 			</div>
			</div>
 		</div>
 		@endforeach
 	</div>

 	<!-- OVERVIEW -->
	<!-- <div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Produk {{$categories->nama_kategori}}</h3>
			<p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p>
		</div>
		 @foreach( $items as $item )
			<div class="card mx-2 mt-3 hovers" style="width: 15rem;">
				<img src="{{url('gambar_barang/'.$item->gambar)}}" class="card-img-top" style="height: 240px" alt="...">
				<div class="card-body bg-light">
				    <h5 class="card-title">{{ $item->nama_barang }}</h5>
				    <p class="card-text">Some quick example text to build on the card.</p>
				    <a href="/detail/{{ $item->id }}" class="btn btn-primary" >Detail</a>
				    <div class="btn btn-danger">Rp. {{ number_format($item->harga_jual, 0,',','.') }}</div>
				</div>
			</div>
		@endforeach
	</div> -->
	<!-- END OVERVIEW -->

 @endsection