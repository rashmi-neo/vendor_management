@extends('layouts.master')
@section('main-content')
<div class="col-12 col-sm-12">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header">
			<h3 class="card-title">Quatation Details</h3>
            <div class="float-right">
                <a class="btn btn-md btn-primary" href="{{ route('requirements.index') }}"> Back</a>
            </div>
		</div>
        <div class="card-body">
            <div class="" id="assignVendorTab" role="tabpanel" aria-labelledby="assignVendorTabId">
                <table id="assignVendorTable1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SrNo</th>
                            <th>Quatation Document</th>
                            <th>Comment</th>
                            <th>Admin Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($showQuotationDetails as $key=>$quotation)
                        <tr>
                            <td>{{ $key+1 }}</td>
                                @if($quotation->quotation_doc != "")

                                <td> <a href="{{ url('/') }}/uploads/{{ $quotation->quotation_doc }}">{{ $quotation->quotation_doc }} <i class="fa fa-download" aria-hidden="true"></i></a></td>
                                @else
                                <td>: </td>
                                @endif
                            <td>{{ empty($quotation->comment)?"-":$quotation->comment}}</td>
                            <td>{{ empty($quotation->admin_comment)? "-":$quotation->admin_comment}}</td>
                            <td>
                                {{-- <button type="button" class="edit btn btn-primary btn-sm" title="add comment" onclick="openCommentModal({{ $vendor->vendor_id }},{{ $vendor->assign_vendors_id }})" id="comment_{{ $vendor->vendor_id }}" ><i class="fas fa-pencil-alt"></i></button> --}}
                              @if ($quotation->admin_comment == "" || $quotation->admin_comment == null)
                              <button type="button" class="edit btn btn-primary btn-sm" onclick="openCommentModal({{ $quotation->id }},{{ $quotation->assign_vendor_id }})" id="comment_{{ $quotation->assign_vendors_id }}" ><i class="fas fa-pencil-alt"></i></button>

                              @else
                              <button type="button" class="edit btn btn-primary btn-sm"  id="comment_{{ $quotation->assign_vendors_id }}" disabled><i class="fas fa-pencil-alt"></i></button>

                              @endif

                                {{-- <a href="{{ route('requirements.edit', $quotation->assign_vendors_id)}}" rel="tooltip" title="Edit" class="edit btn btn-primary btn-sm editRequirement"><i class="fas fa-pencil-alt"></i></a>&nbsp; --}}
                                {{-- <a href="{{ url('admin/showAssignVendors/'.$quotation->assign_vendors_id)}}" rel="tooltip" title="Show" class="edit btn btn-success btn-sm viewRequirement"><i class="fas fa-eye"></i></a>&nbsp; --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.modal -->

      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            {{-- <form method="POST"  action="{{ route('addComment',$showRequirementDetails->id) }}" data-parsley-validate="parsley"> --}}
                <form method="POST"  data-parsley-validate="parsley">
                @csrf
                @method('PUT')
                <input type="hidden" value="" id="quotationId" name="quotationId">
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
                    {!! Form::label('comment', 'Comment',['class' => 'col-sm-3 label_class']) !!}
                    {!! Form::textarea('comment',null,['class' => 'form-control ','placeholder' => 'Comment','id'=>'comment', 'data-parsley-required' => 'true',
                    'data-parsley-required-message' => 'Please add comment',
                    'data-parsley-trigger' => "input",
                    'data-parsley-minlength' => '2',
                    'data-parsley-maxlength' => '1000',
                    'data-parsley-trigger'=>"blur"]) !!}
                     @error('comment')
                     <span class="text-danger errormsg" role="alert">
                        <p>{{ $message }}</p>
                     </span>
                     @enderror
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
@endsection
@section('scripts')
<script>
    function openCommentModal(id,assignVendorId)
    {
        $("#modal-lg").modal('show');
        $("#quotationId").val(id);
        $("#assignVendorId").val(assignVendorId);
    }

    $("#addComment").click(function (e) {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        e.preventDefault();
        var quotationId = $("#quotationId").val();
        var comment = $("#comment").val();
        var assignVendorId = $("#assignVendorId").val();
        if(quotationId !="" && comment !="" && assignVendorId !="")
        {
            $.ajax({
            type: "POST",
            url: "../../addComment",
            data:{'id':quotationId,'comment':comment,'assignVendorId':assignVendorId},
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
</script>
@endsection
