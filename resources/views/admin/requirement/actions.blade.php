<div class="form-group">
	<div class="row">
		<span><a href="{{ route('requirements.edit', $row->id)}}" rel="tooltip" title="Edit" class="edit btn btn-primary btn-sm editRequirement"><i class="fas fa-pencil-alt"></i></a></span>&nbsp;
        <span><a href="{{ route('requirements.show', $row->id)}}" rel="tooltip" title="Show" class="edit btn btn-success btn-sm viewRequirement"><i class="fas fa-eye"></i></a></span>
        <span class="ml-1">
        <a href="#" class="btn btn-info btn-sm"  rel="tooltip" title="Change Status" onclick="openStatusModal({{ $row }})" id=""><i class="fas fa-exclamation-circle"></i></a></span>
        @if($row->status =="Completed")
        @if(!empty($row->reviewRating->rating))
        <span class="ml-1"><button href="#" style="background-color:tomato;color:white" 
        class="btn btn-sm" rel="tooltip" title="review and rating" disabled><i class="fa fa-star"></i></button></span>
        @else
        <span class="ml-1"><button href="#" style="background-color:tomato;color:white" 
        class="btn btn-sm" rel="tooltip" title="Give review and rating" onclick="openRatingModal({{ $row }})"><i class="fa fa-star"></i></button></span>
        @endif 
        @endif    

    </div>
</div>
