@extends('layouts.master')
@section('main-content')
<div class="col-md-10">
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Add Category</h3>
		</div>
		<div class="card-body">
			<form class="form-horizontal" method="post" action="{{ route('categories.store') }}" data-parsley-validate="parsley">
				 @csrf
				 <div class="form-group row">
					 <label for="inputName" class="col-sm-2 col-form-label">Name</label>
					 	<div class="col-sm-8">
	                      <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="inputName" placeholder="Category Name" name="name" value="" data-parsley-required="true" data-parsley-error-message="Please Enter Category  name">
	                      @error('name')
	                           <span class="text-danger errormsg" role="alert">
	                           <p>{{ $message }}</p>
	                           </span>
                           @enderror
	                    </div>
				 </div>
				 <div class="form-group row">
					 <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
					<div class="col-sm-1">
					 	<div class="form-check">
					 		<input type="radio" class="form-check-input" id="activeCheck" name="status" value="1">
					 		<label class="form-check-label" for="activeCheck">Active</label>
					 	</div>
					 </div>
					 <div class="col-sm-2">
					 	<div class="form-check">
					 		<input type="radio" class="form-check-input" id="inactiveCheck" name="status" value="0">
					 		<label class="form-check-label" for="inactiveCheck">Inactive</label>
					 	</div>
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