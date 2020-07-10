@extends('layouts.master')
@section('main-content')
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Past Requirement</h3>
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
			<table id="pastRequirementTable" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>SrNo</th>
						<!-- <th>Title</th> -->
						<!-- <th>Category</th> -->
						<!-- <th>Priority</th> -->
						<!-- <th>Status</th> -->
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
    var table = $('#pastRequirementTable').DataTable({
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax: "{{ route('past.requirement.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            //{data: 'requirement.title', name: 'requirement'},
            {data: 'action',   name: 'action'},
        ]
    });
    
  });
</script>
@endsection