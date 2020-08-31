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
      <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">
      <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   </head>
   <body class="hold-transition register-page">
      <div class="col-md-8">
         <div class="register-logo">
         </div>
         <div class="card mt-5">
            <div class="card-body register-card-body">
               <p class="login-box-msg h3">Vendor Sign Up </p>
               {!! Form::open(['route' => 'vendor.store','class' => 'form-horizontal',
                  'method' => 'post','data-parsley-validate' => 'parsley','enctype' =>'multipart/form-data']) !!}
                  @csrf
                  <input type="hidden" class="form-control" name="verify_status" value="pending">
                  <div class="row">
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           {!! Form::text('first_name', null, ['class' => 'form-control ','placeholder' => 'First Name',
                           'data-parsley-required' => 'true',
                           'data-parsley-required-message' => 'First name is required',
                           'data-parsley-trigger' => "input",
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-errors-container'=>'#firstNameError',
                           'data-parsley-pattern'=>"^[a-zA-Z]+$",
                           'data-parsley-pattern-message' => 'Please enter only alphabetical letters',
                           'data-parsley-minlength' => '2',
                           'data-parsley-maxlength' => '50']) !!}
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
                           {!! Form::text('middle_name', null, ['class' => 'form-control ','placeholder' => 'Middle Name',
                           'data-parsley-trigger' => "input",
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-errors-container'=>'#middleNameError',
                           'data-parsley-pattern'=>"^[a-zA-Z]+$",
                           'data-parsley-pattern-message' => 'Please enter only alphabetical letters',
                           'data-parsley-minlength' => '2',
                           'data-parsley-maxlength' => '50']) !!}   
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
                           {!! Form::text('last_name', null, ['class' => 'form-control','placeholder' => 'Last Name',
                           'data-parsley-required' => 'true',
                           'data-parsley-required-message' => 'Last name is required',
                           'data-parsley-trigger' => "input",
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-errors-container'=>'#lastNameError',
                           'data-parsley-pattern'=>"^[a-zA-Z]+$",
                           'data-parsley-pattern-message' => 'Please enter only alphabetical letters',
                           'data-parsley-minlength' => '2',
                           'data-parsley-maxlength' => '50']) !!}
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
                           {!! Form::text('mobile_number', null, ['class' => 'form-control ','placeholder' => 'Mobile Number',
                           'data-parsley-required' => 'true',
                           'data-parsley-required-message' => 'Mobile Number is required',
                           'data-parsley-trigger' => "input",
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-errors-container'=>'#mobileNumberError',
                           'data-parsley-type'=>"digits",
                           'data-parsley-minlength' => '10',
                           'data-parsley-maxlength' => '12']) !!}
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
                           {!! Form::email('email', null, ['class' => 'form-control ','placeholder' => 'Email Address',
                           'data-parsley-required' => 'true',
                           'data-parsley-required-message' => 'Email Address is required',
                           'data-parsley-trigger' => "input",
                           'data-parsley-errors-container'=>'#emailError',
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-maxlength' => '50']) !!}
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
                              {!! Form::file('profile_image', array('class' => 'form-control ','placeholder' => 'Profile Image',
                              'data-parsley-trigger' => "input",
                              'data-parsley-fileextension'=>'jpg,png,jpeg',
                              'data-parsley-errors-container'=>'#profileError',
                              'data-parsley-trigger'=>"blur",
                              'data-parsley-maxlength' => '50')) !!}
                              <div class="input-group-append">
                                 <div class="input-group-text">
                                    <span class="fas fa-file"></span>
                                 </div>
                              </div>
                              @error('profile_image')
                                 <span class="text-danger errormsg" role="alert">
                                 <p>{{ $message }}</p>
                                 </span>
                              @enderror
                        </div>
                        <span id="profileError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           {!! Form::text('company_name', null, ['class' => 'form-control ','placeholder' => 'Company Name',
                           'data-parsley-required' => 'true',
                           'data-parsley-required-message' => 'Company Name is required',
                           'data-parsley-trigger' => "input",
                           'data-parsley-errors-container'=>'#companyNameError',
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-minlength' => '5',
                           'data-parsley-maxlength' => '50']) !!}
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
                           {!! Form::text('address', null, ['class' => 'form-control ','placeholder' => 'Company Address',
                           'data-parsley-required' => 'true',
                           'data-parsley-required-message' => 'Company Address is required',
                           'data-parsley-trigger' => "input",
                           'data-parsley-errors-container'=>'#addressError',
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-minlength' => '5',
                           'data-parsley-maxlength' => '200']) !!}
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
                           {!!Form::select('category[]', $categories, null, 
                           array('class'=>'form-control category', 'data-placeholder'=>'Select Category',
                           'multiple'=>'multiple','id'=>'category',
                           'data-parsley-required' => 'true',
                           'data-parsley-errors-container'=>'#categoryError',
                           'data-parsley-required-message' => 'Category is required')) !!}
                           @error('category')
                           <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                        <span id="categoryError"><span>
                     </div>
                     <div class= "col-sm-6">
                        <div class="input-group mb-3">
                           {!! Form::text('state', null, ['class' => 'form-control ','placeholder' => 'Company State',
                           'data-parsley-required' => 'true',
                           'data-parsley-required-message' => 'State is required',
                           'data-parsley-trigger' => "input",
                           'data-parsley-pattern' => '/^[a-zA-Z ]*$/',
                           'data-parsley-pattern-message' => 'Please enter only alphabets',
                           'data-parsley-errors-container'=>'#stateError',
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-minlength' => '2',
                           'data-parsley-maxlength' => '20']) !!}
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
                           {!! Form::text('city', null, ['class' => 'form-control ','placeholder' => 'City',
                           'data-parsley-required' => 'true',
                           'data-parsley-required-message' => 'City is required',
                           'data-parsley-trigger' => "input",
                           'data-parsley-pattern' => '/^[a-zA-Z ]*$/',
                           'data-parsley-pattern-message' => 'Please enter only alphabets',
                           'data-parsley-errors-container'=>'#cityError',
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-minlength' => '2',
                           'data-parsley-maxlength' => '20']) !!}
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
                           {!! Form::text('pincode', null, ['class' => 'form-control ','placeholder' => 'Company Pincode',
                           'data-parsley-required' => 'true',
                           'data-parsley-trigger' => "input",
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-errors-container'=>'#pincodeError',
                           'data-parsley-type'=>"digits",
                           'data-parsley-minlength' => '6',
                           'data-parsley-maxlength' => '10']) !!}
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
                           {!! Form::text('contact_number', null, ['class' => 'form-control ','placeholder' => 'Company Contact Number',
                           'data-parsley-required' => 'true',
                           'data-parsley-required-message' => 'Company Contact Number is required',
                           'data-parsley-trigger' => "input",
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-errors-container'=>'#contactNoError',
                           'data-parsley-type'=>"digits",
                           'data-parsley-minlength' => '10',
                           'data-parsley-maxlength' => '12']) !!}
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
                           {!! Form::text('fax', null, ['class' => 'form-control ','placeholder' => 'Company Fax',
                           'data-parsley-trigger' => "input",
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-errors-container'=>'#faxError',
                           'data-parsley-pattern'=>"^[\d\+\-\.\(\)\/\s]+$",
                           'data-parsley-maxlength' => '20']) !!}
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
                     <div class= "col-sm-12">
                        <div class="input-group mb-3">
                           {!! Form::text('website', null, ['class' => 'form-control ','placeholder' => 'Company Website URL',
                           'data-parsley-trigger' => "input",
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-errors-container'=>'#websiteError',
                           'data-parsley-urlstrict' =>'https://www.google.com',
                           'data-parsley-maxlength' => '20']) !!}
                           <div class="input-group-append">
                              <div class="input-group-text">
                                 <span class="fas fa-globe"></span>
                              </div>
                           </div>
                        </div>
                        @error('website')
                        <span class="text-danger errormsg" role="alert">
                        <p>{{ $message }}</p>
                        </span>
                        @enderror
                        <span id="websiteError"><span>
                     </div>
                  </div>
                  <div class="row mt-4">
                     <div class="col-md-6">
                        {!! Form::button('Register', ['type' => 'submit', 'class' => 'btn btn-primary col-12'] ) !!}
                     </div>
                     <div class="col-md-6">
                        <a href="{{route('login')}}" class="btn btn-md btn-default  col-12">Cancel</a>
                     </div>
                     <!-- /.col -->
                  </div>
               {!! Form::close() !!}
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
      <script src="{{asset('js/toastr.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('js/ui-toastr.min.js')}}" type="text/javascript"></script>
      <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

      <script type="text/javascript">
         $(function(){
            $('#category').select2({
                  theme: 'bootstrap4'
            })
      });
      </script>                       
      @if(session()->get('success'))
         <script>
            var message = "{{ Session::get('success') }}"
            toastr.success(message);
         </script>
      @endif
      @if(session()->get('error'))
         <script>
            var message = "{{ Session::get('error') }}"
            toastr.error(message);
         </script>
      @endif
      <script>
      $(document).ready(function() {
         window.ParsleyValidator.addValidator('fileextension', function (value, requirement) {
                  var tagslistarr = requirement.split(',');
                  var fileExtension = value.split('.').pop();
                        var arr=[];
                        $.each(tagslistarr,function(i,val){
                           arr.push(val);
                        });
                  if(jQuery.inArray(fileExtension, arr)!='-1') {
                  return true;
                  } else {
                  return false;
                  }
            }, 32)
            .addMessage('en', 'fileextension', 'The extension should be jpg,png and jpeg');

         $("#vendorForm").parsley();

    window.ParsleyValidator.addValidator('urlstrict', function (value, requirement){
            var url = 'http://www.google.com';
            var regExp = /^(ftp|http|https):\/\/[^ "]+$/;
            return '' !== value ? regExp.test( value ) : false;
        }, 32)
        .addMessage('en', 'urlstrict', 'Must be a valid strict URL');
      });
      </script>
   </body>
</html>