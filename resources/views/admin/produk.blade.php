 @extends('layout/dashboard')     <!-- Bisa .(titik) atau / -->

 @section('judul','GustiaMart - Produk')
  
 @section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
            </div>
            <div class="card-body">
              <a href="{{url('/items/create')}}" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus fa-sm"></i> Tambah Barang</a>
              <form action="{{url('/items')}}" method="post" class="d-inline">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm mb-3" @if($count_items == 0) disabled @endif><i class="fa fa-fw fa-trash"></i> Hapus Semua Data</button>
              </form>
              <div class="table-responsive">

                @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
                @endif

                @if (session('status_gagal'))
                  <div class="alert alert-danger">
                      {{ session('status_gagal') }}
                  </div>
                @endif

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Stok</th>
                      <th>Penjualan</th>
                      <th>Harga Pokok</th>
                      <th>Harga Jual</th>
                      <th>Kategori</th>
                      <th>Expired</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach( $items as $item )
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td><a href="{{url('/sold_more/'.$item->id_public)}}" class="text-dark" data-toggle="tooltip" title="Laku terjual lebih dari 1">{{ $item->nama_barang }}</a></td>
                      <td>{{ $item->stok }}</td>
                      <td>{{ $item->penjualan }}</td>
                      <td>{{ $item->harga_pokok }}</td>
                      <td>{{ $item->harga_jual }}</td>
                      <td>{{ $item->kategori }}</td>
                      <td>{{ $item->expired }}</td>
                      <td class="text-center">
                        <a href="{{url('/sold/'.$item->id_public)}}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Laku Terjual"><i class="fas fa-cash-register"></i></a>
                        <a href="{{url('/items/'.$item->id.'/edit')}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Data Barang"><i class="fa fa-edit"></i></a>

                        <form action="{{url('/items/'.$item->id_public)}}" method="post" class="d-inline">
                          {{ method_field('delete') }}
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus Data Barang"><i class="fa fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        
 @endsection