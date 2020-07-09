@extends('layouts.master')
@section('main-content')
<div class="col-12">
@if(session()->get('success'))
		    <div class="alert alert-success alert-dismissible" id="successMessage">
				<button type="button"  class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fa fa-check"></i>{{ Session::get('success') }}
			</div><br/>
  		 @endif
		 @if(session()->get('error'))
		    <div class="alert alert-danger alert-dismissible" id="errorMessage">
				<button type="button"  class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fa fa-check"></i>{{ Session::get('error') }}
			</div><br/>
  		 @endif
   <div class="card card-primary card-outline card-outline-tabs">
      <div class="card-header p-0 border-bottom-0">
         <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
               <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#myProfile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="true">My profile</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#company-detail" role="tab" aria-controls="custom-tabs-four-company-detail" aria-selected="false">Company detail</a>
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
            <form class="form-horizontal" method="post" action="{{ route('accounts.vendor.update', $vendor->id ) }}" data-parsley-validate="parsley"
            enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row">
                     <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="firstName" placeholder="First Name" name="first_name" value="{{$vendor->first_name}}"data-parsley-required="true" data-parsley-error-message="Please Enter First Name">
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
                        <input type="text" class="form-control" id="middle_name" placeholder="Middle Name" name="middle_name" value="{{$vendor->middle_name}}">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" value="{{$vendor->last_name}}" data-parsley-required="true" data-parsley-error-message="Please Enter Last Name">
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
                        <input type="text" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number" value="{{$vendor->mobile_number}}"data-parsley-required="true" data-parsley-type="digits">
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
                        <input type="text" class="form-control" id="email_address" placeholder="Email Address" name="email" value="{{$vendor->user->email}}"data-parsley-required="true" data-parsley-error-message="Please Enter Email Address ">
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
                        <input type="password" class="form-control" id="current_password" placeholder="Password" value="" name="current_password" data-parsley-required="true" data-parsley-error-message="Please Enter current password">
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
                        <input type="password" class="form-control" id="new_password" placeholder="New Password" value="" name="new_password" data-parsley-required="true" data-parsley-error-message="Please Enter new password">
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
               <form class="form-horizontal" method="post" action="{{ route('accounts.company.update', $vendor->id ) }}" data-parsley-validate="parsley">
                  @csrf
                  <div class="form-group row">
                     <label for="company_name" class="col-sm-2 col-form-label">Company Name</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name" value="{{$vendor->company->company_name}}" data-parsley-required="true" data-parsley-error-message="Please Enter Company name">
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
                        <input type="text" class="form-control" id="company_address" placeholder="Company Address" name="company_address" value="{{$vendor->company->address}}" data-parsley-required="true" data-parsley-error-message="Please Enter Company Address">
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
                        <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" value="{{$vendor->company->contact_number}}" data-parsley-type="digits" data-parsley-required="true">
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
                        <input type="text" class="form-control" id="state" placeholder="State" name="state" value="{{$vendor->company->state}}" data-parsley-required="true" data-parsley-error-message="Please Enter State">
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
                        <input type="text" class="form-control" id="city" placeholder="City" name="city" value="{{$vendor->company->city}}" data-parsley-required="true" data-parsley-error-message="Please Enter City">
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
                        <input type="text" class="form-control" id="pincode" placeholder="Pincode" name="pincode" value="{{$vendor->company->pincode}}"  data-parsley-required="true" data-parsley-error-message="Please Enter Pincode">
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
                        <td>{{$document->is_mandetory}}</td>
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
               <form class="form-horizontal" method="post" action="{{ route('accounts.contact.detail.store') }}" data-parsley-validate="parsley">
                  @csrf
                  <input type="hidden" name="vendor_id" value="{{$vendor->id}}"/>
                  <div class="form-group row">
                     <label for="name" class="col-sm-2 col-form-label">Name</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="" data-parsley-required="true" data-parsley-error-message="Please Enter  Name">
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
                        <input type="text" class="form-control" id="contact_number" placeholder="Phone Number" name="contact_number" data-parsley-type="digits" data-parsley-required="true" >
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
                        <input type="email" class="form-control" id="email_address" placeholder="Email Address" name="email_address" value="" data-parsley-required="true" data-parsley-error-message="Please Enter Email Address">
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
               </form>
            </div>
            <div class="tab-pane fade" id="bankDetail" role="tabpanel" aria-labelledby="custom-tabs-four-bank-detail-tab">
               <form class="form-horizontal" method="post" action="{{ route('accounts.bank.detail.store') }}" data-parsley-validate="parsley">
                  @csrf
                  <input type="hidden" name="vendor_id" value="{{$vendor->id}}"/>
                  <div class="form-group row">
                     <label for="bank_name" class="col-sm-2 col-form-label">Bank Name</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="bank_name" placeholder="Bank name" name="bank_name" value="" data-parsley-required="true" data-parsley-error-message="Please Enter Bank Name">
                        @error('account_holder_name')
                        <span class="text-danger errormsg" role="alert">
                           <p>{{ $message }}</p>
                        </span>
                        @enderror 
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="account_holder_name" class="col-sm-2 col-form-label">Account name</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="account_holder_name" placeholder="Account holder Name" name="account_holder_name" value="" data-parsley-required="true" data-parsley-error-message="Please Enter Account Holder Name">
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
                        <input type="text" class="form-control" id="account_number" placeholder="Account Number" name="account_number" value="" data-parsley-required="true" data-parsley-error-message="Please Enter Account Number ">
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
                        <input type="text" class="form-control" id="ifsc_code" placeholder="IFSC Code" name="ifsc_code" value="" data-parsley-required="true" data-parsley-error-message="Please Enter IFSC Code">
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
               </form>
            </div>
         </div>
      </div>
      <!-- /.card -->
   </div>
</div>
<form class="form-horizontal" method="post" action="{{route('accounts.document.store')}}" data-parsley-validate="parsley" enctype="multipart/form-data">
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
                  <span id="document-file"><span>
               </div>
               <div class="form-group mb-3">
                  <label>Reason</label>
                  <input type="text" class="form-control" placeholder="Enter Reason Detail" id="product_detail" name="product_detail">
                  <span class="text-danger error-product-detail" role="alert">
                  </span>
               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Upload</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
<form>
@endsection
@section('scripts')
<script type="text/javascript">
   $(document).ready(function() {
      $('body').on('click', '.uploadDocument', function () {
         var document_id = $(this).data('id');
         $('#documentFile').val(document_id);
      });
   });

   $(function(){
      setTimeout(function() {
         $('#successMessage').fadeOut('fast');
      }, 3000);     
  });
  $(function(){
      setTimeout(function() {
         $('#errorMessage').fadeOut('fast');
      }, 3000);     
  });
</script>
@endsection