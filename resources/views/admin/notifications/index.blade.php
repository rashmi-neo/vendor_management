@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Notifications</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Notifications</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Notifications</h3>		
	</div>
	<div class="card-body">
		@if(session()->get('success'))
		    <div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fa fa-check"></i>{{ Session::get('success') }}
			</div><br />
  		@endif
		<table id="example2" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>SrNo</th>
					<th>Title</th>
					<th>Text</th>
					<th>Type</th>
					<th>Status</th>
					<th>Date</th>
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
    var table = $('#example2').DataTable({
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax: "{{ route('notification.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'text', name: 'text'},
            {data: 'type', name: 'type'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
$(document).ready(function(){
    $("[rel=tooltip]").tooltip();
});
</script>
@endsection