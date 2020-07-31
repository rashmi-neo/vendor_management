@extends('layouts.master')
@section('main-content')
<div class="card">
		<div class="card-header">
			<h3 class="card-title">New Requirement</h3>
		</div>
	<div class="card-body">
		<table id="newRequirementTable" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>SrNo</th>
					<th>Code</th>
					<th>Title</th>
					<th>Category</th>
					<th>Priority</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<form data-parsley-validate="parsley" id="QuotationForm" enctype ="multipart/form-data">
   @csrf
   <div class="modal fade" id="uploadQuotation"aria-modal="true">
      <input type="hidden" name="vendor_id" value=""/>
      <input type="hidden" id="requirementId" name="id" value=""/>
      <div class="modal-dialog modal-md">
         <div class="modal-content">
            <div class="modal-header headerModal">
               <h4 class="modal-title">Upload Document</h4>
               <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group mb-3">
               {!! Form::label('quotation','Upload quotation:',['class'=>"col-sm-2 col-form-label"],false) !!} 
				   <input type="file" class="form-control" name="quotation" 
               id="quotationFile" data-parsley-required="true" data-parsley-error-message="Please upload quotation" 
               data-parsley-trigger = "input"
               data-parsley-trigger="blur">
				  <span class="text-danger error-quotation" role="alert">
                  </span> 
               </div>
			   <div class="form-group mb-3">
			   {!! Form::label('comment','Comment:',['class'=>"col-sm-2 col-form-label"],false) !!} 
                  {!! Form::textarea('vendor_comment',null,['class'=>'form-control','id' => 'comment','rows' => 2, 'cols' => 80,
                  'placeholder'=>'Comment']) !!}
            </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               {!! Form::button('Upload', ['type' => 'button','id'=>'saveQuotation','class' => 'btn btn-primary'] ) !!}
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
</form>

@endsection
@section('scripts')

@if(session()->get('error'))
	<script>
		var message = "{{ Session::get('error') }}"
		toastr.error(message);
	</script>
@endif
<script type="text/javascript">
	$(function () {
		var table = $('#newRequirementTable').DataTable({
			processing: true,
			serverSide: true,
			bLengthChange: false,
			ajax: "{{ route('new.requirement.index') }}",
			columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'code', name: 'code'},
				{data: 'title', name: 'title'},
				{data: 'category_name', name: 'category_name'},
				{data: 'priority', name: 'priority'},
				{data: 'status', name: 'status'},
				{data: 'action',   name: 'action'},
			]
		});
	});

</script>

<script>
	$('body').on('click', '.uploadQuotation', function () {
         var requirementId = $(this).data('id');
		 
         $('#requirementId').val(requirementId);
    });

	$("#saveQuotation").click(function (e) {
      var quotation = $("#quotationFile").val();
      var comment = $("#comment").val();
      var requirementId = $("#requirementId").val();
      var fileData =  $("#quotationFile").prop('files')[0];
     // alert(fileData);
     e.preventDefault();

      var url = "{{ url('vendor/new/requirements/update') }}";
      
      var formData = new FormData();
      //alert($("#quotationFile").files);
      formData.append('id', requirementId);
      formData.append('vendor_comment', comment);
      formData.append('quotation',fileData);
   
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: "POST",
            url: url+'/'+requirementId,
            contentType: false,
            processData:false,
            data:formData,
            dataType: "json",
            success: function(result){
             if(result)
             { 
               $('#uploadQuotation').modal('hide');
                toastr.success('Quotation uploaded successfully');
                setTimeout(function () {
                    location.reload(true);
                }, 2000);

             }
            },
            error:function(result){
                if(typeof result.responseJSON.errors.quotation != "undefined"){
                  let quotation = (result.responseJSON.errors.quotation[0]);
                  $('.error-quotation').html(quotation);
                }else{
                  $('.error-quotation').empty();
                }
              }
         });
    });
</script>
@endsection