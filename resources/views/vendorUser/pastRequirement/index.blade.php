@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Past Requirements</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
		 	<li class="breadcrumb-item"><a href="{{url('vendor/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"> Past Requirements</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Past Requirements</h3>
		</div>
	<div class="card-body">
			<table id="pastRequirementTable" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>SrNo</th>
						<th>Code</th>
						<th>Title</th>
						<th>Category</th>
						<th>Priority</th>
						<th>From Date</th>
						<th>To Date</th>
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
		var table = $('#pastRequirementTable').DataTable({
			processing: true,
			serverSide: true,
			bLengthChange: false,
			ajax: "{{ route('past.requirement.index') }}",
			columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'code', name: 'code'},
				{data: 'title', name: 'title'},
				{data: 'category_name', name: 'category_name'},
				{data: 'priority', name: 'priority'},
				{data: 'from_date', name: 'from_date'},
				{data: 'to_date', name: 'to_date'},
				{data: 'status', name: 'status'},
				{data: 'action',   name: 'action'},
			],
			"columnDefs": [{ className:"text-center", "targets":[8]} ],
			"columnDefs": [
                { "width": "70px", "targets": 8 }
                ]
		});
	});
</script>
@endsection