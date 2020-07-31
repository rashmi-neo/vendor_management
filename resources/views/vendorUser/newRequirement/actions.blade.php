<div class="form-group">
	<div class="row">
			<a href="#" onclick="openQuotationModal({{$row}})"  class="uploadQuotation btn btn-primary btn-sm" 
    			data-toggle="modal" data-target="#uploadQuotation" rel="tooltip" title="Upload">
            <i class="fas fa-plus"></i></a>&nbsp;
		<a href="{{ route('new.requirement.show', $row->id)}}" rel="tooltip" title="Show Requirement" class="view btn btn-success btn-sm viewNewRequirement"><i class="fas fa-eye"></i></a>&nbsp;
	</div>
</div>