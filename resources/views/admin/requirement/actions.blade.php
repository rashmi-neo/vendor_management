<div class="form-group">
	<div class="row">
		<span><a href="{{ route('requirements.edit', $row->id)}}" rel="tooltip" title="Edit" class="edit btn btn-primary btn-sm editRequirement"><i class="fas fa-pencil-alt"></i></a></span>&nbsp;
        <span><a href="{{ route('requirements.show', $row->id)}}" rel="tooltip" title="Show" class="edit btn btn-success btn-sm viewRequirement"><i class="fas fa-eye"></i></a></span>
    </div>
</div>
