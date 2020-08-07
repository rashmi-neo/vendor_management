@extends('layouts.master')
<style>
.checked {
  color: orange;
}
</style>
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark"> View Reviews and Ratings</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
		      <li class="breadcrumb-item"><a href="{{url('vendor/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('vendor.reviews.index') }}">Reviews and Ratings</a></li>
            <li class="breadcrumb-item active">View </li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<!-- Review And Rating Entries Column -->
<div class="col-md-12">
   <!--   Review And Rating -->
   <div class="card mb-4">
      <div class="card-header">
         <h3 class="card-title">View Review and Rating</h3>
         <div class="float-right">
            <a class="btn btn-primary" href="{{ route('vendor.reviews.index') }}"> Back</a>
         </div>
      </div>
      <div class="card-body"> 
         <table class="table table-striped table-bordered" >
            <tbody>
               <tr>
                  <th>
                     Id  : 
                  </th>
                  <td>
                     <span>{{$reviewAndRating->id}}</span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Requirement Id  : 
                  </th>
                  <td>
                     <span>{{$reviewAndRating->requirement->code}} </span>
                  </td>
               </tr><tr>
                  <th>
                    Requirement Title  : 
                  </th>
                  <td>
                     <span>{{$reviewAndRating->requirement->title}} </span>
                  </td>
               </tr><tr>
                  <th>
                  Category  : 
                  </th>
                  <td>
                     <span>{{$reviewAndRating->requirement->category->name}} </span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Review  : 
                  </th>
                  <td>
                     <span>{{$reviewAndRating->review}} </span>
                  </td>
               </tr>
               <tr>
                  <th>
                     Rating  : 
                  </th>
                  <td>
                    @for($index =0;$index<5;$index++)
                    <span class="fa fa-star {{ ($reviewAndRating->rating <=$index)? '' : 'checked' }}"></span>
                    @endfor
                  </td>
               </tr>
            <tbody>
         </table>     
      </div>
   </div>
</div>
@endsection