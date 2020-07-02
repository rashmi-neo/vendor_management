@extends('layouts.master')
@section('main-content')
<div class="col-md-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title">Edit Vendor</h3>
      </div>
      <div class="card-body">
         <form class="form-horizontal" method="post" action="{{route('vendors.update',$vendor->id)}}" data-parsley-validate="parsley" enctype="multipart/form-data">
            @csrf
				 @method('PUT')
            <input type="hidden" class="form-control" name="verify_status" value="1">
            <div class="row">
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="first_name" placeholder="First name" 
                        data-parsley-errors-container="#firstNameError" data-parsley-required="true" 
                        data-parsley-error-message="Please enter first name" value="{{$vendor->first_name}}">
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
                     <input type="text" class="form-control" name="middle_name" placeholder="Middle name" value="{{$vendor->middle_name}}">
                  </div>
                  @error('middle_name')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
               
                  <div class="form-group">
                     <input type="text" class="form-control" name="last_name" placeholder="Last name" 
                        data-parsley-errors-container="#lastNameError" data-parsley-required="true" 
                        data-parsley-error-message="Please enter last name" value="{{$vendor->last_name}}">
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
                        placeholder="Mobile number" data-parsley-required="true" data-parsley-type="digits" value="{{$vendor->mobile_number}}">
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
                        data-parsley-required="true" data-parsley-error-message="Please enter email address" value="{{$vendor->user->email}}">
                  </div>
                  @error('email')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
                  <span id="emailError"><span>
               </div>
            
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="company_name" placeholder="Company name" data-parsley-errors-container="#companyNameError" 
                        data-parsley-required="true" data-parsley-error-message="Please enter company name"  value="{{$vendor->company->company_name}}">
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
                        data-parsley-error-message="Please enter company address"  value="{{$vendor->company->address}}">
                  </div>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <select class="form-control" style="width: 100%;" name="category" id="category"
                        data-parsley-errors-container="#categoryError" data-parsley-required="true" 
                        data-parsley-error-message="Please enter category">
                        <option value="">Select Category</option>
                        @forelse($categories as $category)replies
                        <option value="{{$category->id}}"@if($vendor->vendorCategory->category_id == $category->id) selected="selected" @endif>{{ $category->name }}</option>
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
                        data-parsley-error-message="Please enter state"  value="{{$vendor->company->state}}">
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
                        data-parsley-required="true" data-parsley-error-message="Please enter city" value="{{$vendor->company->city}}">
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
                        data-parsley-required="true" data-parsley-type="digits" value="{{$vendor->company->pincode}}">
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
                        data-parsley-errors-container="#contactNoError" data-parsley-required="true" data-parsley-type="digits" value="{{$vendor->company->contact_number}}">
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
                     <input type="text" class="form-control" name="fax" placeholder="Company fax" data-parsley-errors-container="#faxError" 
                     data-parsley-required="true" data-parsley-error-message="Please enter fax" value="{{$vendor->company->fax}}">
                  </div>
                  @error('fax')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
                  <span id="faxError"><span>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="text" class="form-control" name="website" placeholder="Company website URL" 
                     data-parsley-errors-container="#websiteError" data-parsley-required="true"  data-parsley-type="url" value="{{$vendor->company->website}}">
                  </div>
                  <span id="websiteError"><span>
                  @error('website')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <select class="form-control" style="width: 100%;" name="verify_status" id="status"
                        data-parsley-errors-container="#statusError" data-parsley-required="true" 
                        data-parsley-error-message="Please select verification status">
                        <option value="">Select Verification status</option>
                        <option value="0"@if($vendor->user->is_verified == 0) selected="selected" @endif>Pending</option>
                        <option value="1"@if($vendor->user->is_verified == 1) selected="selected" @endif>Approved</option>
                     </select>
                     @error('category')
                     <span class="text-danger errormsg" role="alert">
                        <p>{{ $message }}</p>
                     </span>
                     @enderror
                     <span id="statusError"><span>
                  </div>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <input type="file" class="form-control"placeholder="Profile image" name="profile_image" value="{{$vendor->profile_image}}">
                  </div>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <img src="{{asset('/storage/images/'.$vendor->profile_image)}}" class="profile-image" alt="profile Image" height= "100px" height= "100px">
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-6">	
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{route('vendors.index')}}" class="btn btn-default">Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection