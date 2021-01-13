@extends('layout/main')

@section('judul','GustiaMart - Produk')

@section('container')
      <div class="col-md-10 p-2 pt-3 bg-white">
          <div class="row">
              <div class="col-md-12">
                  <h2 class="text-center text-weight-bold mt-2 mb-2">Produk {{$categories->nama_kategori}}</h2>

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
                              <div class="collapse mb-3" id="collapseExample">
                                <p class="card-text">Stok : {{ $item->stok }} Pcs</p>
                                <p class="card-text">Kategori : {{ $item->kategori }}</p>
                                <p class="card-text">Expired : {{ $item->expired }}</p>
                              </div>
                              <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Detail</a>
                              {{-- <a href="{{url('/detail/'.$item->id)}}" class="btn btn-primary" >Detail</a> --}}
                              <a href="{{url('/cart/'.$item->id)}}"><div class="btn btn-danger btn-sm" data-toggle="tooltip" title="Masukkan Keranjang">Rp. {{ number_format($item->harga_jual, 0,',','.') }}</div></a>
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