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
@endsection