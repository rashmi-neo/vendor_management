@extends('layouts.master')
@section('main-content')
<div class="col-12 col-sm-12">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#requirementDetailsTab" role="tab" aria-controls="requirementDetailsTab" aria-selected="true">Requirement Details</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="assignVendorTabId" data-toggle="pill" href="#assignVendorTab" role="tab" aria-controls="assignVendorTab" aria-selected="false">Assign Vendor</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#paymentTab" role="tab" aria-controls="paymentTab" aria-selected="false">Payment</a>
            </li>
        </ul>
        </div>
        <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade show active" id="requirementDetailsTab" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                <input type="hidden" value="{{ $showRequirementDetails->id }}" id="requirementId" name="requirementId">
                <table>
                    <tr>
                        <th>Requirement ID</th>
                        <td>: {{ $showRequirementDetails->code }}</td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>: {{ $showRequirementDetails->title }}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>: {{ $showRequirementDetails->category->name }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>: {{ $showRequirementDetails->description }}</td>
                    </tr>
                    <tr>
                        <th>Spacial Remark</th>
                        <td>: {{ $showRequirementDetails->comment }}</td>
                    </tr>
                    <tr>
                        <th>Proposal Document(if any)</th>
                        @if($showRequirementDetails->proposal_document != "")
                        <td>: <a href="{{ url('/') }}/uploads/{{ $showRequirementDetails->proposal_document }}">{{ $showRequirementDetails->proposal_document }} <i class="fa fa-download" aria-hidden="true"></i></a></td>
                        @else
                        <td>: </td>
                        @endif
                    </tr>
                    <tr>
                        <th>Prority</th>
                        <td>: {{ $showRequirementDetails->priority }}</td>
                    </tr>
                </table>
            </div>
            <div class="tab-pane fade table-responsive p-0" id="assignVendorTab" role="tabpanel" aria-labelledby="assignVendorTabId">
                <table id="assignVendorTable1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SrNo</th>
                            <th>Request Id</th>
                            <th>Title</th>
                            <th>Vendor Name</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ dd($requirementVendors) }} --}}
                        @foreach ($requirementVendors as $key=>$vendor)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $vendor->code }}</td>
                            <td>{{ $vendor->title }}</td>
                            <td>{{ $vendor->first_name }}</td>
                            <td>{{ $vendor->mobile_number }}</td>
                            <td>
                                <a href="{{ url('admin/showAssignVendors/'.$showRequirementDetails->id.'/'.$vendor->assign_vendors_id)}}" rel="tooltip" title="Show" class="edit btn btn-success btn-sm viewRequirement"><i class="fas fa-eye"></i></a>&nbsp;
                            </td>
                        <tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="paymentTab" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                222Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
            </div>
            <!-- /.modal -->

      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            {{-- <form method="POST"  action="{{ route('addComment',$showRequirementDetails->id) }}" data-parsley-validate="parsley"> --}}
                <form method="POST"  data-parsley-validate="parsley">
                @csrf
                @method('PUT')
                <input type="hidden" value="" id="vendorId" name="vendorId">
                <input type="hidden" value="" id="assignVendorId" name="assignVendorId">
                <div class="modal-header">
                <h4 class="modal-title">Add Comment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                    <div>
                    <label>Comment</label>
                    <textarea class="form-control" id="comment" name="comment" required></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="addComment" >Save</button>
            </div>
        </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
        </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
@section('scripts')
<script>
    function openCommentModal(id,assignVendorId)
    {
        $("#modal-lg").modal('show');
        $("#vendorId").val(id);
        $("#assignVendorId").val(assignVendorId);
    }

    $("#addComment").click(function (e) {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        e.preventDefault();
        var vendorId = $("#vendorId").val();
        var comment = $("#comment").val();
        var assignVendorId = $("#assignVendorId").val();
        if(vendorId !="" && comment !="" && assignVendorId !="")
        {
            $.ajax({
            type: "POST",
            url: "addComment",
            data:{'id':vendorId,'comment':comment,'assignVendorId':assignVendorId},
            dataType: "json",
            success: function(result){
             if(result)
             {
                $('#modal-lg').modal('hide');
                toastr.success('Comment added successfully');
                setTimeout(function () {
                    location.reload(true);
                }, 2000);
             }
            }});
        }
        else
        {
            toastr.error('Please add comment');
        }
    });

    // $("#assignVendorTabId").click(function (e) {
    //     e.preventDefault();
    //     var requirementId = $("#requirementId").val();
	// 	var table = $('#assignVendorTable1').DataTable({
	// 		processing: true,
	// 		serverSide: true,
	// 		bLengthChange: false,
    //         destroy: true,
    //       //  ajax: "{{ route('requirements.index') }}",
    //     	 ajax: "{{ route('requirements.show',"+requirementId+") }}",
    //         // ajax: "requirementsData/"+requirementId,
	// 		columns: [
    //             {data: 'DT_RowIndex', name: 'DT_RowIndex'},
    //             {data: 'title', name: 'title'},
    //             {data: 'category_id', name: 'category'},
    //             {data: 'priority', name: 'priority'},
    //             {data: 'created_at', name: 'date'},
    //             {data: 'status', name: 'status'},
    //             {data: 'action', name: 'action'},
	// 		]
	// 	});
    // });
</script>
@endsection
