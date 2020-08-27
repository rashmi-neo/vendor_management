@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark"> View Document</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
			   <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('vendors.index') }}">Vendor</a></li>
            <li class="breadcrumb-item active">View</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<!-- Document Entries Column -->
<div class="col-md-12">
   <!-- Document  -->
   <div class="card mb-4">
      <div class="card-header">
         <h3 class="card-title">View Document </h3>
         <div class="float-right">
            <a class="btn btn-primary" href="{{ route('vendors.index') }}"> Back</a>
         </div>
      </div>
      <div class="card-body"> 
         <table id="accountTable" class="table table-bordered table-hover">
            <thead>
               <tr>
                  <th>Document Name</th>
                  <th>Mandatory</th>
                  <th>Status</th>
                  <th>Reason</th>
                  <th>File</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach($documents as $document)
               @if(isset($document->vendorDocument))
               <tr>
                  <td>{{$document->name}}</td>
                  <td>{{ucfirst($document->is_mandatory)}}</td>
                  <td>{{isset($document->vendorDocument->status)?$document->vendorDocument->status:"-"}}</td>
                  <td>{{isset($document->vendorDocument->reason)?$document->vendorDocument->reason:"-"}}</td>
                  <td> <a href="{{ url('/') }}/uploads/{{ $document->vendorDocument->file_name }}">{{$document->vendorDocument->file_name }} <i class="fa fa-download" aria-hidden="true"></i></a></td>
                  <td width="150" class="text-center">
                  <span class="ml-1">
                        <button href="#" class="btn btn-primary btn-sm"  rel="tooltip" title="Add Reason" onclick="openReasonModal({{ $document }})" {{ isset($document->vendorDocument->reason) ? "disabled" : "" }}><i class="fas fa-pencil-alt"></i></button></span>
                  <span class="ml-1">
                        <button href="#" class="btn btn-info btn-sm"  rel="tooltip" title="Change Status" onclick="openStatusModal({{ $document }})" {{ ($document->vendorDocument->status == "Approved") ? "disabled" : "" }}><i class="fas fa-exclamation-circle"></i></button></span>
                  </td>
                  </tr>
                  @endif
                  @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>

<div class="modal fade" id="reasonModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
                <form method="POST"  data-parsley-validate="parsley" id="DocumentReasonForm">
                @csrf
                <div class="modal-header headerModal">
                <h4 class="modal-title">Add Reason</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <input type="hidden" value="" id="vendorId" name="vendorId">
                <input type="hidden" value="" id="documentId" name="documentId">
                <div class="form-group">
                    <div>
                    {!! Form::label('Reason', 'Reason :',['class' => 'col-sm-3 label_class']) !!}
                    {!! Form::textarea('reason',null,['class' => 'form-control ','placeholder' => 'Reason','id'=>'reason', 'data-parsley-required' => 'true',
                    'data-parsley-required-message' => 'Please add reason',
                    'data-parsley-trigger' => "input",
                    'data-parsley-minlength' => '2',
                    'data-parsley-maxlength' => '1000',
                    'data-parsley-trigger'=>"blur"]) !!}
                    <span class="text-danger error-reason" role="alert">
                        </span> 
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="addReason" >Save</button>
            </div>
        </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- /.Document status modal -->
<div class="modal hide fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <form method="POST"  data-parsley-validate="parsley">
            <div class="modal-content">
                <div class="modal-header headerModal">
                <h4 class="modal-title">Update status</h4>
                <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                @csrf
                <input type="hidden" value="" id="vendorId" name="vendorId">
                <input type="hidden" value="" id="documentId" name="documentId">
                <div class="modal-body">
                <div class="form-group">
                    <div>
                    {!! Form::label('status','Status:',['class'=>"col-sm-2 col-form-label"],false) !!} 
                    <select id="status" class="form-control" name="status">
                        <option value="Pending">Pending</option>
                        <option value="Approved" >Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="updateStatus" >Save</button>
            </div>
        </form>
    </div>
        <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->


@endsection

@section('scripts')
<script type="text/javascript">
   
   function openStatusModal(data)
      {
         $('#status option:selected').removeAttr('selected');
         $("#modal1").modal('show');
         $("#vendorId").val(data.vendor_document.vendor_id);
         $("#documentId").val(data.vendor_document.id);
         var status = data.vendor_document.status;
         $("select option[value='" + status + "']").attr("selected","selected");
      }

   function openReasonModal(data)
    {
      $("#vendorId").val(data.vendor_document.vendor_id);
      $("#documentId").val(data.vendor_document.id);
      $("#reasonModal").modal('show');
    }

   $("#updateStatus").click(function (e) {
      
      $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      e.preventDefault();
      var vendorId = $("#vendorId").val();
      var status = $("#status").val();
      var documentId = $("#documentId").val();

         $.ajax({
         type: "POST",
         url: "{{ route('update.document.status') }}",
         data:{'vendorId':vendorId,'status':status,'documentId':documentId},
         dataType: "json",
         success: function(result){
            if(result.success == true){
               $('#modal1').modal('hide');
               toastr.success(result.message);
               setTimeout(function () {
                  location.reload(true);
               }, 2000);
            }

            if(result.success == false){
               $('#modal1').modal('hide');
               toastr.error(result.message);
               setTimeout(function () {
                  location.reload(true);
               }, 2000);
            }
         }
      });
   });

   $("#addReason").click(function (e) {
      
      $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      e.preventDefault();
      var vendorId = $("#vendorId").val();
      var reason = $("#reason").val();
      var documentId = $("#documentId").val();

      var form = $('#DocumentReasonForm');
      form.parsley().validate();

      if(form.parsley().isValid()){
         $.ajax({
            type: "POST",
            url: "{{ route('add.document.reason') }}",
            data:{'vendorId':vendorId,'reason':reason,'documentId':documentId},
            dataType: "json",
            success: function(result){
               if(result.success == true){
                  $('#reasonModal').modal('hide');
                  toastr.success(result.message);
                  setTimeout(function () {
                     location.reload(true);
                  }, 2000);
               }

               if(result.success == false){
                  $('#reasonModal').modal('hide');
                  toastr.error(result.message);
                  setTimeout(function () {
                     location.reload(true);
                  }, 2000);
               }
            },
            error:function(result){
               if(typeof result.responseJSON.errors.reason != "undefined"){
               let reason = (result.responseJSON.errors.reason[0]);
               $('.error-reason').html(reason);
               }else{
               $('.error-reason').empty();
               }
            }
         });
      }        
   });

   $('#reasonModal').on('hidden.bs.modal', function() {
      
      $('#reason').val("");
      $('.parsley-required').empty();
      $('.parsley-error').removeClass('parsley-error');
      $('.parsley-minlength').empty('');
      $('.parsley-maxlength').empty('');
      $('.error-reason').empty('');
      $('.parsley-success').removeClass('parsley-success');

   });
</script>
@endsection