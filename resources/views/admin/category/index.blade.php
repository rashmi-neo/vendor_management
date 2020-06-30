@extends('layouts.master')
@section('main-content')
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Vendor Category</h3>
			<a class="btn btn-success btn-sm" href="{{route('categories.create')}}" style="margin-left: 826px;">Add New</a>
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
						<th>Category Name</th>
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
    var table = $('#example2').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('categories.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });

function delete_com(id){
 	var catid = id;
  	$.confirm({
        title: 'Confirmation',
        content: 'Are You Sure?',
        buttons: {
            confirm: function () {
                $.ajax({
                    id: catid,
        			type: 'DELETE',
                    url: "/categories/"+catid,
                    data: {_token:  '{{ csrf_token() }}' , id: catid  },
                       success: function(result){
                         window.location.replace('/categories'); 
                    }
                });
            },
            cancel: function () {
                    
                } 
        }
    });
 }
</script>
@endsection