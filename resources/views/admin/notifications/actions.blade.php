@if($row->type=='Vendor register')
<a href="{{route('vendors.index')}}" class="view btn btn-success btn-sm" rel="tooltip" title="View"><i class="fas fa-eye"></i></a>&nbsp;
@endif
@if($row->type=='Vendor update')
<a href="{{route('vendors.index')}}" class="view btn btn-success btn-sm" rel="tooltip" title="View"><i class="fas fa-eye"></i></a>&nbsp;
@endif
@if($row->type=='Document update')
<a href="{{route('requirements.index')}}" class="view btn btn-success btn-sm" rel="tooltip" title="View"><i class="fas fa-eye"></i></a>&nbsp;
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