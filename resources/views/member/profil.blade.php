@extends('layout/member')     <!-- Bisa .(titik) atau / -->

@section('judul','GustiaMart - Member')
  
@section('content')

<div class="panel panel-profile">
	<div class="clearfix">
		<!-- LEFT COLUMN -->
		<div class="profile-left">
			<!-- PROFILE HEADER -->
			<div class="profile-header">
				<div class="overlay"></div>
				<div class="profile-main">
					<img src="{{url('foto_profil/'.auth()->user()->foto)}}" class="img-circle" alt="Avatar" style="width: 90px; height: 90px;">
					<h3 class="name">{{ $name }}</h3>
					<span class="online-status status-available">Available</span>
				</div>
				<div class="profile-stat">
					<div class="row">
						<div class="col-md-6 stat-item">
							45 <span>Transaksi</span>
						</div>
						<div class="col-md-6 stat-item">
							15 <span>Produk Terbeli</span>
						</div>
						<!-- <div class="col-md-4 stat-item">
							2174 <span>Points</span>
						</div> -->
					</div>
				</div>
			</div>
			<!-- END PROFILE HEADER -->
			<!-- PROFILE DETAIL -->
			<!-- <div class="profile-detail">
				<div class="profile-info">
					<h4 class="heading">Basic Info</h4>
					<ul class="list-unstyled list-justify">
						<li>Birthdate <span>24 Aug, 2016</span></li>
						<li>Mobile <span>(124) 823409234</span></li>
						<li>Email <span>samuel@mydomain.com</span></li>
						<li>Website <span><a href="https://www.themeineed.com">www.themeineed.com</a></span></li>
					</ul>
				</div> -->
				<!-- <div class="profile-info">
					<h4 class="heading">Social</h4>
					<ul class="list-inline social-icons">
						<li><a href="#" class="facebook-bg"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#" class="twitter-bg"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#" class="google-plus-bg"><i class="fab fa-google-plus-g"></i></a></li>
						<li><a href="#" class="github-bg"><i class="fab fa-github"></i></a></li>
					</ul>
				</div> -->
				<!-- <div class="profile-info">
					<h4 class="heading">About</h4>
					<p>Interactively fashion excellent information after distinctive outsourcing.</p>
				</div>
				<div class="text-center"><a href="#" class="btn btn-primary">Edit Profile</a></div> -->
			<!-- </div> -->
			<!-- END PROFILE DETAIL -->
		</div>
		<!-- END LEFT COLUMN -->
		<!-- RIGHT COLUMN -->
		<div class="profile-right">
			<h4 class="heading">Informasi Profil</h4>
			@if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
            @endif
			<!-- AWARDS -->
			<!-- <div class="awards">
				<div class="row">
					<div class="col-md-4 col-sm-7">
						<div class="award-item">
							<div class="hexagon">
								<span class="lnr lnr-envelope award-icon"></span>
							</div>
							<span>asdasdasda</span>
						</div>
					</div>
					<div class="col-md-4 col-sm-7">
						<div class="award-item">
							<div class="hexagon">
								<span class="lnr lnr-clock award-icon"></span>
							</div>
							<span>samuel@mydomain</span>
						</div>
					</div>
					<div class="col-md-4 col-sm-7">
						<div class="award-item">
							<div class="hexagon">
								<span class="lnr lnr-magic-wand award-icon"></span>
							</div>
							<span>Problem Solver</span>
						</div>
					</div> -->
					<!-- <div class="col-md-3 col-sm-6">
						<div class="award-item">
							<div class="hexagon">
								<span class="lnr lnr-heart award-icon"></span>
							</div>
							<span>Most Loved</span>
						</div>
					</div> -->
				<!-- </div> -->
				<!-- <div class="text-center"><a href="#" class="btn btn-default">See all awards</a></div> -->
			<!-- </div> -->
			<!-- END AWARDS -->
			<!-- TABBED CONTENT -->
			<!-- <div class="custom-tabs-line tabs-line-bottom left-aligned">
				<ul class="nav" role="tablist">
					<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Recent Activity</a></li>
					<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Projects <span class="badge">7</span></a></li>
				</ul>
			</div> -->
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab-bottom-left1">
					<ul class="list-unstyled activity-timeline">
						<li>
							<i class="fas fa-user-alt activity-icon"></i>
							<p>{{ $username }}<span class="timestamp">Username</span></p>
						</li>
						<li>
							<i class="fas fa-at activity-icon"></i>
							<p>{{ $email }}<span class="timestamp">Alamat Email</span></p>
						</li>
						<li>
							<i class="fas fa-phone activity-icon"></i>
							<p>{{ $no_telpon }}<span class="timestamp">Nomor Telepon</span></p>
						</li>
						<li>
							<i class="fas fa-id-badge activity-icon"></i>
							<p>{{ $status }}<span class="timestamp">Status</span></p>
						</li>
					</ul>
					<div class="margin-top-30 text-center"><a href="{{url('/edit_profil')}}" class="btn btn-default">Edit Profil</a></div>
				</div>
				<!-- <div class="tab-pane fade" id="tab-bottom-left2">
					<div class="table-responsive">
						<table class="table project-table">
							<thead>
								<tr>
									<th>Title</th>
									<th>Progress</th>
									<th>Leader</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><a href="#">Spot Media</a></td>
									<td>
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
												<span>60% Complete</span>
											</div>
										</div>
									</td>
									<td><img src="{{url('assets/img/user2.png')}}" alt="Avatar" class="avatar img-circle"> <a href="#">Michael</a></td>
									<td><span class="label label-success">ACTIVE</span></td>
								</tr>
								<tr>
									<td><a href="#">E-Commerce Site</a></td>
									<td>
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;">
												<span>33% Complete</span>
											</div>
										</div>
									</td>
									<td><img src="{{url('assets/img/user1.png')}}" alt="Avatar" class="avatar img-circle"> <a href="#">Antonius</a></td>
									<td><span class="label label-warning">PENDING</span></td>
								</tr>
								<tr>
									<td><a href="#">Project 123GO</a></td>
									<td>
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;">
												<span>68% Complete</span>
											</div>
										</div>
									</td>
									<td><img src="{{url('assets/img/user1.png')}}" alt="Avatar" class="avatar img-circle"> <a href="#">Antonius</a></td>
									<td><span class="label label-success">ACTIVE</span></td>
								</tr>
								<tr>
									<td><a href="#">Wordpress Theme</a></td>
									<td>
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
												<span>75%</span>
											</div>
										</div>
									</td>
									<td><img src="{{url('assets/img/user2.png')}}" alt="Avatar" class="avatar img-circle"> <a href="#">Michael</a></td>
									<td><span class="label label-success">ACTIVE</span></td>
								</tr>
								<tr>
									<td><a href="#">Project 123GO</a></td>
									<td>
										<div class="progress">
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
												<span>100%</span>
											</div>
										</div>
									</td>
									<td><img src="{{url('assets/img/user1.png')}}" alt="Avatar" class="avatar img-circle" /> <a href="#">Antonius</a></td>
									<td><span class="label label-default">CLOSED</span></td>
								</tr>
								<tr>
									<td><a href="#">Redesign Landing Page</a></td>
									<td>
										<div class="progress">
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
												<span>100%</span>
											</div>
										</div>
									</td>
									<td><img src="{{url('assets/img/user5.png')}}" alt="Avatar" class="avatar img-circle" /> <a href="#">Jason</a></td>
									<td><span class="label label-default">CLOSED</span></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div> -->
			</div>
			<!-- END TABBED CONTENT -->
		</div>
		<!-- END RIGHT COLUMN -->
	</div>
</div>


@endsection