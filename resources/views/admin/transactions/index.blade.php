@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Transaction Details</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
         	<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Transaction Details</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Transaction Details</h3>
		</div>
	<div class="card-body">
			<table id="transactionTable" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>SrNo</th>
                        <th>Requirement Id</th>
                        <th>Requirement Title</th>
                        <th>Category</th>
                        <th>Vendor Name</th>
						<th>Payment date</th>
						<th>Amount</th>
						<th>Payment File</th>
					</tr>
				</thead>
			</table>
	</div>
</div>
@endsection
@section('scripts')

<script type="text/javascript">
	$(function () {
		var table = $('#transactionTable').DataTable({
			processing: true,
			serverSide: true,
			bLengthChange: false,
			ajax: "{{ route('admin.transaction.index') }}",
			columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'requirement_id', name: 'code'},
                {data: 'requirement_title', name: 'requirement_title'},
                {data: 'category', name: 'category'},
                {data: 'vendor_name', name: 'vendor_name'},
				{data: 'payment_date', name: 'payment_date'},
				{data: 'amount', name: 'amount'},
				{data: 'receipt', name: 'receipt'},
			]
		});
	});
</script>
@endsection