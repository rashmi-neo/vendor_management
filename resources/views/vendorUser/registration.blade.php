<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Vendor| Registration</title>
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
      <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">
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
               <form role="form" action="{{route('vendor.store')}}" method="post" data-parsley-validate="parsley" id="registrationForm" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" class="form-control" name="role_id" value="2">
                  <div class="row">
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="first_name" placeholder="First name" 
                           data-parsley-errors-container="#firstNameError" data-parsley-required="true" 
                           data-parsley-error-message="Please enter first name">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-user"></span>
                              </div>
                           </div>
                           @error('first_name')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="firstNameError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="middle_name" placeholder="Middle name" 
                           data-parsley-errors-container="#middleNameError" data-parsley-required="true" 
                           data-parsley-error-message="Please enter middle name">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-user"></span>
                              </div>
                           </div>
                           @error('middle_name')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="middleNameError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="last_name" placeholder="Last name" 
                           data-parsley-errors-container="#lastNameError" data-parsley-required="true" 
                           data-parsley-error-message="Please enter last name" >
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-user"></span>
                              </div>
                           </div>
                           @error('last_name')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="lastNameError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="mobile_number" data-parsley-errors-container="#mobileNumberError" 
                           placeholder="Mobile number" data-parsley-required="true" data-parsley-type="digits">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-mobile"></span>
                              </div>
                           </div>
                           @error('mobile_number')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="mobileNumberError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="email" class="form-control" name="email" placeholder="Email address" data-parsley-errors-container="#emailError" 
                           data-parsley-required="true" data-parsley-error-message="Please enter email address">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-envelope"></span>
                              </div>
                           </div>
                           @error('email')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="emailError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group  mb-3">
                           <div class="custom-file">
                              <input type="file" class="custom-file-input" name="profile_image" id="profileImage" data-parsley-errors-container="#profileError" 
                              data-parsley-required="true" data-parsley-error-message="Please upload profile picture">
                              <label class="custom-file-label" for="profileImage">Choose file</label>
                           </div>
                           <div class="input-group-append">
                              <span class="input-group-text" id="">Upload Image</span>
                           </div>
                        </div>
                        @error('profile_image')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                        @enderror
                        <span id="profileError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="company_name" placeholder="Company name" data-parsley-errors-container="#companyNameError" 
                           data-parsley-required="true" data-parsley-error-message="Please enter company name">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-building"></span>
                              </div>
                           </div>
                           @error('company_name')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="companyNameError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="address" placeholder="Company address" 
                           data-parsley-errors-container="#addressError" data-parsley-required="true" 
                           data-parsley-error-message="Please enter company address">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-address-card"></span>
                              </div>
                           </div>
                           @error('address')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="addressError"><span>
                     </div>
                     <div class="col-sm-6">
                        <div class="mb-3">
                           <select class="form-control" style="width: 100%;" name="category" id="category"
                           data-parsley-errors-container="#categoryError" data-parsley-required="true" 
                           data-parsley-error-message="Please enter category">
                              <option value="">Select Category</option>
                              @forelse($categories as $category)replies
                                 <option value="{{$category->id}}">{{ $category->name }}</option>
                              @empty
                                 <option value="">No categories</option>
                              @endforelse
                           </select>
                           @error('address')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="categoryError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="state" placeholder="Company state" 
                           data-parsley-errors-container="#stateError" data-parsley-required="true" 
                           data-parsley-error-message="Please enter state">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-city"></span>
                              </div>
                           </div>
                           @error('state')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="stateError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="city" placeholder="Company city" data-parsley-errors-container="#cityError"
                           data-parsley-required="true" data-parsley-error-message="Please enter city">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-city"></span>
                              </div>
                           </div>
                           @error('city')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="cityError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="pincode" placeholder="Company pincode" data-parsley-errors-container="#pincodeError" 
                           data-parsley-required="true" data-parsley-type="digits">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-map-pin"></span>
                              </div>
                           </div>
                           @error('pincode')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="pincodeError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="contact_number" placeholder="Company contact number" 
                           data-parsley-errors-container="#contactNoError" data-parsley-required="true" data-parsley-type="digits">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-phone"></span>
                              </div>
                           </div>
                           @error('contact_number')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="contactNoError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="fax" placeholder="Company fax" data-parsley-errors-container="#faxError" data-parsley-required="true" data-parsley-error-message="Please enter fax">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-fax"></span>
                              </div>
                           </div>
                           @error('fax')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="faxError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" name="website" placeholder="Company website URL" data-parsley-errors-container="#websiteError" data-parsley-required="true"  data-parsley-type="url">
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-globe"></span>
                              </div>
                           </div>
                        </div>
                        <span id="websiteError"><span>
                           @error('website')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-md">Register</button>
                        <a href="{{route('login')}}" class="btn btn-md btn-default">Cancel</a>
                     </div>
                     <!-- /.col -->
                  </div>
               </form>
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
      <script src="https://parsleyjs.org/dist/parsley.min.js"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
      <script>
         $(function(){
            setTimeout(function() {
               $('#errorMessage').fadeOut('fast');
            }, 3000);  
            setTimeout(function() {
               $('#successMessage').fadeOut('fast');
            }, 3000);   
         });
      </script>
   </body>
</html>