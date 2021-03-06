<div class="form-group">
	<div class="row">
		<a href="{{ route('vendors.edit', $row->id)}}" rel="tooltip" title="Edit" class="edit btn btn-primary btn-sm editVendor"><i class="fas fa-pencil-alt"></i></a>&nbsp;
		<a href="{{ route('vendors.show', $row->id)}}" rel="tooltip" title="Show" class="view btn btn-success btn-sm viewVendor"><i class="fas fa-eye"></i></a>&nbsp;
		<span class="ml-1">
        <button href="#" class="btn btn-info btn-sm"  rel="tooltip" title="Change Status" onclick="openStatusModal({{ $row }})" {{ ($row->user->is_verified == "approved") ? "disabled" : "" }}><i class="fas fa-exclamation-circle"></i></button></span>
		
		@if(!$row->document->isEmpty())
		<span class="ml-1">
		<a href="{{ route('vendors.document.show', $row->id)}}" rel="tooltip" title="Show Document" class="view btn btn-secondary btn-sm"><i class="fas fa-file"></i></a>&nbsp;
		</span>
		@endif
	</div>
</div>


