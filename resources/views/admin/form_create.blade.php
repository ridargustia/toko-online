 @extends('layout/dashboard')     <!-- Bisa .(titik) atau / -->

 @section('judul','GustiaMart - Tambah Produk')
  
 @section('content')

 			<div class="container-fluid">

		          <!-- Page Heading -->
		          <div class="d-sm-flex align-items-center justify-content-between mb-4">
		            <h1 class="h3 mb-0 text-gray-800">Tambah Barang Baru</h1>
		          </div>

		         @if (session('status'))
		            <div class="alert alert-danger mt-3">
		                {{ session('status') }}
		            </div>
		          @endif

 	 			<form action="{{url('/items')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label>Nama Barang</label>
                      <input type="text" name="nama_barang" class="col-7 form-control {{ $errors->has('nama_barang') ? ' is-invalid' : '' }}" value="{{ old('nama_barang') }}">
                      @if ($errors->has('nama_barang'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('nama_barang') }}
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Stok</label>
                      <input type="text" name="stok" class="col-7 form-control {{ $errors->has('stok') ? ' is-invalid' : '' }}" value="{{ old('stok') }}">
                      @if ($errors->has('stok'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('stok') }}
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Harga Pokok</label>
                      <input type="text" name="harga_pokok" class="col-7 form-control {{ $errors->has('harga_pokok') ? ' is-invalid' : '' }}" value="{{ old('harga_pokok') }}">
                      @if ($errors->has('harga_pokok'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('harga_pokok') }}
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Harga Jual</label>
                      <input type="text" name="harga_jual" class="col-7 form-control {{ $errors->has('harga_jual') ? ' is-invalid' : '' }}" value="{{ old('harga_jual') }}">
                       @if ($errors->has('harga_jual'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('harga_jual') }}
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Kategori</label>
                      <select name="kategori" class="col-7 form-control {{ $errors->has('kategori') ? ' is-invalid' : '' }}" value="">
                          <option value="">--Pilih--</option>
                          @foreach($kategoris as $kategori)
                            <option value="{{$kategori->nama_kategori}}"> {{$kategori->nama_kategori}} </option>
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
                      <input type="date" name="expired" class="col-7 form-control {{ $errors->has('expired') ? ' is-invalid' : '' }}" value="{{ old('expired') }}">
                       @if ($errors->has('expired'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('expired') }}
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Gambar Produk</label>
                      <input type="file" name="gambar" class="col-7 form-control" value="{{ old('gambar') }}">
                    </div>
                  
                    <!-- <div class="modal-footer"> -->
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    <!-- </div> -->
                 </form>
            </div>
 @endsection