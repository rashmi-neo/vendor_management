<div class="form-group">
	<div class="row">
		@if($row->type=='Vendor register')
		<a href="{{route('vendors.index')}}" class="view btn btn-success btn-sm" rel="tooltip" title="View"><i class="fas fa-eye"></i></a>&nbsp;
		@endif
		@if($row->type=='Document update')
		<a href="{{ url('admin/showQuotation/1/2')}}" class="view btn btn-success btn-sm" rel="tooltip" title="View"><i class="fas fa-eye"></i></a>&nbsp;
		@endif
		@if($row->type=='New requirement')
		<a href="{{route('new.requirement.index')}}" class="view btn btn-success btn-sm " rel="tooltip" title="View"><i class="fas fa-eye"></i></a>&nbsp;
		@endif
		@if($row->type=='Admin comment')
		<a href="{{route('new.requirement.index')}}" class="view btn btn-success btn-sm " rel="tooltip" title="View"><i class="fas fa-eye"></i></a>&nbsp;
		@endif
		@if($row->type=='New review rating')
		<a href="{{route('vendor.reviews.index')}}" class="view btn btn-success btn-sm" rel="tooltip" title="View"><i class="fas fa-eye"></i></a>&nbsp;
		@endif
	</div>
</div>