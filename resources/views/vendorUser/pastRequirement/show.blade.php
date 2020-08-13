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
            <li class="breadcrumb-item"><a href="{{ route('past.requirement.index') }}">Past Requirement</a></li>
            <li class="breadcrumb-item active">View </li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<!-- Past Requirement Entries Column -->
<div class="col-md-12">
   <!-- Past Requirement -->
   <div class="card mb-4">
      <div class="card-header">
         <h3 class="card-title">View Past Requirement</h3>
         <div class="float-right">
            <a class="btn btn-primary" href="{{ route('past.requirement.index') }}"> Back</a>
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
                     <span>{{$pastRequirement->title}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Description  : 
                  </th>
                  <td>
                     <span> {{ empty($pastRequirement->description)? "-":$pastRequirement->description}} </span>
                  </td>
               </tr>
               <tr>
                  <th>
                     From Date  : 
                  </th>
                  <td>
                     <span>{{$pastRequirement->from_date}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     To Date  : 
                  </th>
                  <td>
                     <span>{{$pastRequirement->to_date}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                    Category  : 
                  </th>
                  <td>
                     @foreach($category->vendorCategory as $cat)
                     <li>{{$cat->category->name}}</li>
                     @endforeach
                  </td>
               </tr>
               <tr>
                  <th>
                    Proposal Document  :
                  </th>
                  <td>
                     <span> {{$pastRequirement->proposal_document}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                    Budget  :
                  </th>
                  <td>
                     <span> {{$pastRequirement->budget}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                    Priority  :
                  </th>
                  <td>
                     <span> {{$pastRequirement->priority}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Comment  : 
                  </th>
                  <td>
                     <span>{{empty($pastRequirement->comment)?"-":$pastRequirement->comment}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                    Status  :
                  </th>
                  <td>
                     <span>{{$pastRequirement->status}}</span>
                  </td>
               </tr>
            <tbody>
         </table>     
      </div>
   </div>
</div>
@endsection