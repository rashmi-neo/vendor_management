@extends('layouts.master')
@section('main-content')
<div class="col-md-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title">Create Vendor</h3>
      </div>
      <div class="card-body">
         {!! Form::open(['route' => 'vendors.store','class' => 'form-horizontal',
            'method' => 'post','data-parsley-validate' => 'parsley','enctype' =>'multipart/form-data']) !!}
            @csrf
            <input type="hidden" class="form-control" name="verify_status" value="Approved">
            <div class="row">
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('first_name', null, ['class' => 'form-control ','placeholder' => 'First Name',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'First name is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-pattern'=>"^[a-zA-Z]+$",
                     'data-parsley-pattern-message' => 'Please enter only alphabetical letters',
                     'data-parsley-minlength' => '2',
                     'data-parsley-maxlength' => '50']) !!}
                  </div>
                  @error('first_name')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('middle_name', null, ['class' => 'form-control ','placeholder' => 'Middle Name',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-pattern'=>"^[a-zA-Z]+$",
                     'data-parsley-pattern-message' => 'Please enter only alphabetical letters',
                     'data-parsley-minlength' => '2',
                     'data-parsley-maxlength' => '50']) !!}   
                  </div>
               </div>
               @error('middle_name')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
               @enderror
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('last_name', null, ['class' => 'form-control ','placeholder' => 'Last Name',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Last name is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-pattern'=>"^[a-zA-Z]+$",
                     'data-parsley-pattern-message' => 'Please enter only alphabetical letters',
                     'data-parsley-minlength' => '2',
                     'data-parsley-maxlength' => '50']) !!}
                  </div>
                  @error('last_name')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('mobile_number', null, ['class' => 'form-control ','placeholder' => 'Mobile Number',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Mobile Number is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-type'=>"digits",
                     'data-parsley-minlength' => '10',
                     'data-parsley-maxlength' => '12']) !!}
                  </div>
                  @error('mobile_number')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::email('email', null, ['class' => 'form-control ','placeholder' => 'Email Address',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Email Address is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur"]) !!}
                  </div>
                  @error('email')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
               <div class="form-group">
                  {!! Form::file('profile_image', array('class' => 'form-control ','placeholder' => 'Profile Image',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",'data-parsley-maxlength' => '50')) !!}
                 </div> 
                  @error('profile_image')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('company_name', null, ['class' => 'form-control ','placeholder' => 'Company Name',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Company Name is required',
                     'data-parsley-pattern'=>"/^[a-zA-Z0-9 ]*$/",
                     'data-parsley-pattern-message' => 'Please enter only alphabets and numbers',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-minlength' => '10',
                     'data-parsley-maxlength' => '50']) !!}
                  </div>
                  @error('company_name')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('address', null, ['class' => 'form-control ','placeholder' => 'Company Address',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Company Address is required',
                     'data-parsley-pattern'=>"/^[a-zA-Z0-9 ]*$/",
                     'data-parsley-pattern-message' => 'Please enter only alphabets and numbers',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-minlength' => '10',
                     'data-parsley-maxlength' => '50']) !!}
                  </div>
                  @error('address')
                  <span class="text-danger errormsg" role="alert">
                  <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                        {!!Form::select('category[]', $categories, null, 
                        array('class'=>'form-control category', 'data-placeholder'=>'Select Category',
                        'multiple'=>'multiple','id'=>'category',
                        'data-parsley-required' => 'true',
                        'data-parsley-errors-container'=>'#categoryError',
                        'data-parsley-required-message' => 'Category is required')) !!}
                  </div>
                  @error('category')
                     <span class="text-danger errormsg" role="alert">
                        <p>{{ $message }}</p>
                     </span>
                  @enderror
                  <span id="categoryError"><span>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('state', null, ['class' => 'form-control ','placeholder' => 'Company State',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'State is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-maxlength' => '20']) !!}
                  </div>
                  @error('state')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('city', null, ['class' => 'form-control ','placeholder' => 'City',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'City is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-maxlength' => '20']) !!}
                  </div>
                  @error('city')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('pincode', null, ['class' => 'form-control ','placeholder' => 'Company Pincode',
                     'data-parsley-required' => 'true',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-type'=>"digits",
                     'data-parsley-minlength' => '6',
                     'data-parsley-maxlength' => '10']) !!}
                  </div>
                  @error('pincode')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('contact_number', null, ['class' => 'form-control ','placeholder' => 'Company Contact Number',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Company Contact Number is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-type'=>"digits",
                     'data-parsley-minlength' => '10',
                     'data-parsley-maxlength' => '12']) !!}
                  </div>
                  @error('contact_number')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('fax', null, ['class' => 'form-control ','placeholder' => 'Company Fax',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Company Fax is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-pattern'=>"^[\d\+\-\.\(\)\/\s]+$",
                     'data-parsley-maxlength' => '20']) !!}
                  </div>
                  @error('fax')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-12">
                  <div class="form-group">
                     {!! Form::text('website', null, ['class' => 'form-control ','placeholder' => 'Company Website URL',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-type'=>'url',
                     'data-parsley-maxlength' => '20']) !!}
                  </div>
                  @error('website')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row mt-4">
               <div class="col-sm-6">	
                {!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}
                  <a href="{{route('vendors.index')}}" class="btn btn-default">Cancel</a>
               </div>
               <div class="col-sm-6">
               </div>
            </div> 
         {!! Form::close() !!}
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
   $(function(){
         $('#category').select2({
               theme: 'bootstrap4'
         })
   });
</script>
@endsection