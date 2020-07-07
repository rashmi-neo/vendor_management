@extends('layouts.master')
@section('main-content')
<div class="col-md-12">
 	<div class="card">
 		 <div class="card-header" >
			<h3 class="card-title">Edit Requirement</h3>
		 </div>
			<div class="card-body">
				<form role="form" action="{{route('requirements.edit')}}" method="post" data-parsley-validate="parsley" id="requirementForm" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
					 <label for="inputTitle" class="col-sm-3 label_class">Title</label>
					 	<div class="col-sm-7">
	                      <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="inputTitle" placeholder="Title" name="title" value="" data-parsley-required="true" data-parsley-error-message="Please EnterTitle ">
	                      {!! $errors->first('title', '<p class="invalid-feedback">:message</p>') !!}
	                    </div>
				 	</div>
				 	<div class="form-group row">
				 		<label for="category" class="col-sm-3 label_class">Category</label>
				 		<div class="col-sm-7">
				 			<select class="form-control" name="category_id">
				 				<option>Select Category</option>
								@forelse($categories as $category)
								<option value="{{$category->id}}">{{ $category->name }}</option>
								@empty
								<option value="">No categories</option>
								@endforelse
				 			</select>
				 		</div>
				 	</div>
					 <div class="form-group row">
				 		<label class="col-sm-3 label_class" for="vendor">Select Vendors</label>
				 		<div class="col-sm-7">
				 			<select class="form-control" id="vendor" name="vendor_id[]" multiple>
								 @forelse($vendors as $vendor)
								<option value="{{$vendor->id}}">{{ $vendor->first_name }}</option>
								@empty
								<option value="">No vendors</option>
								@endforelse
        					</select>
				 		</div>
                    </div>
				 	<div class="form-group row">
						 <label for="description" class="col-sm-3 label_class">Description</label>
						   <div class="col-sm-7">
						 		<textarea class="form-control" rows="4" cols="80" placeholder="Brief description" name="description"></textarea>
		                   </div>
				 	</div>
				 	<div class="form-group row">
				 		<label for="priority" class="col-sm-3 label_class">Priority</label>
				 		<div class="col-sm-7">
				 			<select class="form-control" name="priority">
				 				<option>Select Priority</option>
				 				<option value="low">Low</option>
				 				<option value="medium">Medium</option>
				 				<option value="high">High</option>
				 			</select>
				 		</div>
				 	</div>
				 	<div class="form-group row">
				 		<label for="document" class="col-sm-3 label_class">Proposal Document(if/any)</label>
				 		<div class="col-sm-7">
				 			<input type="file" class="form-control"placeholder="Proposal Document" name="proposal_document">
				 		</div>
				 	</div>
				 	<div class="form-group row">
					 <label for="budget" class="col-sm-3 label_class">Budget</label>
					 	<div class="col-sm-7">
	                      <input type="text" placeholder="Budget" name="budget" class="form-control">
	                    </div>
				 	</div>
				 	<div class="form-group row">
						 <label for="comment" class="col-sm-3 label_class">Note/Special Comment</label>
						   <div class="col-sm-7">
						 		<textarea class="form-control" rows="4" cols="80" placeholder="Special Comment" name="comment"></textarea>
		                   </div>
				 	</div>
				 	<div class="form-group row">
						<div class="col-sm-3"></div>
						<div class="col-sm-8">
							 <button type="submit" class="btn btn-primary col-sm-2">Save</button>
							 <a href="{{route('requirements.index')}}" class=" col-sm-2 btn btn-default">Cancel</a>
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
        $('#vendor').multiSelect();
    });
</script>
@endsection
