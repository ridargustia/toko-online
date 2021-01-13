<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('judul')</title>

  <!-- Custom fonts for this template-->
  <link href="{{url('asset/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{url('asset/css/sb-admin-2.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="{{url('asset/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

  <!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{url('assets/img/emblem-gustiamart.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{url('assets/img/emblem-gustiamart.png')}}">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-shopping-cart text-white"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-white">GustiaMart</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($title === 'Dashboard') active @endif">
        <a class="nav-link" href="{{url('/dashboard')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item @if($title === 'Data Barang') active @endif">
        <a class="nav-link" href="{{url('/items')}}">
          <i class="fas fa-fw fa-server"></i>
          <span>Data Barang</span></a>
      </li>
      <!-- Nav Item - Tables -->
      <li class="nav-item @if($title === 'Transaksi') active @endif">
        <a class="nav-link" href="{{url('/transaksi')}}">
          <i class="fas fa-fw fa-handshake"></i>
          <span>Transaksi</span></a>
      </li>
      <!-- Nav Item - Tables -->
      <li class="nav-item @if($title === 'Rekapitulasi') active @endif">
        <a class="nav-link" href="{{url('/rekapitulasi')}}">
          <i class="fas fa-fw fa-book"></i>
          <span>Rekapitulasi</span></a>
      </li>
      <!-- Nav Item - Tables -->
      <li class="nav-item @if($title === 'Invoices') active @endif">
        <a class="nav-link" href="{{url('/invoice')}}">
          <i class="fas fa-fw fa-file-invoice"></i>
          <span>Invoices</span></a>
      </li>
      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-danger" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> --}}

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            {{-- <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-danger" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li> --}}

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="{{url('/invoice')}}" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-shopping-cart fa-fw"></i>
                <!-- Counter - Messages -->
                @if($count_notif > 0)
                  <span class="badge badge-danger badge-counter">{{$count_notif}}</span>
                @endif
              </a>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $name }}</span>
                <img class="img-profile rounded-circle" src="{{url('foto_profil/'.auth()->user()->foto)}}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{url('/profil')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <!-- <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        @yield('content')

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; GustiaMart 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-info" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{url('asset/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{url('asset/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{url('asset/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{url('asset/vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{url('asset/js/demo/chart-area-demo.js')}}"></script>
  <script src="{{url('asset/js/demo/chart-pie-demo.js')}}"></script>

  <script type="text/javascript" src="{{url('layout/javascript/script.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{url('asset/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('asset/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{url('asset/js/demo/datatables-demo.js')}}"></script>
</body>

</html>
