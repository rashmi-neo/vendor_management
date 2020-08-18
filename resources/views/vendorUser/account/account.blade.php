@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">My Account</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
			   <li class="breadcrumb-item"><a href="{{url('vendor/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">My Account</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="col-12">
   <div class="card card-primary card-outline card-outline-tabs">
      <div class="card-header p-0 border-bottom-0">
         <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
               <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#myProfile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="true">My profile</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#company-detail" role="tab" aria-controls="custom-tabs-four-company-detail" aria-selected="false">Company details</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="custom-tabs-four-document-tab" data-toggle="pill" href="#document" role="tab" aria-controls="custom-tabs-four-document" aria-selected="false">Documents</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="custom-tabs-four-support-contact-tab" data-toggle="pill" href="#supportContactDetail" role="tab" aria-controls="custom-tabs-four-contact-detail" aria-selected="false">Support contact details</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="custom-tabs-four-bank-detail-tab" data-toggle="pill" href="#bankDetail" role="tab" aria-controls="custom-tabs-bank-detail" aria-selected="false">Bank details</a>
            </li>
         </ul>
      </div>
      <div class="card-body">
         <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade active show" id="myProfile" role="tabpanel" aria-labelledby="custom-tabs-profile-tab">
               {!! Form::model($vendor,['route' =>  ['accounts.vendor.update', $vendor->id],'class' => 'form-horizontal',
               'method' => 'post','data-parsley-validate' => 'parsley','enctype' =>'multipart/form-data']) !!}
                  @csrf
                  <input type="hidden" name="user_id" value="{{$vendor->user_id}}"/>

                  <div class="form-group row">
                     {!! Form::label('firstName','First Name :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('first_name', null, ['class' => 'form-control ','placeholder' => 'First Name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'First name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"^[a-zA-Z]+$",
                        'data-parsley-pattern-message' => 'Please enter only alphabets',
                        'data-parsley-minlength' => '2',
                        'data-parsley-maxlength' => '50']) !!}
                        @error('first_name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     {!! Form::label('middleName','Middle Name :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('middle_name', $vendor->middle_name, ['class' => 'form-control ','placeholder' => 'Middle Name',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"^[a-zA-Z]+$",
                        'data-parsley-pattern-message' => 'Please enter only alphabets',
                        'data-parsley-minlength' => '2',
                        'data-parsley-maxlength' => '50']) !!}
                     </div>
                  </div>
                  <div class="form-group row">
                     {!! Form::label('lastName','Last Name :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('last_name', $vendor->last_name, ['class' => 'form-control ','placeholder' => 'Last Name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Last name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"^[a-zA-Z]+$",
                        'data-parsley-pattern-message' => 'Please enter only alphabets',
                        'data-parsley-minlength' => '2',
                        'data-parsley-maxlength' => '50']) !!}
                        
                        @error('last_name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     {!! Form::label('phone_number','Phone Number :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('phone_number', $vendor->mobile_number, ['class' => 'form-control ','placeholder' => 'Phone Number',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Mobile Number is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-type'=>"digits",
                        'data-parsley-minlength' => '10',
                        'data-parsley-maxlength' => '12']) !!}
                        
                        @error('phone_number')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     {!! Form::label('email_address','Email Address :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::email('email', $vendor->user->email, ['class' => 'form-control ','placeholder' => 'Email Address',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Email Address is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur"]) !!}
                        
                        @error('email')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     {!! Form::label('current_password','Current Password :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::password('current_password', ['class' => 'form-control ','placeholder' => 'Current Password','id' => 'current_password',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Password is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-minlength' => '6',
                        'data-parsley-maxlength' => '8']) !!}
                        @error('current_password')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     {!! Form::label('new_password','New Password :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::password('new_password',array('class' => 'form-control','placeholder' => 'New  Password','id' => 'new_password',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'New Password is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-minlength' => '6',
                        'data-parsley-maxlength' => '8')) !!}
                        
                        @error('new_password')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     {!! Form::label('image','Upload Image :',['class'=>"col-sm-2 col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::file('profile_image', array('class' => 'form-control ',
                           'placeholder' => 'Profile Image','id' => 'profile_image',
                           'data-parsley-trigger' => "input",
                           'data-parsley-fileextension'=>'jpg,png,jpeg',
                           'data-parsley-trigger'=>"blur",
                           'data-parsley-maxlength' => '1000')) !!}
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-2"></div>
                     <div class="col-sm-6">
                        {!! Form::button('Update', ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}
                        <a href="{{route('accounts.index')}}" class="btn btn-default">Cancel</a>
                     </div>
                  </div>
               </form>
            </div>
            <div class="tab-pane fade" id="company-detail" role="tabpanel" aria-labelledby="custom-tabs-four-company-detail-tab">
               {!! Form::model($vendor,['route' =>  ['accounts.company.update', $vendor->id],'class' => 'form-horizontal',
               'method' => 'post','data-parsley-validate' => 'parsley']) !!}
                  @csrf
                  <input type="hidden" name="tab" value="company-detail">
                  <div class="form-group row">
                  {!! Form::label('company_name','Company Name :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('company_name', $vendor->company->company_name, ['class' => 'form-control ',
                        'placeholder' => 'Company Name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Company name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-minlength' => '5',
                        'data-parsley-maxlength' => '50']) !!}
                        
                        @error('company_name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                  {!! Form::label('company_address','Company Address :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('company_address', $vendor->company->address, ['class' => 'form-control ',
                        'placeholder' => 'Company Address',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Company address is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-minlength' => '5',
                        'data-parsley-maxlength' => '50']) !!}
                        
                        @error('company_address')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                  {!! Form::label('contact_number','Contact Number :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('contact_number', $vendor->company->contact_number, ['class' => 'form-control ',
                        'placeholder' => 'Company Contact Number',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Company contact number is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-type'=>"digits",
                        'data-parsley-minlength' => '10',
                        'data-parsley-maxlength' => '12']) !!}
                        
                        @error('contact_number')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                  {!! Form::label('state','State :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('state', $vendor->company->state, ['class' => 'form-control ',
                        'placeholder' => 'state',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'State is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"^[a-zA-Z]+$",
                        'data-parsley-pattern-message' => 'Please enter only alphabets',
                        'data-parsley-maxlength' => '20']) !!}
                        
                        @error('state')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                  {!! Form::label('city','City :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('city', $vendor->company->city, ['class' => 'form-control ',
                        'placeholder' => 'City',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'City is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"^[a-zA-Z]+$",
                        'data-parsley-pattern-message' => 'Please enter only alphabets',
                        'data-parsley-maxlength' => '20']) !!}
                        
                        @error('city')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     {!! Form::label('pincode','Pincode :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('pincode', $vendor->company->pincode, ['class' => 'form-control ',
                        'placeholder' => 'Pincode',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Pincode is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-type'=>"digits",
                        'data-parsley-minlength' => '6',
                        'data-parsley-maxlength' => '10']) !!}
                        
                        @error('pincode')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-2"></div>
                     <div class="col-sm-6">	
                        {!! Form::button('Update', ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}
                        <a href="{{route('accounts.index')}}" class="btn btn-default">Cancel</a>
                     </div>
                  </div>
               {!! Form::close() !!}
            </div>
            <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="custom-tabs-four-document-tab">
               <table id="accountTable" class="table table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>Document Name</th>
                        <th>Mandatory</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($documents as $document)
                     <tr>
                        <td>{{$document->name}}</td>
                        <td>{{ucfirst($document->is_mandatory)}}</td>
                        <td>{{isset($document->vendorDocument->status)?$document->vendorDocument->status:"-"}}</td>
                        <td>{{isset($document->vendorDocument->file_name)?$document->vendorDocument->file_name:"-"}}</td>
                      
                       @if(!empty($document->vendorDocument->file_name))
                       <td>
                           <a href="#" class="btn btn-primary btn-sm ml-5">
                           <i class="fas fa-check-circle"></i></a>&nbsp;
                        </td>
                        @else
                        <td>Upload
                           <a href="#" data-id="{{$document->id}}" class="uploadDocument btn btn-primary btn-sm" 
                              data-toggle="modal" data-target="#uploadDocument" rel="tooltip" title="Upload">
                           <i class="fas fa-upload"></i></a>&nbsp;
                        </td>
                        @endif
                        @endforeach
                  </tbody>
               </table>
            </div>
            <div class="tab-pane fade" id="supportContactDetail" role="tabpanel" aria-labelledby="custom-tabs-four-support-contact-tab">
               {!! Form::open(['route' => 'accounts.contact.detail.store','class' => 'form-horizontal',
               'method' => 'post','data-parsley-validate' => 'parsley','enctype' =>'multipart/form-data']) !!}
                 @csrf
                  <input type="hidden" name="tab" value="supportContactDetail">
                  <input type="hidden" name="vendor_id" value="{{$vendor->id}}"/>
                  <div class="form-group row">
                  {!! Form::label('name','Name :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('name', null, ['class' => 'form-control ','placeholder' => 'Name','id' => 'contact_name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"/^[a-zA-Z ]*$/",
                        'data-parsley-pattern-message' => 'Please enter only alphabets',
                        'data-parsley-minlength' => '2',
                        'data-parsley-maxlength' => '50']) !!}

                        @error('name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                  {!! Form::label('phone_number','Phone Number :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('contact_number', null, ['class' => 'form-control ','placeholder' => 'Phone Number','id' => 'mobile_number',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Contact number is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-type' =>"digits",
                        'data-parsley-minlength' => '10',
                        'data-parsley-maxlength' => '12']) !!}
                        @error('contact_number')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                  {!! Form::label('email_address','Email Address :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::email('email_address', null, ['class' => 'form-control ','placeholder' => 'Email Address','id' => 'email_address',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Email address is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-maxlength' => '200']) !!}
                        @error('email_address')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-2"></div>
                     <div class="col-sm-6">
                        {!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}
                        <a href="{{route('accounts.index')}}" class="btn btn-default">Cancel</a>
                     </div>
                  </div>
               {!! Form::close() !!}
            </div>
            <div class="tab-pane fade" id="bankDetail" role="tabpanel" aria-labelledby="custom-tabs-four-bank-detail-tab">
               {!! Form::open(['route' => 'accounts.bank.detail.store','class' => 'form-horizontal',
               'method' => 'post','data-parsley-validate' => 'parsley','enctype' =>'multipart/form-data']) !!}
               @csrf
                  <input type="hidden" name="vendor_id" value="{{$vendor->id}}"/>
                  <input type="hidden" name="tab" value="bankDetail">
                  <div class="form-group row">
                  {!! Form::label('bank_name','Bank Name :',['class'=>"col-sm-3 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('bank_name', null, ['class' => 'form-control ','placeholder' => 'Bank Name','id' => 'bank_name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Bank name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"/^[a-zA-Z ]*$/",
                        'data-parsley-pattern-message' => 'Please enter only alphabets',
                        'data-parsley-minlength' => '3',
                        'data-parsley-maxlength' => '50']) !!}
                        @error('bank_name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror 
                     </div>
                  </div>
                  <div class="form-group row">
                  {!! Form::label('account_holder_name','Account Holder Name :',['class'=>"col-sm-3 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('account_holder_name', null, ['class' => 'form-control ','placeholder' => 'Account Holder Name','id' => 'account_holder_name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Account holder name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-pattern'=>"/^[a-zA-Z ]*$/",
                        'data-parsley-pattern-message' => 'Please enter only alphabets',
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-minlength' => '2',
                        'data-parsley-maxlength' => '50']) !!}
                       
                        @error('account_holder_name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                  {!! Form::label('account_number','Account Number :',['class'=>"col-sm-3 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('account_number', null, ['class' => 'form-control ','placeholder' => 'Account Number','id' => 'account_number',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Account number is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-type'=>"digits",
                        'data-parsley-minlength' => '9',
                        'data-parsley-maxlength' => '50']) !!}
                       
                        @error('account_number')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                  {!! Form::label('ifsc_code','IFSC Code :',['class'=>"col-sm-3 required col-form-label"],false) !!} 
                     <div class="col-sm-8">
                        {!! Form::text('ifsc_code', null, ['class' => 'form-control ','placeholder' => 'IFSC Code','id' => 'ifsc_code',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'IFSC code is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-pattern'=>"^[a-zA-Z0-9]*$",
                        'data-parsley-pattern-message' => 'Please enter only alphabets and numbers',
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-minlength' => '11','data-parsley-maxlength' => '11']) !!}
                        
                        @error('ifsc_code')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-3"></div>
                     <div class="col-sm-6">
                        {!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}
                        <a href="{{route('accounts.index')}}" class="btn btn-default cancel">Cancel</a>
                     </div>
                  </div>
               {!! Form::close() !!}
            </div>
         </div>
      </div>
      <!-- /.card -->
   </div>
</div>

{!! Form::open(['route' => 'accounts.document.store','class' => 'form-horizontal','id' => 'documentForm',
'method' => 'post','data-parsley-validate' => 'parsley','enctype' =>'multipart/form-data']) !!}
   @csrf
   <div class="modal fade" id="uploadDocument"aria-modal="true">
      <input type="hidden" name="vendor_id" value="{{$vendor->id}}"/>
      <input type="hidden" id="documentFile" name="document_id" value=""/>
      <div class="modal-dialog modal-md">
         <div class="modal-content">
            <div class="modal-header headerModal">
               <h4 class="modal-title">Upload Document</h4>
               <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group mb-3">
               {!! Form::label('document','Document:',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                  {!! Form::file('file', array('class' => 'form-control','id' => 'document','placeholder' => 'Document',
                  'data-parsley-required' => 'true',
                  'data-parsley-trigger' => "input",
                  'data-parsley-trigger'=>"blur",
                  'data-parsley-required-message' => 'Please upload document',
                  'data-parsley-extension'=>'pdf,doc,docx')) !!}
               
                  @error('file')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               {!! Form::button('Upload', ['type' => 'submit','id'=>'saveDocument','class' => 'btn btn-primary'] ) !!}
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
{!! Form::close() !!}

@endsection
@section('scripts')

@if($errors->has('file'))
<script>
   $(document).ready(function(){
      $('#uploadDocument').modal({show: true});
   });
</script>
@endif
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
<script type="text/javascript">
   $(document).ready(function() {
      $('body').on('click', '.uploadDocument', function () {
         var document_id = $(this).data('id');
         $('#documentFile').val(document_id);
      });
      $('#custom-tabs-four-tab a[href="#{{ old('tab') }}"]').tab('show');

      $("#documentForm").parsley();

      $('#uploadDocument').on('hidden.bs.modal', function() {
      
         $('input[type="file"]').val("");
         $('.parsley-required').empty();
         $('.parsley-extension').empty();
         $('.errormsg').empty('');
         $('.parsley-success').removeClass('parsley-success');
         $('.parsley-error').removeClass('parsley-error');
      });

      $('.nav-link').on('click', function() {
         
         $('#current_password').val("");
         $('#new_password').val("");
         $('#profile_image').val("");
         $('.parsley-fileextension').empty();
         $('#contact_name').val("");
         $('#mobile_number').val("");
         $('#email_address').val("");
         $('#bank_name').val("");
         $('#account_holder_name').val("");
         $('#account_number').val("");
         $('#ifsc_code').val("");
         $('.parsley-minlength').empty();
         $('.parsley-required').empty();
         $('.errormsg').empty('');
         $('.parsley-success').removeClass('parsley-success');
         $('.parsley-error').removeClass('parsley-error');
         $('.parsley-pattern').removeClass('parsley-pattern');
         $('.parsley-type').empty();
         $('.parsley-minlength').empty();
         $('.parsley-maxlength').empty();
      });
   });
   $(document).ready(function() {
    $("#vendorForm").parsley();

    window.ParsleyValidator.addValidator('extension', function (value, requirement) {
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
    .addMessage('en', 'extension', 'The extension should be pdf,doc,docx');
});

</script>

@endsection