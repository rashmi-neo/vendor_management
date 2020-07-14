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
            ]
        });
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
