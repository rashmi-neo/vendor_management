

<div class="form-group">
	<div class="row">
	<span>
		@if($row->from_date<= $currentDate && $currentDate <= $row->to_date)
		<button href="#" onclick="openQuotationModal({{$row}})"  class="uploadQuotation btn btn-primary btn-sm" 
		data-toggle="modal" data-target="#uploadQuotation" rel="tooltip" title="Upload Quotation">
		<i class="fas fa-plus"></i></button>&nbsp;
		@else
		<button href="#" class="uploadQuotation btn btn-primary btn-sm" rel="tooltip" title="Upload Quotation" disabled>
		<i class="fas fa-plus"></i></button>&nbsp;
		@endif
	</span>&nbsp;
	<span> <a href="{{ route('new.requirement.show', $row->id)}}" rel="tooltip" title="Show Requirement" class="view btn btn-success btn-sm viewNewRequirement"><i class="fas fa-eye"></i></a>&nbsp;</span>&nbsp;
	<span>  
	<?php         
	$assignVendor = App\Model\AssignVendor::with('requirement','vendorQuotation')
	->where('requirement_id',$row->id)
	->whereIn('vendor_id',[$vendorId->id])->first();
	?>
	@if(sizeof($assignVendor->vendorQuotation) > 0)
		<a href="{{ url('vendor/new/requirements/showQuotationDetail/'.$row->id.'/'.$assignVendor->id)}}"  rel="tooltip" title="Show Quotation Detail" class="view btn btn-secondary btn-sm viewQuotation">	<i class="fas fa-file"></i></a>&nbsp;
	@endif</span>&nbsp;
    </div>
</div>
