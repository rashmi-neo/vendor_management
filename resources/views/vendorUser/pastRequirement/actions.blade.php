
<a href="{{ route('past.requirement.show', $row->id)}}" rel="tooltip" title="Show" class="show btn btn-success btn-sm"><i class="fas fa-eye"></i></a>&nbsp;


<?php         
$assignVendor = App\Model\AssignVendor::with('requirement','vendorQuotation')
->where('requirement_id',$row->id)
->whereIn('vendor_id',[$vendorId->id])->first();
?>

@if(sizeof($assignVendor->vendorQuotation) > 0)
	<a href="{{ url('vendor/past/requirements/showQuotationDetails/'.$row->id.'/'.$assignVendor->id)}}"  rel="tooltip" title="Show Quotation Detail" class="view btn btn-secondary btn-sm viewQuotation">	<i class="fas fa-file"></i></a>&nbsp;
@endif