<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="{{url('layout/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('layout/fontawesome-free/css/all.min.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <link rel="stylesheet" type="text/css" href="{{url('layout/css/style.css')}}">

    <!-- ICONS -->
	  <link rel="apple-touch-icon" sizes="76x76" href="{{url('assets/img/emblem-gustiamart.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('assets/img/emblem-gustiamart.png')}}">

    <title>@yield('judul')</title>

    <style type="text/css">
      @media screen and (max-width:550px){
        .posisi{
          margin-left: .1rem; margin-right: .1rem;}
        .posisi-card{
          width: 100%; height:auto;}
        .hidden-detail1{
          display: none;}
        .posisi-teks-detail{
          text-align:center;
        }
      }
      @media screen and (min-width: 551px){
        .posisi{
          margin-left: .1rem; margin-right: .1rem;}
        .posisi-card{
          width: 100%;}
        .footer-responsive{
          margin-left: 5rem;}
        .hidden-detail2{
          display: none;}
      }
      /*CART RESPONSIVE*/
      @media screen and (max-width: 520px) {
        table {
          width: 100%;
        }
        thead th.column-primary {
          width: 100%;
        }

        thead th:not(.column-primary) {
          display:none;
        }

        .sembunyikan{
          display: none;
        }
        
        th[scope="row"] {
          vertical-align: top;
        }
        
        td {
          display: block;
          width: auto;
          text-align: right;
        }
        thead th::before {
          text-transform: uppercase;
          font-weight: bold;
          content: attr(data-header);
        }
        thead th span {
          display: none;
        }
        td::before {
          float: left;
          text-transform: uppercase;
          font-weight: bold;
          content: attr(data-header);
        }
      }

      @media screen and (min-width: 521px) {
        .posisi-teks{
          text-align: center;
        }
      }

      @media screen and (max-width:599px){
        .lebar-card{
          width: 100%;
          height: auto;
        }
      }
      @media screen and (min-width:600px){
        .lebar-card{
          width: 16rem;
        }
      }

      @media screen and (max-width:450px){
        .tinggi-carousel{
          height:300px;
        }
        .tinggi-gambar-carousel{
          height:300px;
        }
      }
      @media screen and (min-width:451px){
        .tinggi-gambar-carousel{
          height:500px;
        }
      }

      @media screen and (min-width:992px){
        .hidden-sidemenu1{
          display:none;
        }
      }
      @media screen and (max-width:991px){
        .hidden-sidemenu2{
          display:none;
        }
      }
    </style>
  </head>
  <body style="overflow-x: hidden; max-width: 100%;">
    <nav class="navbar navbar-expand-lg navbar-light bg-danger fixed-top">
      <div class="container">

        <!-- <h4><i class="fas fa-shopping-cart text-light"></i></h4> -->
        <a class="navbar-brand text-light ml-1 font-weight-bold" href="{{url('/')}}"><i class="fas fa-shopping-cart text-light"></i> GUSTIAmart</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mr-3 hidden-sidemenu1">
            <li class="nav-item active">
              <a class="nav-link text-light" href="{{url('/')}}">Beranda <span class="sr-only">(current)</span></a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link text-light" href="{{url('/kategori/'.$kategori->id)}}">{{$kategori->nama_kategori}}</a>
            </li> --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Produk
              </a>
              <div class="dropdown-menu text-light" aria-labelledby="navbarDropdown">
                @foreach( $kategoris as $kategori)
                  <a class="dropdown-item" href="{{url('/kategori/'.$kategori->id)}}">{{$kategori->nama_kategori}}</a>
                  <!-- <a class="dropdown-item" href="#">Rokok</a>
                  <div class="dropdown-divider"></div> 
                  <a class="dropdown-item" href="#">Obat</a>
                  <a class="dropdown-item" href="#">Makanan & minuman</a>-->
                @endforeach
              </div>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link text-light" href="#">Hubungi kami</a>
            </li> -->
          </ul>
         <!--  <form class="form-inline my-2 my-lg-0 ml-auto">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0  text-light" type="submit">Search</button>
          </form> -->
          <div class="icon ml-auto">
            <h5>
              <!-- <div class="nav-item"> -->
                <a href="{{url('/cart')}}" class="" style="text-decoration: none;" data-toggle="tooltip" title="Keranjang Belanja">
                  <i class="fas fa-shopping-cart text-light mt-2 ml-3 mr-2"></i>
                  @if ( Cart::count() > 0)
                     <h6 class="d-inline"><span class="badge badge-warning badge-counter badge-pill badge-sm">{{ Cart::count() }}</span></h6>
                  @endif
                  
                </a>
              <!-- </div> -->
              <a href="{{url('/register')}}"><i class="fas fa-user-plus text-light mt-2 ml-2" data-toggle="tooltip" title="Sign Up"></i></a>
                <a href="{{url('/login')}}"><i class="fas fa-sign-in-alt text-light mt-2 ml-2" data-toggle="tooltip" title="Sign In"></i></a>
              
            </h5>
          </div>
        </div>
      </div>
    </nav>

    <div class="row mt-5 no-gutters">
      <div class="col-md-2 bg-light hidden-sidemenu2">
        <ul class="list-group list-group-flush pt-3 p-2">
          <li class="list-group-item bg-light"><i class="fas fa-list mr-2"></i>KATEGORI PRODUK</li>
          @foreach( $kategoris as $kategori)
          <li class="list-group-item bg-light ml-3"><a href="{{url('/kategori/'.$kategori->id)}}" class="text-dark"><i class="fas {{$kategori->icon}} mr-2"></i>{{$kategori->nama_kategori}}</a></li>
          @endforeach
          <!-- <li class="list-group-item bg-light ml-3"><a href="/kategori/Rokok"><i class="fas fa-smoking mr-2"></i>Rokok</a></li>
          <li class="list-group-item bg-light ml-3"><a href="/kategori/Obat"><i class="fas fa-tablets mr-2"></i>Obat</a></li>
          <li class="list-group-item bg-light ml-3"><a href="/kategori/Makanan"><i class="fas fa-cookie mr-2"></i>Makanan ringan</a></li>
          <li class="list-group-item bg-light ml-3"><a href="/kategori/Minuman"><i class="fas fa-cocktail mr-2"></i>Minuman</a></li> -->
        </ul>
      </div>

      @yield('container')

    <footer class="bg-dark text-white p-5">
      <div class="row">
        <div class="col-dm-3 footer-responsive">
          <h5>Layanan Pelanggan</h5>
          <ul>
            <li>Pusat Bantuan</li>
            <li>Cara Pembelian</li>
            <li>Pengiriman</li>
            <li>Cara Pengembalian</li>
          </ul>
        </div>
        <div class="col-dm-3 footer-responsive">
          <h5>Tentang Kami</h5>
          <p class="text-justify">Lorem ipsum dolor sit amet, consectetur<br> adipisicing elit, sed do eiusmod
          tempor<br> incididunt ut labore et dolore magna aliqua.<br> Ut enim ad minim veniam,
          quis nostrud exercitation<br> ullamco laboris nisi ut aliquip ex ea commodo<br>
          consequat. Duis aute irure dolor in reprehenderit<br> in voluptate velit esse
          cillum dolore eu fugiat<br> nulla pariatur. Excepteur sint occaecat cupidatat<br> non
          proident, sunt in culpa qui<br> officia deserunt mollit anim id est laborum.</p>
        </div>
        <div class="col-dm-3 footer-responsive">
          <h5>Mitra Kerjasama</h5>
          <ul>
            <li>GRAB</li>
            <li>GOJEK</li>
            <li>PT. POS Indonesia</li>
          </ul>
        </div>
        <div class="col-dm-3 footer-responsive">
          <h5>Hubungi Kami</h5>
          <ul>
            <li>085743695474</li>
            <li>gustiamart@gmail.com</li>
          </ul>
        </div>
      </div>
    </footer>
    <div class="copyright text-center text-white bg-dark p-1">
      <p>Copyright <i class="far fa-copyright"></i> 2019 GustiaMart</p>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{url('layout/javascript/script.js')}}"></script>
  </body>
</html>