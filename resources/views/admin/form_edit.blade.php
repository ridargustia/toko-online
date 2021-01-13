 @extends('layout/dashboard')     <!-- Bisa .(titik) atau / -->

 @section('judul','GustiaMart - Update Produk')
  
 @section('content')

 			<div class="container-fluid">

		          <!-- Page Heading -->
		          <div class="d-sm-flex align-items-center justify-content-between mb-4">
		            <h1 class="h3 mb-0 text-gray-800">Edit Barang</h1>
		          </div>

 	 			<form action="{{url('/items/'.$item->id_public)}}" method="post" enctype="multipart/form-data">
 	 				         {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label>Nama Barang</label>
                      <input type="text" name="nama_barang" class="col-7 form-control {{ $errors->has('nama_barang') ? ' is-invalid' : '' }}" value="{{ $item->nama_barang }}">
                      @if ($errors->has('nama_barang'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('nama_barang') }}
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Stok</label>
                      <input type="text" name="stok" class="col-7 form-control {{ $errors->has('stok') ? ' is-invalid' : '' }}" placeholder="Masukkan tambahan stok barang">
                      @if ($errors->has('stok'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('stok') }}
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Harga Pokok</label>
                      <input type="text" name="harga_pokok" class="col-7 form-control {{ $errors->has('harga_pokok') ? ' is-invalid' : '' }}" value="{{ $item->harga_pokok }}">
                      @if ($errors->has('harga_pokok'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('harga_pokok') }}
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Harga Jual</label>
                      <input type="text" name="harga_jual" class="col-7 form-control {{ $errors->has('harga_jual') ? ' is-invalid' : '' }}" value="{{ $item->harga_jual }}">
                       @if ($errors->has('harga_jual'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('harga_jual') }}
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Kategori</label>
                      <select name="kategori" class="col-7 form-control {{ $errors->has('kategori') ? ' is-invalid' : '' }}" value="">
                          @foreach($kategoris as $kategori)
                            <option value="{{$kategori->nama_kategori}}" 
                              @if($kategori->nama_kategori === $item->kategori)
                                selected
                              @endif
                            > {{$kategori->nama_kategori}} </option>
                          @endforeach
                      </select>
                       @if ($errors->has('kategori'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('kategori') }}
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Expired</label>
                      <input type="date" name="expired" class="col-7 form-control {{ $errors->has('expired') ? ' is-invalid' : '' }}" value="{{ $item->expired }}">
                       @if ($errors->has('expired'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('expired') }}
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Gambar Barang</label>
                      <input type="file" name="gambar" class="col-7 form-control" value="">
                    </div>
                  
                    <!-- <div class="modal-footer"> -->
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    <!-- </div> -->
                 </form>
            </div>
 @endsection