@extends('layouts.master')
@section('main-content')
<div class="col-md-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title">Create Vendor</h3>
      </div>
      <div class="card-body">
         <form class="form-horizontal" method="post" action="{{route('vendors.store')}}" data-parsley-validate="parsley" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" name="verify_status" value="Approved">
            <div class="row">
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="first_name" placeholder="First name" 
                        data-parsley-errors-container="#firstNameError" data-parsley-required="true" 
                        data-parsley-error-message="Please enter first name">
                  </div>
                  @error('first_name')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
                  <span id="firstNameError"><span>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="middle_name" placeholder="Middle name">
                  </div>
               </div>
               @error('middle_name')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
               @enderror
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="last_name" placeholder="Last name" 
                        data-parsley-errors-container="#lastNameError" data-parsley-required="true" 
                        data-parsley-error-message="Please enter last name" >
                  </div>
                  @error('last_name')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
                  <span id="lastNameError"><span>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="mobile_number" data-parsley-errors-container="#mobileNumberError" 
                        placeholder="Mobile number" data-parsley-required="true" data-parsley-type="digits">
                  </div>
                  @error('mobile_number')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
                  <span id="mobileNumberError"><span>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="email" class="form-control" name="email" placeholder="Email address" data-parsley-errors-container="#emailError" 
                        data-parsley-required="true" data-parsley-error-message="Please enter email address">
                  </div>
                  @error('email')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
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
                  <div class="form-group">
                     <input type="text" class="form-control" name="company_name" placeholder="Company name" data-parsley-errors-container="#companyNameError" 
                        data-parsley-required="true" data-parsley-error-message="Please enter company name">
                  </div>
                  @error('company_name')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
                  <span id="companyNameError"><span>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="address" placeholder="Company address" 
                        data-parsley-errors-container="#addressError" data-parsley-required="true" 
                        data-parsley-error-message="Please enter company address">
                  </div>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <select class="form-control" style="width: 100%;" name="category" id="category"
                        data-parsley-errors-container="#categoryError" data-parsley-required="true" 
                        data-parsley-error-message="Please select category">
                        <option value="">Select Category</option>
                        @forelse($categories as $category)
                        <option value="{{$category->id}}">{{ $category->name }}</option>
                        @empty
                        <option value="">No categories</option>
                        @endforelse
                     </select>
                     @error('category')
                     <span class="text-danger errormsg" role="alert">
                        <p>{{ $message }}</p>
                     </span>
                     @enderror
                     <span id="categoryError"><span>
                  </div>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="state" placeholder="Company state" 
                        data-parsley-errors-container="#stateError" data-parsley-required="true" 
                        data-parsley-error-message="Please enter state">
                  </div>
                  @error('state')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
                  <span id="stateError"><span>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="city" placeholder="Company city" data-parsley-errors-container="#cityError"
                        data-parsley-required="true" data-parsley-error-message="Please enter city">
                  </div>
                  @error('city')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
                  <span id="cityError"><span>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="pincode" placeholder="Company pincode" data-parsley-errors-container="#pincodeError" 
                        data-parsley-required="true" data-parsley-type="digits">
                  </div>
                  @error('pincode')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
                  <span id="pincodeError"><span>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="contact_number" placeholder="Company contact number" 
                        data-parsley-errors-container="#contactNoError" data-parsley-required="true" data-parsley-type="digits">
                  </div>
                  @error('contact_number')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
                  <span id="contactNoError"><span>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="fax" placeholder="Company fax" data-parsley-errors-container="#faxError" data-parsley-required="true" data-parsley-error-message="Please enter fax">
                  </div>
                  @error('fax')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
                  <span id="faxError"><span>
               </div>
               <div class= "col-sm-12">
                  <div class="form-group">
                     <input type="text" class="form-control" name="website" placeholder="Company website URL" data-parsley-errors-container="#websiteError" data-parsley-required="true"  data-parsley-type="url">
                  </div>
                  <span id="websiteError"><span>
                  @error('website')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row mt-4">
               <div class="col-sm-6">	
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{route('vendors.index')}}" class="btn btn-default">Cancel</a>
               </div>
               <div class="col-sm-6">	
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection