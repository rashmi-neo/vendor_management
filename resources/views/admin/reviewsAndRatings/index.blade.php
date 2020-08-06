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
		<table id="reviewAndRating" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>SrNo</th>
					<th>Requirement Id</th>
					<th>Requirement Title</th>
					<th>Category</th>
					<th>Vendor Name</th>
					<th>Rating</th>
					<th>Review</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@endsection
@section('scripts')

<script type="text/javascript">
$(function () {
    var table = $('#reviewAndRating').DataTable({
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax: "{{ route('reviews.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'requirement_id', name: 'code'},
            {data: 'requirement_title', name: 'requirement_title'},
            {data: 'category', name: 'category'},
            {data: 'vendor_name', name: 'vendor_name'},
            {data: 'rating_star', name: 'rating_star'},
            {data: 'review', name: 'review'},
        ],
        "columnDefs": [
                { "width": "100px", "targets": 5 }
                ],
    });
  });

  $( ".starRating" ).each(function() { 
    // Get the value
    var val = $(this).data("rating");
    // Make sure that the value is in 0 - 5 range, multiply to get width
    var size = Math.max(0, (Math.min(5, val))) * 16;
    // Create stars holder
    var $span = $('<span />').width(size);
    // Replace the numerical value with stars
    $(this).html($span);
});


</script>
@endsection