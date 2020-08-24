@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark"> View Past Requirements</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
      		<li class="breadcrumb-item"><a href="{{url('vendor/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('new.requirement.index') }}">New Requirement</a></li>
            <li class="breadcrumb-item active">View </li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<!-- New Requirement Entries Column -->
<div class="col-md-12">
   <!-- New Requirement -->
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
                     Description  : 
                  </th>
                  <td>
                     <span> {{ empty($newRequirement->description)? "-":$newRequirement->description}} </span>
                  </td>
               </tr>
               <tr>
                  <th>
                     From Date  : 
                  </th>
                  <td>
                     <span>{{$newRequirement->from_date}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     To Date  : 
                  </th>
                  <td>
                     <span>{{$newRequirement->to_date}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                    Category  : 
                  </th>
                  <td>
                     {{$newRequirement->category->name}}
                  </td>
               </tr>
               <tr>
                  <th>
                    Proposal Document  :
                  </th>
                  @if($newRequirement->proposal_document != "")
                     <td>
                     <span><a href="{{ url('/') }}/uploads/{{ $newRequirement->proposal_document }}">{{ $newRequirement->proposal_document }} <i class="fa fa-download" aria-hidden="true"></i></a></span></td>
                  @else
                     <td> <span> - </span></td>
                  @endif
               </tr>
               <tr>
                  <th>
                    Budget  :
                  </th>
                  <td>
                     <span> {{$newRequirement->budget}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                    Priority  :
                  </th>
                  <td>
                     <span>{{$newRequirement->priority}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Comment  : 
                  </th>
                  <td>
                     <span>{{empty($newRequirement->comment)?"-":$newRequirement->comment}}</span>
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
               <tr>
                  <th>
                    View Quotation detail  :
                  </th>
                  <td>
                     <span><a href="{{ url('vendor/new/requirements/showQuotationDetail/'.$newRequirement->id.'/'.$assignVendor->id)}}"  rel="tooltip" title="Show Quotation Detail" class="view btn btn-secondary btn-sm viewQuotation">	<i class="fas fa-file"></i></a>&nbsp;</span>
                  </td>
               </tr>
               <tr>
            <tbody>
         </table>     
      </div>
   </div>
</div>
@endsection