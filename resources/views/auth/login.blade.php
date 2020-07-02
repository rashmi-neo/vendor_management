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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/customize.css') }}">
  <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Login</a>
  </div>
  <!-- /.login-logo -->
  @if(session()->get('error'))
        <p class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-check"></i>{{ Session::get('error') }}
      </p><br />
  @endif
  <div class="card">
    <div class="card-body login-card-body">
      <form role="form" method="post" action="{{route('login')}}" data-parsley-validate="parsley" id="loginForm">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name ="email" class="form-control" placeholder="Email" data-parsley-errors-container="#emailError" data-parsley-required="true" data-parsley-error-message="Please enter email address">
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
          <input type="password" name="password" class="form-control" placeholder="Password" data-parsley-errors-container="#passwordError" data-parsley-required="true" data-parsley-error-message="Please enter password">
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
        <div class="input-group mb-3">
        <!-- @captcha
          <input type="text" id="captcha" style="border-radius:5px" class="form-controll" name="captcha" autocomplete="off" data-parsley-errors-container="#captchaError" data-parsley-required="true" data-parsley-error-message="Please enter captcha">
          @error('captcha')
          <span class="text-danger errormsg" role="alert">
           <p>{{ $message }}</p>
          </span>
         @enderror -->
         <span id="captchaError"></span>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <div class="col-4">
          </div>
          <div class="col-4">
            <a href="{{route('vendor.register')}}" class="btn btn-primary btn-block">Sign up</a>
          </div>
        </div>
      </form>
      <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://parsleyjs.org/dist/parsley.min.js"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script>
  $(function(){
    setTimeout(function() {
      $('#errorMessage').fadeOut('fast');
    }, 3000);     
  });
</script>
</body>
</html>