@extends('layouts.master')
@section('main-content')
<div class="col-md-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title">Edit Vendor</h3>
      </div>
      <div class="card-body">
         {!! Form::model($vendor,['route' =>  ['vendors.update', $vendor->id],'class' => 'form-horizontal',
            'method' => 'put','data-parsley-validate' => 'parsley','enctype' =>'multipart/form-data']) !!}
            @csrf
            <input type="hidden" class="form-control" name="verify_status" value="Approved">
            <input type="hidden" name="user_id" value="{{$vendor->user_id}}"/>
            <div class="row">
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('first_name', $vendor->first_name, ['class' => 'form-control ','placeholder' => 'First Name',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'First name is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-pattern'=>"^[a-zA-Z]+$",
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
                     {!! Form::text('middle_name', $vendor->middle_name, ['class' => 'form-control ','placeholder' => 'Middle Name',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-pattern'=>"^[a-zA-Z]+$",
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
                     {!! Form::text('last_name', $vendor->last_name, ['class' => 'form-control ','placeholder' => 'Last Name',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Last name is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-pattern'=>"^[a-zA-Z]+$",
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
                     {!! Form::text('mobile_number', $vendor->mobile_number, ['class' => 'form-control ','placeholder' => 'Mobile Number',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Mobile Number is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-type'=>"digits",
                     'data-parsley-maxlength' => '20']) !!}
                  </div>
                  @error('mobile_number')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::email('email', $vendor->user->email, ['class' => 'form-control ','placeholder' => 'Email Address',
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
               {!! Form::file('profile_image', array('class' => 'form-control ','placeholder' => 'Profile Image')) !!}
                 </div> 
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('company_name', $vendor->company->company_name, ['class' => 'form-control ','placeholder' => 'Company Name',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Company Name is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
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
                     {!! Form::text('address', $vendor->company->address, ['class' => 'form-control ','placeholder' => 'Company Address',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Company Address is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-maxlength' => '50']) !!}
                  </div>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!!Form::select('category[]', $categories, $categoryId, 
                     array('class'=>'form-control', 'placeholder'=>'Select Category',
                     'multiple'=>'multiple','id'=>'category',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Category is required')) !!}
                     @error('category')
                     <span class="text-danger errormsg" role="alert">
                        <p>{{ $message }}</p>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('state', $vendor->company->state, ['class' => 'form-control ','placeholder' => 'Company State',
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
                     {!! Form::text('city', $vendor->company->city, ['class' => 'form-control ','placeholder' => 'City',
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
                     {!! Form::text('pincode', $vendor->company->pincode, ['class' => 'form-control ','placeholder' => 'Company Pincode',
                     'data-parsley-required' => 'true',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-type'=>"digits",
                     'data-parsley-maxlength' => '20']) !!}
                  </div>
                  @error('pincode')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('contact_number', $vendor->company->contact_number, ['class' => 'form-control ','placeholder' => 'Company Contact Number',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Company Contact Number is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-type'=>"digits",
                     'data-parsley-maxlength' => '20']) !!}
                  </div>
                  @error('contact_number')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('fax', $vendor->company->fax, ['class' => 'form-control ','placeholder' => 'Company Fax',
                     'data-parsley-required' => 'true',
                     'data-parsley-required-message' => 'Company Fax is required',
                     'data-parsley-trigger' => "input",
                     'data-parsley-trigger'=>"blur",
                     'data-parsley-maxlength' => '20']) !!}
                  </div>
                  @error('fax')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     {!! Form::text('website', $vendor->company->website, ['class' => 'form-control ','placeholder' => 'Company Website URL',
                     'data-parsley-required' => 'true',
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
               <div class= "col-sm-6">
                  <div class="form-group">
                     <select class="form-control" style="width: 100%;" name="verify_status" id="status"
                        data-parsley-errors-container="#statusError" data-parsley-required="true"
                        data-parsley-error-message="Please select verification status">
                        <option value="">Select Verification status</option>
                        <option value="pending"@if($vendor->user->is_verified == "pending") selected="selected" @endif>Pending</option>
                        <option value="approved"@if($vendor->user->is_verified == "approved") selected="selected" @endif>Approved</option>
                        <option value="rejected"@if($vendor->user->is_verified == "rejected") selected="selected" @endif>Rejected</option>
                     </select>
                     @error('verify_status')
                     <span class="text-danger errormsg" role="alert">
                        <p>{{ $message }}</p>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class= "col-sm-6">
                  <div class="form-group">
                     <img src="{{asset('/uploads/images/'.$vendor->profile_image)}}" class="profile-image" alt="profile Image" height= "100px" height= "100px">
                  </div>
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