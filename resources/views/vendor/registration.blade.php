<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>vendor| Registration</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
      <link rel="stylesheet" href="{{ asset('css/customize.css') }}">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   </head>
   <body class="hold-transition register-page">
      <div class="col-md-8">
         <div class="register-logo">
         </div>
         @if( Session::has( 'success' ))
         <div class="alert alert-success" id="successMessage">
            <span class="glyphicon glyphicon-ok">{{ Session::get( 'success' ) }}</span>
         </div>
         @endif
         @if( Session::has( 'error' ))
         <div class="alert alert-danger" id="errorMessage">
            <span class="glyphicon glyphicon-ok">{{ Session::get( 'error' ) }}</span>
         </div>
         @endif
         <div class="card">
            <div class="card-body register-card-body">
               <p class="login-box-msg"><strong id="vendor-head">Register a new vendor</strong></p>
               <form role="form" action="{{route('vendor.store')}}" method="post" id="registrationForm" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" class="form-control" name="role_id" value="2">
                  <div class="row">
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="first_name" placeholder="First name">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-user"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="middle_name" placeholder="Middle name">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-user"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="last_name" placeholder="Last name">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-user"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="mobile_number" placeholder="Mobile number">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-mobile"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="email" class="form-control" name="email_address" placeholder="Email address">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-envelope"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group  mb-3">
                           <div class="custom-file">
                              <input type="file" class="custom-file-input" name="profile_image" id="profileImage">
                              <label class="custom-file-label" for="profileImage">Choose file</label>
                           </div>
                           <div class="input-group-append">
                              <span class="input-group-text" id="">Upload Image</span>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="company_name" placeholder="Company name">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-building"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="address" placeholder="Company address">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-building"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="state" placeholder="State">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-tag"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="city" placeholder="city">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-building"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="pincode" placeholder="Pincode">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-building"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="contact_number" placeholder="Contact number">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-building"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="fax" placeholder="Fax">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-building"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="website" placeholder="Website">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-building"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-4">
                     </div>
                     <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                     </div>
                     <!-- /.col -->
                  </div>
               </form>
               <a href="{{url('/login')}}" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
         </div>
         <!-- /.card -->
      </div>
      <!-- /.register-box -->
      <!-- jQuery -->
      <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
      <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/vendor_registration.js') }}"></script>
   </body>
</html>