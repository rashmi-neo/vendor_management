@extends('layouts.master')
@section('main-content')
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Vendors</h3>
			<a class="btn btn-success btn-sm" href="{{route('vendors.create')}}" style="margin-left: 826px;">Add New</a>
		</div>
	<div class="card-body">
		 @if(session()->get('success'))
		    <div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fa fa-check"></i>{{ Session::get('success') }}
			</div><br />
  		 @endif
		 @if(session()->get('error'))
		    <div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fa fa-check"></i>{{ Session::get('error') }}
			</div><br />
  		 @endif
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
<script type="text/javascript">
  $(function () {
    var table = $('#vendorTable').DataTable({
        processing: true,
        serverSide: true,
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