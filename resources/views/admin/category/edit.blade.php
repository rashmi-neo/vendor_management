@extends('layouts.master')
@section('main-content')
<div class="col-md-10">
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Edit Category</h3>
		</div>
		<div class="card-body">
			<form class="form-horizontal" method="post" action="{{ route('categories.update', $category->id ) }}" data-parsley-validate="parsley">
				 @csrf
				 @method('PUT')
				 <input type="hidden" name="id" value="{{ $category->id}}">
				 <div class="form-group row">
					 <label for="inputName" class="col-sm-2 col-form-label">Name</label>
					 	<div class="col-sm-8">
	                      <input type="text" class="form-control" id="inputName" placeholder="Category Name" name="name" value="{{$category->name}}"data-parsley-required="true" data-parsley-error-message="Please Enter Category  name">
	                      @error('name')
	                           <span class="text-danger errormsg" role="alert">
	                           <p>{{ $message }}</p>
	                           </span>
                           @enderror
	                    </div>
				 </div>
				 <div class="form-group row">
					 <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
					 	<div class="col-sm-2">
					 		<div class="form-check">
					 			<input type="radio" class="form-check-input" id="activeCheck" name="status"  value="1" {{ ($category->status=="1")? "checked" : "" }}>
					 			<label class="form-check-label" for="activeCheck">Active</label>
					 		</div>
					 	</div>
					 	<div class="col-sm-1">
					 		<div class="form-check">
					 			<input type="radio" class="form-check-input" id="inactiveCheck" name="status" value="0" {{ ($category->status=="0")? "checked" : "" }}>
					 			<label class="form-check-label" for="inactiveCheck">Inactive</label>
					 		</div>
					 	</div>
				 </div>
				 <div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-6">	
						 <button type="submit" class="btn btn-primary">Save</button>
						 <a href="{{route('categories.index')}}" class="btn btn-default">Cancel</a>
					</div>
				 </div>      
			</form>
		</div>
	</div>
</div>
@endsection