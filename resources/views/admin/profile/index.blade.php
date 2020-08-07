@extends('layouts.master')
@section('main-content')

<div class="card">
		<div class="card-header">
			<h3 class="card-title">Profiles</h3>
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
			<table id="profileTable" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>SrNo</th>
						<th>User Name</th>
						<th>Email</th>
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
    var table = $('#profileTable').DataTable({
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax: "{{ route('profiles.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'username', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'verification_status', name: 'verification_status'},
            {data: 'action', name: 'action'},
        ]
    });
    
  });
</script>
@endsection