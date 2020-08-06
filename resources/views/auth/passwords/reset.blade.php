<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Recover Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <p class="text-center h2 mb-5">Vendor Management</p>
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
      <p class="login-box-msg">You are only one step away from your new password, recover your password now.</p>

      
        {!! Form::open(['route' => 'password.update','id' => 'resetForm','method' => 'post','data-parsley-validate' => 'parsley']) !!}
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
          {!! Form::password('password', ['class' => 'form-control','id' => 'password','placeholder' => 'Password',
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


        <div class="input-group mb-3">
          {!! Form::password('password_confirmation', ['class' => 'form-control','placeholder' => 'Confirm Password',
          'data-parsley-required' => 'true',
          'data-parsley-required-message' => 'Please enter confirm password',
          'data-parsley-trigger' => "input",
          'data-parsley-errors-container'=>'#passwordConfirmError',
          'data-parsley-trigger'=>"blur",
          'data-parsley-equalto'=>"#password"

          ]) !!}
          <div class="input-group-append">
            <div class="input-group-text">
          <span id="emailError"></span>
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password_confirmation')
         <div class="errorMsg">
          <span class="text-danger errormsg" role="alert">
              {{ $message }}
          </span>
          </div>
        @enderror
        <span id="passwordConfirmError"></span>
        
        <div class="row">
          <div class="col-12">
            <input type="hidden" name="token" value="{{$token}}" class="form-control">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script src="https://parsleyjs.org/dist/parsley.min.js"></script>
</body>
</html>
