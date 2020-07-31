
@extends('layouts.master')
@section('main-content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title">View Quotation Document Details</h3>
      <div class="float-right">
            <a class="btn btn-primary" href="{{ route('new.requirement.index') }}"> Back</a>
         </div>
   </div>
   <div class="card-body">
      <table id="newRequirementTable" class="table table-bordered table-hover">
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
            <td>{{$quotation->id}}</td>
               <td>{{$quotation->quotation_doc}}</td>
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