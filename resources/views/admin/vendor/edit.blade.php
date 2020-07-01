@extends('layouts.master')
@section('main-content')
<div class="col-md-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title">Edit Vendor</h3>
      </div>
      <div class="card-body">
         <form class="form-horizontal" method="post" action="">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $vendor->id}}">
            <div class="form-group row">
               <label for="name" class="col-sm-2 col-form-label">Name</label>
               <div class="col-sm-8">
                  <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$vendor->first_name}}">
               </div>
            </div>
            <div class="form-group row">
               <label for="category" class="col-sm-2 col-form-label">Category Name</label>
               <div class="col-sm-8">
                  <input type="text" class="form-control" id="category" placeholder="Category Name" name="category" value="{{$vendor->vendorCategory->category->name}}">
               </div>
            </div>
            <div class="form-group row">
               <label for="contact_number" class="col-sm-2 col-form-label">Contact number</label>
               <div class="col-sm-8">
                  <input type="text" class="form-control" id="contact_number" placeholder="Contact Number" name="contact_number" value="{{$vendor->company->contact_number }}">
               </div>
            </div>
            <div class="form-group row">
               <label for="company_name" class="col-sm-2 col-form-label">Company Name</label>
               <div class="col-sm-8">
                  <input type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name" value="{{$vendor->company->company_name  }}">
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-2"></div>
               <div class="col-sm-6">	
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{route('vendors.index')}}" class="btn btn-default">Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection