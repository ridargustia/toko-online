<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | GUSTIAmart</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{url('assets/vendor/linearicons/style.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{url('assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{url('assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{url('assets/img/emblem-gustiamart.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('assets/img/emblem-gustiamart.png')}}">

</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							@if(session('info'))
								<div class="alert alert-success">
									<i class="fa fa-info-circle"></i> {{session('info')}}
								</div>
							@endif
							<div class="header">
								<div class="logo text-center"><img src="{{url('assets/img/logo-gustiamart.png')}}" alt="GustiaMart Logo"></div>
								<p class="lead">Halaman Login</p>
							</div>
							<form class="form-auth-small" action="{{url('/login')}}" method="post">
								{{ csrf_field() }}
								<div class="input-group {{ $errors->has('username') || $errors->has('email') ? ' has-error' : '' }}">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input name="username" class="form-control" placeholder="Username / Email" type="text" value="">
								</div>
								@if ($errors->has('username'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
								<br>
								<div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input name="password" class="form-control" placeholder="Password" type="password">
								</div>
								<br>
								<input name="register_status" value="1" type="hidden">
								<!-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="email" class="form-control" id="signin-email" name="email" value="{{ old('email') }}" placeholder="Email">
									@if ($errors->has('email'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                    </span>
	                                @endif
								</div> -->
								<!-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" id="signin-password" name="password" value="" placeholder="Password">
									@if ($errors->has('password'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password') }}</strong>
	                                    </span>
	                                @endif
								</div> -->
								<div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
										<span>Remember me</span>
									</label>
								</div>
								<button type="submit" class="btn btn-danger btn-lg btn-block">LOGIN</button>
								<div class="bottom">
									<span class="helper-text"><a href="{{ url('/register') }}">Belum punya akun? Buat Akun!</a></span>
								</div>
								<!-- <div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="{{ route('password.request') }}">Forgot password?</a></span>
								</div> -->
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">GustiaMart Imogiri - Mini Market</h1>
							<p>by The Develovers</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
