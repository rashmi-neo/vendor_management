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
         <p class="card-text">Name : {{$vendor->first_name. ' ' .$vendor->last_name }}</p>
         <p class="card-text">Category : {{$vendor->vendorCategory->category->name}}</p>
         <p class="card-text">Company Name : {{$vendor->company->company_name  }}</p>
         <p class="card-text">Contact Number : {{$vendor->company->contact_number }}</p>
      </div>
      <div class="card-footer text-muted">
         <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('vendors.index') }}"> Back</a>
         </div>
      </div>
   </div>
</div>
@endsection