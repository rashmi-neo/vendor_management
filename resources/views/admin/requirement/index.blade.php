@extends('layouts.master')
@section('main-content')
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Requirements</h3>
			<a class="btn btn-success float-right btn-sm" rel="tooltip" title="Add New" href="{{route('requirements.create')}}">Add New</a>
		</div>
	<div class="card-body">
			<table id="requirementTable" class="table table-bordered table-hover">
				<thead>
					<tr>
                        <th>SrNo</th>
                        <th>Requirement ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Priority</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
	</div>
</div>

<!-- /.Requirement status modal -->
<div class="modal fade" id="requirementStatus">
<div class="modal-dialog modal-md">
    <form method="POST"  data-parsley-validate="parsley">
        <div class="modal-content">
            <div class="modal-header headerModal">
               <h4 class="modal-title">Update status</h4>
               <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
               </button>
            </div>
            @csrf
            <input type="hidden" value="" id="requirementId" name="requirement_id">
            <div class="modal-body">
            <div class="form-group">
                <div>
               {!! Form::label('status','Status:',['class'=>"col-sm-2 col-form-label"],false) !!} 
               <select id="status" class="form-control" name="status">
                    <option value="in_progress" selected>In Progress</option>
                    <option value="Approved">Approved</option>
                    <option value="Completed" >Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
                
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="updateStatus" >save</button>
        </div>
    </form>
</div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
        var table = $('#requirementTable').DataTable({
            processing: true,
            serverSide: true,
            bLengthChange: false,
            ajax: "{{ route('requirements.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'code', name: 'code'},
                {data: 'title', name: 'title'},
                {data: 'category_id', name: 'category'},
                {data: 'priority', name: 'priority'},
                {data: 'created_at', name: 'date'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'},
            ],
            "columnDefs": [
                { "width": "90px", "targets": 7 }
                ],
        });
    });

    function openStatusModal(data)
    {
       
        $('#status option:selected').removeAttr('selected');
        $("#requirementStatus").modal('show');
        $("#requirementId").val(data.id);
        var status = data.status;
        $("select option[value='" + status + "']").attr("selected","selected");
    }
</script>
<script>

    $("#updateStatus").click(function (e) {
        
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        e.preventDefault();
        var requirementId = $("#requirementId").val();
        var status = $("#status").val();


            $.ajax({
            type: "POST",
            url: "{{ route('update.requirement.status') }}",
            data:{'requirementId':requirementId,'status':status},
            dataType: "json",
            success: function(result){
                
             if(result)
             {
                $('#quotationStatus').modal('hide');
                toastr.success('Status updated successfully');
                setTimeout(function () {
                    location.reload(true);
                }, 2000);
             }
            }});
    });
</script>
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
@endsection
