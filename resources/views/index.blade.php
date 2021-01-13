@extends('layout/main')

@section('judul','GustiaMart - Beranda')

@section('container')
      <div class="col-md-10 p-2 pt-3 bg-white">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleControls" class="carousel slide tinggi-carousel" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="{{url('layout/image/bg-gm.jpg')}}" class="d-block w-100 tinggi-gambar-carousel" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="{{url('layout/image/gustiamart3.jpg')}}" class="d-block w-100 tinggi-gambar-carousel" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="{{url('layout/image/simple-house-01.jpg')}}" class="d-block w-100 tinggi-gambar-carousel" alt="...">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center text-weight-bold mt-5 mb-2">PRODUK TERBARU</h4>
                @if (session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif
                <div class="row posisi mb-5">
                    @foreach( $items as $item )
                      <div class="col-md-3" style="padding-right: 7.5px; padding-left: 7.5px;">
                        <div class="card posisi-card mt-3 hovers">
                          <img src="{{url('gambar_barang/'.$item->gambar)}}" class="card-img-top" style="height: 240px" alt="...">
                          <div class="card-body bg-light">
                            <h5 class="card-title">{{ $item->nama_barang }}</h5>
                            <p class="card-text">Some quick example text to build on the card.</p>
                            <a href="{{url('/detail/'.$item->id)}}" class="btn btn-primary btn-sm">Detail</a>
                            <a href="{{url('/cart/'.$item->id)}}"><div class="btn btn-danger btn-sm" data-toggle="tooltip" title="Masukkan Keranjang">Rp. {{ $item->harga_jual }}</div></a>
                            <a class="ml-2" href="{{url('/cart')}}" data-toggle="tooltip" title="Lihat Keranjang">
                              <i class="fas fa-shopping-cart fa-fw text-dark"></i>
                              <!-- Counter - Messages -->
                              {{-- @if($count_notif > 0) --}}
                              @foreach($carts as $cart)
                                  @if($item->id == $cart->id)
                                    <span class="badge badge-danger badge-counter">{{$cart->qty}}</span>
                                  @endif
                              @endforeach
                              {{-- @endif --}}
                            </a>
                          </div>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection