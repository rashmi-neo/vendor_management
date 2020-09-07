
@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">View Quotation Document Details</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
			   <li class="breadcrumb-item"><a href="{{url('vendor/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('past.requirement.index') }}">Past Requirement</a></li>
            <li class="breadcrumb-item active">View  Quotation Document Details  </li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="card">
   <div class="card-header">
      <h3 class="card-title">View Quotation Document Details</h3>
      <div class="float-right">
            <a class="btn btn-primary" href="{{ route('past.requirement.index') }}"> Back</a>
         </div>
   </div>
   <div class="card-body">
      <table id="pastRequirementQuotationTable" class="table table-bordered table-hover">
         <thead>
            <tr>
               <th>SrNo</th>
               <th>Quatation Document</th>
               <th>Comment</th>
               <th>Admin Comment</th>
               <th>Status</th>
            </tr>
         </thead>
         <tbody>
         @foreach($quotations as $quotation)
            <tr>
               <td>{{$loop->iteration}}</td>
               <td> <a href="{{ url('/') }}/uploads/{{ $quotation->quotation_doc }}">{{ $quotation->quotation_doc }} <i class="fa fa-download" aria-hidden="true"></i></a></td>
               <td>{{empty($quotation->comment)?"-":$quotation->comment}}</td>
               <td>{{empty($quotation->admin_comment)?"-":$quotation->admin_comment}}</td>
               <td>{{ucfirst($quotation->status)}}</td>
            </tr>
         @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection