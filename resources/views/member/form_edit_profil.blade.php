@extends('layout/member')     <!-- Bisa .(titik) atau / -->

@section('judul','GustiaMart - Member')
  
@section('content')

<div class="row" style="margin-left: auto; margin-right: auto;">
	<div class="col-md-auto">
		<!-- PANEL HEADLINE -->
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h2 class="panel-title">Edit Profil</h2>
			</div>
			<div class="panel-body">
				<div class="row">
		            <div class="col-md-7">
 					 	<form action="{{url('/update_profil')}}" method="post" enctype="multipart/form-data">
 					 		{{ method_field('patch') }}
 					 		{{ csrf_field() }}
 					 	 	<div class="form-group">
 					 	 		<label>Nama Akun :</label>
 					 	 		<input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nama akun" value="{{ $name }}">
 					 	 		@if ($errors->has('name'))
			                        <span class="invalid-feedback text-danger" role="alert">
			                          {{ $errors->first('name') }}
			                        </span>
			                    @endif
 					 	 	</div>
 					 	 	<div class="form-group">
 					 	 		<label>Username :</label>
 					 	 		<input type="text" name="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="Username" value="{{ $username }}">
 					 	 		@if ($errors->has('username'))
			                        <span class="invalid-feedback text-danger" role="alert">
			                          {{ $errors->first('username') }}
			                        </span>
			                    @endif
 					 	 	</div>
 					 	 	<div class="form-group">
 					 	 		<label>Nomor Telepon :</label>
 					 	 		<input type="text" name="no_telpon" class="form-control {{ $errors->has('no_telpon') ? ' is-invalid' : '' }}" placeholder="Nomor Telepon" value="{{ $no_telpon }}">
 					 	 		@if ($errors->has('no_telpon'))
			                        <span class="invalid-feedback text-danger" role="alert">
			                          {{ $errors->first('no_telpon') }}
			                        </span>
			                    @endif
 					 	 	</div>
 					 	 	<div class="form-group">
		                      <label>Foto Profil :</label>
		                      <input type="file" name="foto" class="col-7 form-control" value="{{ old('foto') }}">
		                    </div>
							<a href="{{url('/profil')}}" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary" style="">Simpan</button>
 					 	</form>
		            </div>
		        </div> 
			</div>
		</div>
		<!-- END PANEL HEADLINE -->
	</div>
</div>

@endsection