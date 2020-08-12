<div class="form-group">
	<div class="row">
		<a href="{{ route('vendors.edit', $row->id)}}" rel="tooltip" title="Edit" class="edit btn btn-primary btn-sm editVendor"><i class="fas fa-pencil-alt"></i></a>&nbsp;
		<a href="{{ route('vendors.show', $row->id)}}" rel="tooltip" title="Show" class="view btn btn-success btn-sm viewVendor"><i class="fas fa-eye"></i></a>&nbsp;
		@if($row->user->is_verified == "approved")
		<span class="ml-1">
        <button href="#" class="btn btn-info btn-sm"  rel="tooltip" title="Approved" disabled><i class="fas fa-exclamation-circle"></i></button></span>
		@else
		<span class="ml-1">
        <a href="#" class="btn btn-info btn-sm"  rel="tooltip" title="Change Status" onclick="openStatusModal({{ $row }})" id=""><i class="fas fa-exclamation-circle"></i></a></span>
		@endif
	</div>
</div>