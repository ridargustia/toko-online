 @extends('layout/dashboard')     <!-- Bisa .(titik) atau / -->

 @section('judul','GustiaMart - Transaksi')
  
 @section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
            </div>
            <div class="card-body">
              <a href="{{url('/recapitulation')}}" class="btn btn-success btn-sm mb-3 @if($count_transaksi == 0) disabled @endif"><i class="fas fa-fw fa-book"></i> Rekap Transaksi</a>
              <form action="{{url('/transaksi')}}" method="post" class="d-inline">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm mb-3" @if($count_transaksi == 0) disabled @endif><i class="fa fa-fw fa-trash"></i> Hapus Semua Transaksi</button>
              </form>
              <!-- <a href="" class="btn btn-danger btn-sm mb-3"><i class="fa fa-fw fa-trash"></i> Hapus Semua Transaksi</a> -->
              <div class="table-responsive">

                @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
                @endif

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Harga Pokok</th>
                      <th>Harga Jual</th>
                      <th>Laba</th>
                      <th>Tgl Transaksi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach( $transactions as $transaksi )
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $transaksi->nama_barang }}</td>
                      <td>{{ $transaksi->jumlah }}</td>
                      <td>{{ $transaksi->harga_pokok }}</td>
                      <td>{{ $transaksi->harga_jual }}</td>
                      <td>{{ $transaksi->laba }}</td>
                      <td>{{ $transaksi->created_at }}</td>
                      <td class="text-center">
                        <form action="{{url('/transaksi/'.$transaksi->id_public)}}" method="post" class="d-inline">
                          {{ method_field('delete') }}
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus Data Transaksi"><i class="fa fa-trash"></i></button>
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