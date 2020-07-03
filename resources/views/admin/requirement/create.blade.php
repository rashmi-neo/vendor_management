@extends('layouts.master')
@section('main-content')
<div class="col-md-12">
 	<div class="card">
 		 <div class="card-header" >
			<h3 class="card-title">Add Requirement</h3>
		 </div>
			<div class="card-body">
				<form role="form" action="" method="post" data-parsley-validate="parsley" id="requirementForm" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
					 <label for="inputTitle" class="col-sm-3 label_class">Name</label>
					 	<div class="col-sm-7">
	                      <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="inputTitle" placeholder="Title" name="name" value="" data-parsley-required="true" data-parsley-error-message="Please EnterTitle ">
	                      {!! $errors->first('name', '<p class="invalid-feedback">:message</p>') !!}
	                    </div>
				 	</div>
				 	<div class="form-group row">
				 		<label for="inputTitle" class="col-sm-3 label_class">Category</label>
				 		<div class="col-sm-7">
				 			<select class="form-control">
				 				<option>Select Category</option>
				 				<option>option 1</option>
				 			</select>
				 		</div>
				 	</div>
				 	<div class="form-group row">
						 <label for="inputTitle" class="col-sm-3 label_class">Description</label>
						   <div class="col-sm-7">
						 		<textarea class="form-control" rows="4" cols="80" placeholder="Brief description"></textarea>
		                   </div>
				 	</div>
				 	<div class="form-group row">
				 		<label for="inputTitle" class="col-sm-3 label_class">Priority</label>
				 		<div class="col-sm-7">
				 			<select class="form-control">
				 				<option>Select Category</option>
				 				<option>option 1</option>
				 			</select>
				 		</div>
				 	</div>
				 	<div class="form-group row">
				 		<label class="col-sm-3" for="people">Select Vendor</label>
				 		<div class="col-sm-7">
				 			<select id="people" name="people" class="form-control" multiple>
					            <option value="alice">Alice</option>
					            <option value="bob">Bob</option>
					            <option value="carol">Carol</option>
        					</select>
				 		</div>
                    </div>
				 	<div class="form-group row">
				 		<label for="inputTitle" class="col-sm-3 label_class">Proposal Document(if/any)</label>
				 		<div class="col-sm-7">
				 			<input type="file" class="form-control"placeholder="Profile image" name="">
				 		</div>
				 	</div>
				 	<div class="form-group row">
					 <label for="inputTitle" class="col-sm-3 label_class">Budget</label>
					 	<div class="col-sm-7">
	                      <input type="text" placeholder="Budget" class="form-control">
	                    </div>
				 	</div>
				 	<div class="form-group row">
						 <label for="inputTitle" class="col-sm-3 label_class">Note/Special Comment</label>
						   <div class="col-sm-7">
						 		<textarea class="form-control" rows="4" cols="80" placeholder="Special Comment"></textarea>
		                   </div>
				 	</div>
				 	<div class="form-group row">
						<div class="col-sm-3"></div>
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
@section('scripts')
<script type="text/javascript">
    $(function(){
        $('#people').multiSelect();
    });
</script>
@endsection