<!doctype html>
<html lang="en">

<head>
	<title>@yield('judul')</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{url('assets/vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{url('assets/vendor/chartist/css/chartist-custom.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{url('assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{url('assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{url('assets/img/emblem-gustiamart.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{url('assets/img/emblem-gustiamart.png')}}">

	<link rel="stylesheet" type="text/css" href="{{url('layout/css/style_member.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('layout/fontawesome-free/css/all.min.css')}}">

	<style type="text/css">
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

        .sembunyikan-nomor{
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

    </style>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6">
						<div class="navbar-btn sembunyikan">
							<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-menu"></i></button>
						</div>
						<div class="brand">
							<a href="{{url('/member')}}"><img src="{{url('assets/img/logo-gustiamart.png')}}" alt="GustiaMart Logo" class="img-responsive logo"></a>
						</div>
					</div>
					<div class="col-lg-6">
						<div id="navbar-menu">
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="{{url('/cartmember')}}" class="dropdown-toggle icon-menu @if($title === 'Cart') active @endif">
										<i class="lnr lnr-cart"></i>
										@if ( Cart::count() > 0)
										<span class="badge bg-danger">{{ Cart::count() }}</span>
										@endif
									</a>
								</li>
								
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{url('foto_profil/'.auth()->user()->foto)}}" class="img-circle" alt="Avatar" style="width: 23px; height: 23px;"> <span>{{ $name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
									<ul class="dropdown-menu">
										<li><a href="{{url('/profil')}}"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
										<!-- <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
										<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> -->
										<li>
											<a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
												<i class="lnr lnr-exit"></i> <span>Logout</span>
											</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="{{url('/member')}}" @if($title === 'Dashboard') class="active" @endif><i class="lnr lnr-home"></i> <span>Beranda</span></a></li>
						@foreach($kategoris as $kategori)
							<li><a href="{{url('/member_kategori/'.$kategori->id)}}" 
								@if($title === $kategori->nama_kategori)
									class="active"
								@endif><i class="lnr lnr-cart"></i> <span>{{$kategori->nama_kategori}}</span></a></li>
						@endforeach
						<!-- <li><a href="elements.html" class=""><i class="lnr lnr-cart"></i> <span>Sembako</span></a></li>
						<li><a href="charts.html" class=""><i class="lnr lnr-cart"></i> <span>Rokok</span></a></li>
						<li><a href="panels.html" class=""><i class="lnr lnr-cart"></i> <span>Obat</span></a></li>
						<li><a href="notifications.html" class=""><i class="lnr lnr-cart"></i> <span>Makanan Ringan</span></a></li>
						<li><a href="tables.html" class=""><i class="lnr lnr-cart"></i> <span>Minuman</span></a></li> -->
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">

					@yield('content')
				
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">Shared by <i class="fa fa-love"></i><a href="">BootstrapThemes</a>
</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{url('assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{url('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{url('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{url('assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
	<script src="{{url('assets/vendor/chartist/js/chartist.min.js')}}"></script>
	<script src="{{url('assets/scripts/klorofil-common.js')}}"></script>
	<script type="text/javascript" src="{{url('layout/javascript/script.js')}}"></script>
	<script>
	$(function() {
		var data, options;

		// headline charts
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[23, 29, 24, 40, 25, 24, 35],
				[14, 25, 18, 34, 29, 38, 44],
			]
		};

		options = {
			height: 300,
			showArea: true,
			showLine: false,
			showPoint: false,
			fullWidth: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#headline-chart', data, options);


		// visits trend charts
		data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			series: [{
				name: 'series-real',
				data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
			}, {
				name: 'series-projection',
				data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
			}]
		};

		options = {
			fullWidth: true,
			lineSmooth: false,
			height: "270px",
			low: 0,
			high: 'auto',
			series: {
				'series-projection': {
					showArea: true,
					showPoint: false,
					showLine: false
				},
			},
			axisX: {
				showGrid: false,

			},
			axisY: {
				showGrid: false,
				onlyInteger: true,
				offset: 0,
			},
			chartPadding: {
				left: 20,
				right: 20
			}
		};

		new Chartist.Line('#visits-trends-chart', data, options);


		// visits chart
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[6384, 6342, 5437, 2764, 3958, 5068, 7654]
			]
		};

		options = {
			height: 300,
			axisX: {
				showGrid: false
			},
		};

		new Chartist.Bar('#visits-chart', data, options);


		// real-time pie chart
		var sysLoad = $('#system-load').easyPieChart({
			size: 130,
			barColor: function(percent) {
				return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
			},
			trackColor: 'rgba(245, 245, 245, 0.8)',
			scaleColor: false,
			lineWidth: 5,
			lineCap: "square",
			animate: 800
		});

		var updateInterval = 3000; // in milliseconds

		setInterval(function() {
			var randomVal;
			randomVal = getRandomInt(0, 100);

			sysLoad.data('easyPieChart').update(randomVal);
			sysLoad.find('.percent').text(randomVal);
		}, updateInterval);

		function getRandomInt(min, max) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}

	});
	</script>
</body>

</html>
