 @extends('layout/dashboard')     <!-- Bisa .(titik) atau / -->

 @section('judul','GustiaMart - Invoice')
  
 @section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Invoice Pemesanan Produk</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
                @endif

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="display:none;">No</th>
                      <th>Nama Pemesan</th>
                      <th>Alamat Pemesan</th>
                      <th>Nomor Telepon</th>
                      <th>Tanggal Pemesanan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach( $invoice as $inv )
                    <tr class="@if($inv->notif_status === 0) table-active @endif ">
                      <td style="display:none;">{{ $loop->iteration }}</td>
                      <td>{{ $inv->nama }}</td>
                      <td>{{ $inv->alamat }}</td>
                      <td>{{ $inv->no_telpon }}</td>
                      <td>{{ $inv->created_at }}</td>
                      <td class="text-center" style="width:70px;">
                        <a href="{{url('/detail_invoice/'.$inv->id_public)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Detail Invoice"><i class="fas fa-file-invoice-dollar"></i></a>
                        <form action="{{url('/invoice/'.$inv->id_public)}}" method="post" class="d-inline">
                          {{ method_field('delete') }}
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus Data Invoice"><i class="fa fa-trash"></i></button>
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