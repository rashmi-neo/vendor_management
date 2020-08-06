@extends('layouts.master')
@section('main-content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title">View New Requirement</h3>
      <div class="float-right">
            <a class="btn btn-primary" href="{{ route('new.requirement.index') }}"> Back</a>
         </div>
   </div>
   
   <div class="card-body">
      <table id="newRequirementTable" class="table table-bordered table-hover">
         <thead>
            <tr>
               <th>SrNo</th>
               <th>Title</th>
               <th>From Date</th>
               <th>To Date</th>
               <th width="200px">Category</th>
               <th>Proposal Document</th>
               <th>Budget</th>
               <th>Comment</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>{{$newRequirement->code}}</td>
               <td>{{$newRequirement->title}}</td>
               <td>{{$newRequirement->from_date}}</td>
               <td>{{$newRequirement->from_date}}</td>
               <td>
                  @foreach($category->vendorCategory as $cat)
                  <li>{{$cat->category->name}}</li>
                  @endforeach
               </td>
               <td>{{$newRequirement->proposal_document}}</td>
               <td>{{$newRequirement->budget}}</td>
               <td>{{empty($newRequirement->comment)?"-":$newRequirement->comment}}</td>

               <td><a href="{{ url('vendor/showQuotationDetail/'.$newRequirement->id.'/'.$assignVendor->id)}}"  rel="tooltip" title="Show Quotation Detail" class="view btn btn-secondary btn-sm viewQuotation">	<i class="fas fa-file"></i></a>&nbsp;</td>
            </tr>
         </tbody>
      </table>
   </div>
</div>
@endsection