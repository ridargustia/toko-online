 @extends('layout/dashboard')     <!-- Bisa .(titik) atau / -->

 @section('judul','GustiaMart - Rekapitulasi')
  
 @section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi</h6>
            </div>
            <div class="card-body">
              <form action="{{url('/rekapitulasi')}}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm mb-3" @if($count_rekap == 0) disabled @endif><i class="fa fa-fw fa-trash"></i> Hapus Semua Data</button>
              </form>
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
                      <th>Tanggal Rekap</th>
                      <th>Total Harga Pokok</th>
                      <th>Total Harga Jual</th>
                      <th>Total Laba</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach( $rekapitulasi as $rekap )
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $rekap->created_at }}</td>
                      <td>{{ $rekap->total_hargapokok }}</td>
                      <td>{{ $rekap->total_hargajual }}</td>
                      <td>{{ $rekap->laba }}</td>
                      <td class="text-center">
                        <form action="{{url('/rekapitulasi/'.$rekap->id)}}" method="post" class="d-inline">
                          {{ method_field('delete') }}
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash"></i></button>
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