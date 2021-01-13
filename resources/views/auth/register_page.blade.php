<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
  <title>Registrasi | GUSTIAmart</title>
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
              <div class="header">
                <div class="logo text-center"><img src="{{url('assets/img/logo-gustiamart.png')}}" alt="GustiaMart Logo"></div>
                <p class="lead">Buat Akun Baru</p>
              </div>
              <form class="form-auth-small" action="{{url('/register')}}" method="post">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                      <label for="register-name" class="control-label sr-only">Nama Depan</label>
                      <input type="text" class="form-control" id="register-name" name="first_name" value="{{ old('first_name') }}" placeholder="Nama Depan">
                      @if ($errors->has('first_name'))
                        <span class="help-block">
                           <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                      <label for="register-name" class="control-label sr-only">Nama Belakang</label>
                      <input type="text" class="form-control" id="register-name" name="last_name" value="{{ old('last_name') }}" placeholder="Nama Belakang">
                      @if ($errors->has('last_name'))
                        <span class="help-block">
                           <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                  <label for="register-username" class="control-label sr-only">Username</label>
                  <input type="text" class="form-control" id="register-username" name="username" value="{{ old('username') }}" placeholder="Username">
                  @if ($errors->has('username'))
                    <span class="help-block">
                       <strong>{{ $errors->first('username') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="register-email" class="control-label sr-only">Email</label>
                  <input type="email" class="form-control" id="register-email" name="email" value="{{ old('email') }}" placeholder="Alamat Email">
                  @if ($errors->has('email'))
                    <span class="help-block">
                       <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
                <!-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="register-password" class="control-label sr-only">Password</label>
                  <input type="password" class="form-control" id="register-password" name="password" value="" placeholder="Password">
                  @if ($errors->has('password'))
                    <span class="help-block">
                       <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="register-confirm_password" class="control-label sr-only">Confirm Password</label>
                  <input type="password" class="form-control" id="register-confirm_password" name="password_confirmation" value="" placeholder="Ulangi Password">
                </div> -->
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="register-password" class="control-label sr-only">Password</label>
                      <input type="password" class="form-control" id="register-password" name="password" value="" placeholder="Password">
                      <!-- @if ($errors->has('password'))
                        <span class="help-block">
                           <strong>{{ $errors->first('password') }}</strong>
                        </span>
                      @endif -->
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="register-confirm_password" class="control-label sr-only">Confirm Password</label>
                      <input type="password" class="form-control" id="register-confirm_password" name="password_confirmation" value="" placeholder="Ulangi Password">
                    </div>
                  </div>
                </div>
                <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                  @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
                
                <button type="submit" class="btn btn-danger btn-lg btn-block">Daftar Akun</button>
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
