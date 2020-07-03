@extends('layouts.master')
@section('main-content')
<!-- vendor Entries Column -->
<div class="col-md-12">
   <!-- Vendor user -->
   <div class="card mb-4">
      <div class="card-header">
         <h3 class="card-title">View Vendor</h3>
         <div class="float-right">
            <a class="btn btn-primary" href="{{ route('vendors.index') }}"> Back</a>
         </div>
      </div>
      <div class="card-body"> 
         <table class="table table-striped table-bordered" >
            <tbody>
               <tr>
                  <th>
                     First name  : 
                  </th>
                  <td>
                     <span>{{$vendor->first_name}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Middle name  : 
                  </th>
                  <td>
                     <span>@if(!empty($vendor->middle_name)){{$vendor->middle_name}}@endif</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Last name  : 
                  </th>
                  <td>
                     <span>{{$vendor->last_name}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Mobile number  : 
                  </th>
                  <td>
                     <span>{{$vendor->mobile_number}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Comapny name  : 
                  </th>
                  <td>
                     <span>{{$vendor->company->company_name }}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Comapny address  : 
                  </th>
                  <td>
                     <span>{{$vendor->company->address }}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Comapny state  : 
                  </th>
                  <td>
                     <span>{{$vendor->company->state}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Comapny city  : 
                  </th>
                  <td>
                     <span>{{$vendor->company->city}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Comapny pincode  : 
                  </th>
                  <td>
                     <span>{{$vendor->company->pincode}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Company Comapny number  : 
                  </th>
                  <td>
                     <span>{{$vendor->company->contact_number}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Category : 
                  </th>
                  <td>
                     <span>{{$vendor->vendorCategory->category->name}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Comapny website : 
                  </th>
                  <td>
                     <span>{{$vendor->company->website}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Verification status : 
                  </th>
                  @if($vendor->user->is_verified == "pending")
                  <td>
                     <span>pending</span>
                  </td>
                  @elseif($vendor->user->is_verified == "approved")
                  <td>
                     <span>Approved</span>
                  </td>
                  @else
                  <td>
                     <span>Rejected</span>
                  </td>
                  @endif
               </tr>
            <tbody>
         </table>     
      </div>
   </div>
</div>
@endsection