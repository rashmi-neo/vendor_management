@extends('layouts.master')
@section('main-content')
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
                     <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                     <div class="col-sm-8">
                        {!! Form::text('first_name', null, ['class' => 'form-control ','placeholder' => 'First Name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'First name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"^[a-zA-Z]+$",
                        'data-parsley-maxlength' => '50']) !!}
                        @error('first_name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="middleName" class="col-sm-2 col-form-label">Middle Name</label>
                     <div class="col-sm-8">
                        {!! Form::text('middle_name', $vendor->middle_name, ['class' => 'form-control ','placeholder' => 'Middle Name',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"^[a-zA-Z]+$",
                        'data-parsley-maxlength' => '50']) !!}
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                     <div class="col-sm-8">
                        {!! Form::text('last_name', $vendor->last_name, ['class' => 'form-control ','placeholder' => 'Last Name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Last name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"^[a-zA-Z]+$",
                        'data-parsley-maxlength' => '50']) !!}
                        
                        @error('last_name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                     <div class="col-sm-8">
                        {!! Form::text('phone_number', $vendor->mobile_number, ['class' => 'form-control ','placeholder' => 'Phone Number',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Mobile Number is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-type'=>"digits",
                        'data-parsley-maxlength' => '20']) !!}
                        
                        @error('phone_number')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="email_address" class="col-sm-2 col-form-label">Email Address</label>
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
                     <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
                     <div class="col-sm-8">
                        {!! Form::password('current_password', ['class' => 'form-control ','placeholder' => 'Current Password',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Password is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-maxlength' => '100']) !!}
                     
                        @error('current_password')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                     <div class="col-sm-8">
                        {!! Form::password('new_password',array('class' => 'form-control','placeholder' => 'New  Password',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'New Password is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-maxlength' => '100')) !!}
                        
                        @error('new_password')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="image" class="col-sm-2 col-form-label">Upload Image</label>
                     <div class="col-sm-8">
                        {!! Form::file('profile_image', array('class' => 'form-control ','placeholder' => 'Profile Image')) !!}
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-2"></div>
                     <div class="col-sm-6">	
                        <button type="submit" class="btn btn-primary">Update</button>
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
                     <label for="company_name" class="col-sm-2 col-form-label">Company Name</label>
                     <div class="col-sm-8">
                        {!! Form::text('company_name', $vendor->company->company_name, ['class' => 'form-control ',
                        'placeholder' => 'Company Name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Company name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-maxlength' => '50']) !!}
                        
                        @error('company_name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="company_address" class="col-sm-2 col-form-label">Company Address</label>
                     <div class="col-sm-8">
                        {!! Form::text('company_address', $vendor->company->address, ['class' => 'form-control ',
                        'placeholder' => 'Company Address',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Company address is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-maxlength' => '50']) !!}
                        
                        @error('company_address')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="contact_number" class="col-sm-2 col-form-label">Contact Number</label>
                     <div class="col-sm-8">
                        {!! Form::text('contact_number', $vendor->company->contact_number, ['class' => 'form-control ',
                        'placeholder' => 'Company Contact Number',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Company contact number is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-type'=>"digits",
                        'data-parsley-maxlength' => '20']) !!}
                        
                        @error('contact_number')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="state" class="col-sm-2 col-form-label">State</label>
                     <div class="col-sm-8">
                        {!! Form::text('state', $vendor->company->state, ['class' => 'form-control ',
                        'placeholder' => 'state',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'State is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"^[a-zA-Z]+$",
                        'data-parsley-maxlength' => '20']) !!}
                        
                        @error('state')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="city" class="col-sm-2 col-form-label">City</label>
                     <div class="col-sm-8">
                        {!! Form::text('city', $vendor->company->city, ['class' => 'form-control ',
                        'placeholder' => 'City',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'City is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-pattern'=>"^[a-zA-Z]+$",
                        'data-parsley-maxlength' => '20']) !!}
                        
                        @error('city')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="pincode" class="col-sm-2 col-form-label">Pincode</label>
                     <div class="col-sm-8">
                        {!! Form::text('pincode', $vendor->company->pincode, ['class' => 'form-control ',
                        'placeholder' => 'Pincode',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Pincode is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-type'=>"digits",
                        'data-parsley-maxlength' => '20']) !!}
                        
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
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('accounts.index')}}" class="btn btn-default">Cancel</a>
                     </div>
                  </div>
               </form>
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
                        <td>{{ucfirst($document->is_mandetory)}}</td>
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
                     <label for="name" class="col-sm-2 col-form-label">Name</label>
                     <div class="col-sm-8">
                        {!! Form::text('name', null, ['class' => 'form-control ','placeholder' => 'Name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-maxlength' => '50']) !!}

                        @error('name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                     <div class="col-sm-8">
                        {!! Form::text('contact_number', null, ['class' => 'form-control ','placeholder' => 'Phone Number',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Contact number is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-type' =>"digits",
                        'data-parsley-maxlength' => '50']) !!}
                        @error('contact_number')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="email_address" class="col-sm-2 col-form-label">Email Address</label>
                     <div class="col-sm-8">
                        {!! Form::email('email_address', null, ['class' => 'form-control ','placeholder' => 'Email Address',
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
                        <button type="submit" class="btn btn-primary">Save</button>
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
                     <label for="bank_name" class="col-sm-2 col-form-label">Bank Name</label>
                     <div class="col-sm-8">
                        {!! Form::text('bank_name', null, ['class' => 'form-control ','placeholder' => 'Bank Name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Bank name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-maxlength' => '50']) !!}
                        @error('bank_name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror 
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="account_holder_name" class="col-sm-2 col-form-label">Account name</label>
                     <div class="col-sm-8">
                        {!! Form::text('account_holder_name', null, ['class' => 'form-control ','placeholder' => 'Account Holder Name',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Account holder name is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-maxlength' => '50']) !!}
                       
                        @error('account_holder_name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="account_number" class="col-sm-2 col-form-label">Account Number</label>
                     <div class="col-sm-8">
                        {!! Form::text('account_number', null, ['class' => 'form-control ','placeholder' => 'Account Number',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'Account number is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-type'=>"digits",
                        'data-parsley-maxlength' => '50']) !!}
                       
                        @error('account_number')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="ifsc_code" class="col-sm-2 col-form-label">IFSC code</label>
                     <div class="col-sm-8">
                        {!! Form::text('ifsc_code', null, ['class' => 'form-control ','placeholder' => 'IFSC Code',
                        'data-parsley-required' => 'true',
                        'data-parsley-required-message' => 'IFSC code is required',
                        'data-parsley-trigger' => "input",
                        'data-parsley-trigger'=>"blur",
                        'data-parsley-maxlength' => '50']) !!}
                        
                        @error('ifsc_code')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-2"></div>
                     <div class="col-sm-6">	
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{route('accounts.index')}}" class="btn btn-default">Cancel</a>
                     </div>
                  </div>
               {!! Form::close() !!}
            </div>
         </div>
      </div>
      <!-- /.card -->
   </div>
</div>

<form class="form-horizontal" id="documentForm" method="post" action="{{route('accounts.document.store')}}" data-parsley-validate="parsley" enctype="multipart/form-data">
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
                  <label>Document:</label>
                  <div class="input-group  mb-3">
                     <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="fileName" data-parsley-errors-container="#document-file" 
                           data-parsley-required="true" data-parsley-error-message="Please upload file">
                        <label class="custom-file-label" for="profileImage">Choose file</label>
                     </div>
                     <div class="input-group-append">
                        <span class="input-group-text" id="">Upload Document</span>
                     </div>
                  </div>
                  @error('file')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
               <div class="form-group mb-3">
                  <label>Reason</label>
                  <input type="text" class="form-control" placeholder="Enter Reason Detail" id="reason" name="product_detail">
               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" id="saveDocument" class="btn btn-primary">Upload</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
<form>
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
      
      $('#custom-tabs-four-tab a[href="#{{ old('tab') }}"]').tab('show')

   });
</script>

@endsection