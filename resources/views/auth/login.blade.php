<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/customize.css') }}">
  <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
 <p class="text-center h2 mb-5">Vendor Management</p>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    <p class="login-box-msg h3">Log in </p>
      {!! Form::open(['route' => 'login','id' => 'loginForm','method' => 'post','data-parsley-validate' => 'parsley']) !!}
        @csrf
        <div class="input-group mb-3">
          {!! Form::email('email', null, ['class' => 'form-control ','placeholder' => 'Email Address',
            'data-parsley-required' => 'true',
            'data-parsley-required-message' => 'Please enter email address',
            'data-parsley-trigger' => "input",
            'data-parsley-errors-container'=>'#emailError',
            'data-parsley-trigger'=>"blur"]) !!}
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
        <div class="errorMsg">
          <span class="text-danger errormsg" role="alert">
            {{ $message }}
          </span>
        <div>
        @enderror
        <span id="emailError"></span>
        <div class="input-group mb-3">
          {!! Form::password('password', ['class' => 'form-control','placeholder' => 'Password',
          'data-parsley-required' => 'true',
          'data-parsley-required-message' => 'Please enter password',
          'data-parsley-trigger' => "input",
          'data-parsley-errors-container'=>'#passwordError',
          'data-parsley-trigger'=>"blur"]) !!}
          <div class="input-group-append">
            <div class="input-group-text">
          <span id="emailError"></span>
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
         <div class="errorMsg">
          <span class="text-danger errormsg" role="alert">
              {{ $message }}
          </span>
          </div>
        @enderror
        <span id="passwordError"></span>
        
        <div class="social-auth-links text-center mb-3">
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        <a href="{{route('vendor.register')}}" class="btn btn-danger btn-block">Sign Up as Vendor</a>
        </div>
			{!! Form::close() !!}
      <a href="{{route('password.request')}}" class="">Forgotten Password?</a>
      <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://parsleyjs.org/dist/parsley.min.js"></script>
<script src="{{asset('js/toastr.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>
@if(session()->get('error'))
<script>
  var message = "{{ Session::get('error') }}"
  toastr.error(message);
</script>
@endif
@if(session()->get('success'))
<script>
  var message = "{{ Session::get('success') }}"
  toastr.success(message);
</script>
@endif
</body>
</html>