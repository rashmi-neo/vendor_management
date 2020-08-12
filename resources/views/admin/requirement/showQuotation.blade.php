@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quatation Details</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('requirements.index') }}">Requirement</a></li>
            <li class="breadcrumb-item active">Quatation Details</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="col-12 col-sm-12">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header">
			<h3 class="card-title">Quatation Details</h3>
            <div class="float-right">
                <a class="btn btn-md btn-primary" href="{{ route('requirements.show', $requirement_id) }}"> Back</a>
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
                            <th>Status</th>
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
                            <td>{{ ucfirst($quotation->status)}}</td>
                            <td>
                                {{-- <button type="button" class="edit btn btn-primary btn-sm" title="add comment" onclick="openCommentModal({{ $vendor->vendor_id }},{{ $vendor->assign_vendors_id }})" id="comment_{{ $vendor->vendor_id }}" ><i class="fas fa-pencil-alt"></i></button> --}}
                              @if ($quotation->admin_comment == "" || $quotation->admin_comment == null)
                              <button type="button" class="edit btn btn-primary btn-sm" onclick="openCommentModal({{ $quotation->id }},{{ $quotation->assign_vendor_id }})" id="comment_{{ $quotation->assign_vendors_id }}" ><i class="fas fa-pencil-alt"></i></button>
                              @else
                              <button type="button" class="edit btn btn-primary btn-sm"  id="comment_{{ $quotation->assign_vendors_id }}" disabled><i class="fas fa-pencil-alt"></i></button>
                              @endif
                              @if($quotation->status =="In process")
                              <button type="button" class="btn btn-secondary btn-sm" rel="tooltip" title="Approve" onclick="openStatusModal({{ $quotation->id }},{{ $quotation->assign_vendor_id }},{{$requirement_id}})" id="status_{{ $quotation->assign_vendors_id }}"><i class="fas fa-exclamation-circle"></i></button>
                               @elseif($quotation->status  =="Approved")
                              <button type="button" class="btn btn-success btn-sm" rel="tooltip" title="Approved"><i class="fas fa-check"></i></button>
                               @else
                              <button type="button" class="btn btn-danger btn-sm" rel="tooltip" title="Rejected"><i style="font-size: 16px;" class="fas fa-window-close"></i></button>
                              @endif
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
                <form method="POST"  data-parsley-validate="parsley" id="CommentForm">
                @csrf
                @method('PUT')
                <input type="hidden" value="" id="quotationId" name="quotationId">
                <input type="hidden" value="" id="assignVendorId" name="assignVendorId">
                <div class="modal-header headerModal">
                <h4 class="modal-title">Add Comment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                    <div>
                    {!! Form::label('comment', 'Comment',['class' => 'col-sm-3 label_class']) !!}
                    {!! Form::textarea('comment',null,['class' => 'form-control ','placeholder' => 'Comment','id'=>'comment',
                    'data-parsley-required' => 'true',
                    'data-parsley-required-message' => 'Please add comment',
                    'data-parsley-trigger' => "input",
                    'data-parsley-minlength' => '2',
                    'data-parsley-maxlength' => '1000',
                    'data-parsley-trigger'=>"blur"]) !!}
                     <span class="text-danger error-comment" role="alert">
                     </span>
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
     
      <!-- /.Quotation status modal -->
    <div class="modal fade" id="quotationStatus">
        <div class="modal-dialog modal-md">
            <form method="POST"  data-parsley-validate="parsley">
                <div class="modal-content">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="" id="quotation_id" name="quotation_id">
                    <input type="hidden" value="" id="assign_vendor_id" name="assign_vendor_id">
                    <input type="hidden" value="" id="requirement_id" name="requirement_id">
                    <div class="modal-body">
                    <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                        <div class="swal2-icon-content">!</div>
                    </div>
                    <div class="form-group">
                        <div>
                        <p style="font-size: 21px;font-family: initial;" class="ml-4">Are you sure want to approve this quotation?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="updateStatus" >Yes,approve it</button>
                </div>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>
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

    function openStatusModal(id,assignVendorId,requirementId)
    {
        $("#quotationStatus").modal('show');
        $("#quotation_id").val(id);
        $("#requirement_id").val(requirementId);
        $("#assign_vendor_id").val(assignVendorId);
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
        var form = $('#CommentForm');
        form.parsley().validate();
        if(form.parsley().isValid()){
            $.ajax({
            type: "POST",
            url: "../../addComment",
            data:{'id':quotationId,'comment':comment,'assignVendorId':assignVendorId},
            dataType: "json",
            success: function(result){
             
             if(result){ 
                $('#modal-lg').modal('hide');
                toastr.success('Comment added successfully');
                setTimeout(function () {
                    location.reload(true);
                }, 2000);
                }
                },
                error:function(result){
                    if(typeof result.responseJSON.errors.comment != "undefined"){
                    let comment = (result.responseJSON.errors.comment[0]);
                    $('.error-comment').html(comment);
                    }else{
                    $('.error-comment').empty();
                    }
                }
            });
        }
    });
    $("#updateStatus").click(function (e) {
        
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        e.preventDefault();
        var quotationId = $("#quotation_id").val();
        var status = $("#status").val();
        var assignVendorId = $("#assign_vendor_id").val();
        var requirementId = $("#requirement_id").val();

            $.ajax({
            type: "POST",
            url: "../../updateStatus",
            data:{'status':status,'id':quotationId,'assignVendorId':assignVendorId,'requirementId':requirementId},
            dataType: "json",
            success: function(result){
                
             if(result)
             {
                $('#quotationStatus').modal('hide');
                toastr.success('Status updated successfully');
                setTimeout(function () {
                    location.reload(true);
                }, 2000);
             }
            }});
    });

    $('#modal-lg').on('hidden.bs.modal', function() {
      
      $('#comment').val("");
      $('.parsley-required').empty();
      $('.parsley-error').removeClass('parsley-error');
      $('.parsley-success').removeClass('parsley-success');
      $('.parsley-minlength').empty();
      $('.error-comment').empty();

   });

</script>
@endsection
