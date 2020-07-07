@extends('layouts.master')
@section('main-content')
<div class="col-md-12">
 	<div class="card">
 		 <div class="card-header" >
			<h3 class="card-title">Add Requirement</h3>
		 </div>
			<div class="card-body">
				<form role="form" action="{{route('requirements.store')}}" method="post" data-parsley-validate="parsley" id="requirementForm" enctype="multipart/form-data">
                    @csrf
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
	                      <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="inputTitle" placeholder="Title" name="title" value="{{old("title")}}" >
                          @error('title')
                          <span class="text-danger errormsg" role="alert">
                             <p>{{ $message }}</p>
                          </span>
                          @enderror
                        </div>
                     </div>

				 	<div class="form-group row">
				 		<label for="category" class="col-sm-3 label_class">Category</label>
				 		<div class="col-sm-7">
				 			<select class="form-control" name="category_id"  id="category">
				 				<option value="">Select Category</option>
								@forelse($categories as $category)
								<option value="{{$category->id}}">{{ $category->name }}</option>
								@empty
								<option value="">No categories</option>
								@endforelse
                            </select>
                            @error('category_id')
                            <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
				 		</div>
				 	</div>
					 <div class="form-group row">
				 		<label class="col-sm-3 label_class">Select Vendors</label>
				 		<div class="col-sm-7">
				 			<select class="form-control" id="vendor" name="vendor_id[]"  multiple="multiple">
                            </select>
                            @error('vendor_id')
                            <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                          @enderror
				 		</div>
                    </div>
                    <div class="form-group row">
                        <label for="budget" class="col-sm-3 label_class">Budget</label>
                            <div class="col-sm-7">
                             <input type="text" placeholder="Budget" name="budget" class="form-control">
                             @error('budget')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="budget" class="col-sm-3 label_class">From Date</label>
                            <div class="col-sm-7">
                             <input type="text" placeholder="select from date" data-date-format="yyyy-mm-dd"  name="fromDate" class="form-control datepicker">
                             @error('fromDate')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="budget" class="col-sm-3 label_class">To Date</label>
                            <div class="col-sm-7">
                             <input type="text" placeholder="select to date" data-date-format="yyyy-mm-dd"   name="toDate" class="form-control datepicker" >
                             @error('toDate')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="priority" class="col-sm-3 label_class">Priority</label>
                        <div class="col-sm-7">
                            <select class="form-control" name="priority">
                                <option value="">Select Priority</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                            @error('priority')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="document" class="col-sm-3 label_class">Proposal Document(if/any)</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control"placeholder="Proposal Document" name="proposal_document">
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
						 		<textarea class="form-control" rows="4" cols="80" placeholder="Brief description" name="description"></textarea>
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
        $('#vendor').select2({
            theme: 'bootstrap4'
        })
        // $('#vendor').multiSelect({
        //     width:"100px"
        // });
         $(".datepicker").datepicker();
    });

// append the vendors as per category id.
   $("#category").click(function (e) {
        e.preventDefault();
        var id= $(this).val();
      //  alert(id);
        $.ajax({
        type: "GET",
        url: "vendors/"+id,
        dataType: "json",
        success: function(result){
            $("#vendor").empty();
            $.each(result,function(key,val){
                $("#vendor").append('<option value='+val.vendor.id+' selected>'+val.vendor.first_name+'</option>');
                //$("#vendor").append('<option value='+val.id+' selected>'+val.first_name+'</option>');
            });
         }});
    });
</script>
@endsection
