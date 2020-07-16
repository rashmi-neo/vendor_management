@extends('layouts.master')
@section('main-content')
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
			]
		});  
	});
</script>
@endsection