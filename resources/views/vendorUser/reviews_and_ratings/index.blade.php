@extends('layouts.master')
<style>
.checked {
  color: orange;
}
</style>
@section('main-content')
<div class="card">
  <div class="card-header">
			<h3 class="card-title">Reviews and Ratings</h3>
	</div>
	<div class="card-body">
		<table id="example2" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>SrNo</th>
					<th>Requirement Id</th>
					<th>Requirement Title</th>
					<th>Category</th>
					<th>Rating</th>
					<th>Review</th>
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
      ajax: "{{ route('vendor.reviews.index') }}",
      columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'requirement_id', name: 'requirement_id'},
          {data: 'requirement_title', name: 'requirement_title'},
          {data: 'category', name: 'category'},
          {data: 'rating_star', name: 'rating'},
          {data: 'review', name: 'review'},
          {data: 'action', name: 'action'},
      ],
      "columnDefs": [
      { "width": "100px", "targets": 4 }
      ],
    });
  });
</script>
@endsection