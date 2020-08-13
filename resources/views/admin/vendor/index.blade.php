@extends('layouts.master')
<style>
.text-wrap{
    white-space:normal;
}
.width-200{
width:100px;
}

</style>
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Vendors</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Vendors</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Vendors</h3>
			<a class="btn btn-success float-right btn-sm" rel="tooltip" title="Add New" href="{{route('vendors.create')}}">Add New</a>
		</div>
	<div class="card-body">
			<table id="vendorTable" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>SrNo</th>
						<th>Vendor Name</th>
						<th>Category</th>
						<th>Contact Number</th>
						<th>Company Name</th>
						<th>Verification status</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
	</div>
</div>

<!-- /.Vendor status modal -->
<div class="modal hide fade" id="vendorStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <form method="POST"  data-parsley-validate="parsley">
            <div class="modal-content">
                <div class="modal-header headerModal">
                <h4 class="modal-title">Update Vendor Status</h4>
                <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                @csrf
                <input type="hidden" value="" id="vendorId" name="vendorId">
                <div class="modal-body">
                <div class="form-group">
                    <div>
                    {!! Form::label('status','Status:',['class'=>"col-sm-2 col-form-label"],false) !!} 
						<select class="form-control" style="width: 100%;" name="verify_status" id="status"
							data-parsley-errors-container="#statusError" data-parsley-required="true"
							data-parsley-error-message="Please select verification status">
							<option value="">Select Verification status</option>
							<option value="pending">Pending</option>
							<option value="approved">Approved</option>
							<option value="rejected">Rejected</option>
                     	</select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="updateStatus" >Save</button>
            </div>
        </form>
    </div>
        <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->


@endsection
@section('scripts')
@if(session()->get('success'))
	<script>
		var message = "{{ Session::get('success') }}"
		toastr.success(message);
	</script>
@endif
@if(session()->get('error'))
	<script>
		var message = "{{ Session::get('error') }}"
		toastr.error(message);
	</script>
@endif
<script type="text/javascript">
	$(function () {
		var table = $('#vendorTable').DataTable({
			processing: true,
			serverSide: true,
			scrollX:        true,
			bLengthChange: false,
			ajax: "{{ route('vendors.index') }}",
			columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'name', name: 'name'},
				{data: 'category', name: 'category'},
				{data: 'contact_number', name: 'contact_number'},
				{data: 'company_name', name: 'company_name'},
				{data: 'verification_status', name: 'verification_status'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
			],
			columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: 6
                }
             ]
		});  
	});

	function openStatusModal(data)
    {
       
        $('#status option:selected').removeAttr('selected');
        $("#vendorStatus").modal('show');
        $("#vendorId").val(data.id);
        var status = data.user.is_verified;
        $("select option[value='" + status + "']").attr("selected","selected");
    }

	$("#updateStatus").click(function (e) {
        
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        e.preventDefault();
        var vendorId = $("#vendorId").val();
        var status = $("#status").val();


            $.ajax({
            type: "POST",
            url: "{{ route('update.vendor.status') }}",
            data:{'vendorId':vendorId,'status':status},
            dataType: "json",
            success: function(result){
                
             if(result)
             {
                $('#vendorStatus').modal('hide');
                toastr.success(result.message);
                setTimeout(function () {
                    location.reload(true);
                }, 2000);
             }
            }});
    });
</script>
@endsection