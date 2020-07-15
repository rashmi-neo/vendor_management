@extends('layouts.master')
@section('main-content')
<!-- vendor Entries Column -->
<div class="col-md-12">
   <!-- Vendor user -->
   <div class="card mb-4">
      <div class="card-header">
         <h3 class="card-title">View New Requirement</h3>
         <div class="float-right">
            <a class="btn btn-primary" href="{{ route('new.requirement.index') }}"> Back</a>
         </div>
      </div>
      <div class="card-body"> 
         <table class="table table-striped table-bordered" >
            <tbody>
               <tr>
                  <th>
                     Title  : 
                  </th>
                  <td>
                     <span>{{$newRequirement->title}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                    Category  : 
                  </th>
                  <td>
                     <span>{{$category->vendorCategory->category->name}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                    Priority  :
                  </th>
                  <td>
                     <span> {{$newRequirement->priority}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                    Status  :
                  </th>
                  <td>
                     <span>{{$newRequirement->status}}</span>
                  </td>
               </tr>
            <tbody>
         </table>     
      </div>
   </div>
</div>
@endsection