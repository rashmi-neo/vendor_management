@extends('layouts.master')
@section('main-content')
 <div class="col-md-10">
 	<div class="card">
 		 <div class="card-header" >
			<h3 class="card-title">Add Requirement</h3>
		</div>
			<div class="card-body">
				<form role="form" action="" method="post" data-parsley-validate="parsley" id="requirementForm" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
					 <label for="inputTitle" class="col-sm-2 label_class">Name</label>
					 	<div class="col-sm-7">
	                      <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="inputTitle" placeholder="Title" name="name" value="" data-parsley-required="true" data-parsley-error-message="Please Enter Category  name">
	                      {!! $errors->first('name', '<p class="invalid-feedback">:message</p>') !!}
	                    </div>
				 	</div>
				 	<div class="form-group row">
				 		<label for="inputTitle" class="col-sm-2 label_class">Category</label>
				 		<div class="col-sm-7">
				 			<select class="form-control">
				 				<option>Select Category</option>
				 				<option>option 1</option>
				 			</select>
				 		</div>
				 	</div>
				 	<div class="form-group row">
						 <label for="inputTitle" class="col-sm-2 label_class">Description</label>
						   <div class="col-sm-7">
						 		<textarea class="form-control" rows="4" cols="80" placeholder="Brief description"></textarea>
		                   </div>
				 	</div>
				 	<div class="form-group row">
				 		<label for="inputTitle" class="col-sm-2 label_class">Priority</label>
				 		<div class="col-sm-7">
				 			<select class="form-control">
				 				<option>Select Category</option>
				 				<option>option 1</option>
				 			</select>
				 		</div>
				 	</div>
				 	<div class="form-group row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">	
							 <button type="submit" class="btn btn-primary col-sm-2">Save</button>
							 <a href="{{route('categories.index')}}" class=" col-sm-2 btn btn-default">Cancel</a>
						</div>
				 </div> 
				</form>
			</div>
		</div>
 	</div>
 </div>
@endsection