@extends('layouts.master')
@section('main-content')
<!-- vendor Entries Column -->
<div class="col-md-12">
   <!-- Vendor user -->
   <div class="card mb-4">
      <div class="card-header">
         <h3 class="card-title">View Vendor</h3>
      </div>
      <div class="card-body">
         <p class="card-text"><strong>Vendor Name :</strong>  {{$vendor->first_name. ' ' .$vendor->last_name }}</p>
         <p class="card-text"><strong>Category : </strong> {{$vendor->vendorCategory->category->name}}</p>
         <p class="card-text"><strong>Company Name : </strong> {{$vendor->company->company_name  }}</p>
         <p class="card-text"><strong>Company Address : </strong> {{$vendor->company->address  }}</p>
         <p class="card-text"><strong>Contact Number : </strong>{{$vendor->company->contact_number }}</p>
         @if($vendor->user->is_verified == 1)
            <p class="card-text"><strong>Verification status : </strong> Approved</p>
         @else
            <p class="card-text"><strong>Verification status : </strong> Pending</p>
         @endif
      </div>
      <div class="card-footer text-muted">
         <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('vendors.index') }}"> Back</a>
         </div>
      </div>
   </div>
</div>
@endsection