 @extends('layout/dashboard')     <!-- Bisa .(titik) atau / -->

 @section('judul','GustiaMart - Sell More Form')
  
 @section('content')

 			<div class="container-fluid">

		          <!-- Page Heading -->
		          <div class="d-sm-flex align-items-center justify-content-between mb-4">
		            <h1 class="h3 mb-0 text-gray-800">Jumlah Laku</h1>
		          </div>

 	 			      <form action="{{url('/sold_more/'.$item->id)}}" method="post" enctype="multipart/form-data">
 	 				         {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label>Nama Barang</label>
                      <input type="text" name="nama_barang" class="col-7 form-control" value="{{ $nama_barang }}" disabled>
                    </div>
                    <div class="form-group">
                      <label>Jumlah</label>
                      <input type="text" name="jumlah" class="col-7 form-control {{ $errors->has('jumlah') ? ' is-invalid' : '' }}" placeholder="Masukan jumlah barang yang laku">
                       @if ($errors->has('jumlah'))
                        <span class="invalid-feedback" role="alert">
                          {{ $errors->first('jumlah') }}
                        </span>
                      @endif
                    </div>
                  
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <!-- </div> -->
              </form>
            </div>
 @endsection