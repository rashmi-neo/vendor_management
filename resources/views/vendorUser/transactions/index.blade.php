@extends('layouts.master')
@section('main-content')
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Transaction Details</h3>
		</div>
	<div class="card-body">
			<table id="transactionTable" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>SrNo</th>
						<th>Payment date</th>
						<th>Amount</th>
						<th>Payment File</th>
						<th>Download Payment File</th>
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
			ajax: "{{ route('transaction.index') }}",
			columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'payment_date', name: 'payment_date'},
				{data: 'amount', name: 'amount'},
				{data: 'receipt', name: 'receipt'},
				{data: 'download_file', name: 'download_file'},
			]
		});
	});
</script>
@endsection