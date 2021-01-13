@extends('layout/main')

@section('judul','GustiaMart - Detail Produk')

@section('container')
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-5 mx-3">
                    <h5 class="card-header">Detail Barang</h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          <img src="{{url('/gambar_barang/'.$item->gambar)}}" style="width:100%;">
                        </div>
                        <div class="col-md-8">
                          <table class="table table-borderless" style="width: auto;">
                            <tr class="hidden-detail2"><td class="posisi-teks-detail">Nama Barang</td></tr>
                            <tr>
                              <td class="hidden-detail1" style="width:150px">Nama Barang</td>
                              <td class="posisi-teks-detail"><strong>{{ $item->nama_barang }}</strong></td>
                            </tr>
                            <tr class="hidden-detail2"><td class="posisi-teks-detail">Kategori</td></tr>
                            <tr>
                              <td class="hidden-detail1">Kategori</td>
                              <td class="posisi-teks-detail"><strong>{{ $item->kategori }}</strong></td>
                            </tr>
                            <tr class="hidden-detail2"><td class="posisi-teks-detail">Stok</td></tr>
                            <tr>
                              <td class="hidden-detail1">Stok</td>
                              <td class="posisi-teks-detail"><strong>{{ $item->stok }} Pcs</strong></td>
                            </tr>
                            <tr class="hidden-detail2"><td class="posisi-teks-detail">Harga</td></tr>
                            <tr>
                              <td class="hidden-detail1">Harga</td>
                              <td class="posisi-teks-detail">
                                <strong><div class="btn btn-success"> RP. {{ $item->harga_jual }},- </div></strong>
                                <a href="{{url('/cart/'.$item->id.'/edit')}}"><div class="btn btn-primary "><i class="fas fa-cart-plus fa-lg" data-toggle="tooltip" title="Tambah ke Keranjang"></i></div></a>
                              </td>
                            </tr>
                            <tr class="hidden-detail2"><td class="posisi-teks-detail">Expired</td></tr>
                            <tr>
                              <td class="hidden-detail1">Expired</td>
                              <td class="posisi-teks-detail"><strong>{{ $item->expired }}</strong></td>
                            </tr>
                            <tr class="hidden-detail2"><td class="posisi-teks-detail">Keterangan</td></tr>
                            <tr>
                              <td class="hidden-detail1">Keterangan</td>
                              <td class="posisi-teks-detail"><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</strong></td>
                            </tr>
                          </table>

                        </div>
                      </div>
                      <div class="row float-right mr-auto">
                        <a href="{{url('/')}}"><div class="btn btn-danger">Kembali</div></a>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection