@extends('layouts.master')
@section('main-content')
<div class="col-md-12">
 	<div class="card">
 		 <div class="card-header" >
			<h3 class="card-title">Edit Requirement</h3>
		 </div>
			<div class="card-body">
				<form role="form" action="{{route('requirements.update',$requirementEditDetails->id)}}" method="post" data-parsley-validate="parsley" id="requirementForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>ok</li>
                            </ul>
                        </div>
                    @endif
					<div class="form-group row">
					 <label for="inputTitle" class="col-sm-3 label_class">Title</label>
					 	<div class="col-sm-7">
	                      <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="inputTitle" data-parsley-errors-container="#titleError" data-parsley-required="true" data-parsley-error-message="Please enter title" placeholder="Title" name="title" value="{{$requirementEditDetails->title}}" >
                          @error('title')
                          <span class="text-danger errormsg" role="alert">
                             <p>{{ $message }}</p>
                          </span>
                          @enderror
                          <span id="titleError"><span>
                        </div>
                     </div>

				 	<div class="form-group row">
				 		<label for="category" class="col-sm-3 label_class">Category</label>
				 		<div class="col-sm-7">
				 			<select class="form-control" name="category_id"  id="category" data-parsley-errors-container="#categoryError" data-parsley-required="true" data-parsley-error-message="Please select category">
				 				<option value="">Select Category</option>
								@forelse($categories as $category)
								<option value="{{$category->id}}" @if($requirementEditDetails->category_id == $category->id) selected="selected" @endif>{{ $category->name }}</option>
								@empty
								<option value="">No categories</option>
								@endforelse
                            </select>
                            @error('category_id')
                            <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                            <span id="categoryError"><span>
				 		</div>
                     </div>

					 <div class="form-group row">
				 		<label class="col-sm-3 label_class">Select Vendors</label>
				 		<div class="col-sm-7">
				 			<select class="form-control" id="vendor" name="vendor_id[]"  multiple="multiple" data-parsley-errors-container="#vendorError" data-parsley-required="true" data-parsley-error-message="Please select vendor">
                            @foreach ($vendorDetails as $vendors)
                            <option value="{{ $vendors->id }}"  selected>{{ $vendors->first_name }}</option>
                            @endforeach
                            </select>
                            @error('vendor_id')
                            <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                          @enderror
                          <span id="vendorError"><span>
				 		</div>
                    </div>
                    <div class="form-group row">
                        <label for="budget" class="col-sm-3 label_class">Budget</label>
                            <div class="col-sm-7">
                             <input type="text" placeholder="Budget" name="budget" class="form-control" data-parsley-errors-container="#budgetError" data-parsley-required="true" data-parsley-error-message="Please enter budget" value="{{$requirementEditDetails->budget}}">
                             @error('budget')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                             <span id="budgetError"><span>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="budget" class="col-sm-3 label_class">From Date</label>
                            <div class="col-sm-7">
                             <input type="text" placeholder="select from date" data-date-format="yyyy-mm-dd"  name="fromDate" class="form-control datepicker" data-parsley-errors-container="#fromDateError" data-parsley-required="true" data-parsley-error-message="Please select from date" value="{{$requirementEditDetails->from_date}}">
                             @error('fromDate')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                             <span id="fromDateError"><span>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="budget" class="col-sm-3 label_class">To Date</label>
                            <div class="col-sm-7">
                             <input type="text" placeholder="select to date" data-date-format="yyyy-mm-dd"   name="toDate" class="form-control datepicker" data-parsley-errors-container="#toDateError" data-parsley-required="true" data-parsley-error-message="Please select to date"  value="{{$requirementEditDetails->to_date}}">
                             @error('toDate')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                             <span id="toDateError"><span>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="priority" class="col-sm-3 label_class">Priority</label>
                        <div class="col-sm-7">
                            <select class="form-control" name="priority" data-parsley-errors-container="#priorityError" data-parsley-required="true" data-parsley-error-message="Please select priority">
                                <option value="">Select Priority</option>
                                <option value="low"  @if($requirementEditDetails->priority == "low") selected="selected" @endif>Low</option>
                                <option value="medium" @if($requirementEditDetails->priority == "medium") selected="selected" @endif>Medium</option>
                                <option value="high"  @if($requirementEditDetails->priority == "high") selected="selected" @endif>High</option>
                            </select>
                            @error('priority')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                             <span id="priorityError"><span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="document" class="col-sm-3 label_class">Proposal Document(if/any)</label>
                        <div class="col-sm-7">

                            <input type="file" class="form-control"placeholder="Proposal Document" name="proposal_document"  value="{{$requirementEditDetails->proposal_document}}">
                            <div>{{$requirementEditDetails->proposal_document}}</div>
                            @error('proposal_document')
                            <span class="text-danger errormsg" role="alert">
                               <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>
				 	<div class="form-group row">
						 <label for="description" class="col-sm-3 label_class">Description</label>
						   <div class="col-sm-7">
						 		<textarea class="form-control" rows="4" cols="80" placeholder="Brief description" name="description">{{ $requirementEditDetails->description }}</textarea>
		                   </div>
				 	</div>
				 	<div class="form-group row">
						 <label for="comment" class="col-sm-3 label_class">Note/Special Comment</label>
						   <div class="col-sm-7">
						 		<textarea class="form-control" rows="4" cols="80" placeholder="Special Comment" name="comment">{{ $requirementEditDetails->comment }}</textarea>
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
        $('#vendor').select2({
            theme: 'bootstrap4'
        })
         $(".datepicker").datepicker();
    });

// append the vendors as per category id.
   $("#category").click(function (e) {
        e.preventDefault();
        var id= $(this).val();
        $.ajax({
        type: "GET",
        url: "../vendors/"+id,
        dataType: "json",
        success: function(result){
            alert(id);
            $("#vendor").empty();
            $.each(result,function(key,val){
                $("#vendor").append('<option value='+val.vendor.id+' selected>'+val.vendor.first_name+'</option>');
            });
         }});
    });
</script>
@endsection
