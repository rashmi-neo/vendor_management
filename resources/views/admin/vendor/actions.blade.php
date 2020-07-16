<div class="form-group">
	<div class="row">
		<a href="{{ route('vendors.edit', $row->id)}}" rel="tooltip" title="Edit" class="edit btn btn-primary btn-sm editVendor"><i class="fas fa-pencil-alt"></i></a>&nbsp;
		<a href="{{ route('vendors.show', $row->id)}}" rel="tooltip" title="Show" class="view btn btn-success btn-sm viewVendor"><i class="fas fa-eye"></i></a>&nbsp;
    </div>
</div>