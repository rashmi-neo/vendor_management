@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Show Requirement</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('requirements.index') }}">Requirement</a></li>
            <li class="breadcrumb-item active">Show</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="col-12 col-sm-12">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <div class="float-right">
                <a class="btn btn-md btn-primary" href="{{ route('requirements.index') }}"> Back</a>
            </div>
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
                        <th>From Date</th>
                        <td>: {{date("jS-F-Y", strtotime($showRequirementDetails->from_date))}}
                        </td>
                    </tr>
                    <tr>
                        <th>To  Date</th>
                        <td>: {{date("jS-F-Y", strtotime($showRequirementDetails->to_date))}}</td>
                    </tr>
                    <tr>
                        <th>Budget</th>
                        <td>: {{ empty($showRequirementDetails->budget)? "-":$showRequirementDetails->budget}}</td>
                    </tr>
                    <tr>
                        <th>Spacial Remark</th>
                        <td>: {{ empty($showRequirementDetails->comment)? "-":$showRequirementDetails->comment}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>:  {{ empty($showRequirementDetails->description)? "-":$showRequirementDetails->description}}</td>
                    </tr>
                    <tr>
                        <th>Spacial Remark</th>
                        <td>: {{ empty($showRequirementDetails->comment)? "-":$showRequirementDetails->comment}}</td>
                    </tr>
                    <tr>
                        <th>Proposal Document(if any)</th>
                        @if($showRequirementDetails->proposal_document != "")
                        <td>: <a href="{{ url('/') }}/uploads/{{ $showRequirementDetails->proposal_document }}">{{ $showRequirementDetails->proposal_document }} <i class="fa fa-download" aria-hidden="true"></i></a></td>
                        @else
                        <td>: - </td>
                        @endif
                    </tr>
                    <tr>
                        <th>Prority</th>
                        <td>: {{ empty($showRequirementDetails->priority)? "-":$showRequirementDetails->priority}}</td>
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
                            <td>{{ $vendor->first_name .' '.$vendor->last_name }}</td>
                            <td>{{ $vendor->mobile_number }}</td>
                            <td class="text-center">
                                <a href="{{ url('admin/requirements/showQuotation/'.$showRequirementDetails->id.'/'.$vendor->assign_vendors_id)}}" rel="tooltip" title="Show Quatation Details" class="edit btn btn-success btn-sm viewRequirement"><i class="fas fa-eye"></i></a>&nbsp;
                            </td>
                        <tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="paymentTab" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
            <div class="float-right m-1">
            <button href="#"  data-id=" {{ $showRequirementDetails->code }}"  onclick="openPaymentModal({{$showRequirementDetails->id}},{{ $approvedQuotationVendorId}})" class="uploadPaymentReceipt btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadPaymentReceipt" rel="tooltip" title="Upload Payment Receipt"><i class="fas fa-plus"></i></button>&nbsp;
            </div>
            <table id="assignVendorTable1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th>SrNo</th>
                        <th>Vendor Name</th>
						<th>Payment date</th>
						<th>Amount</th>
						<th>Payment File</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!empty($getPaymentreceipt))
                        <tr>
                        <td>{{ $getPaymentreceipt->id }}</td>
                        <td>{{ $getPaymentreceipt->vendor->first_name . ' '.$getPaymentreceipt->vendor->last_name }}</td>
                            <td>{{ $getPaymentreceipt->payment_date }}</td>
                            <td>{{ $getPaymentreceipt->amount }}</td>
                            <td>
                            <a href="{{ url('/') }}/uploads/{{ $getPaymentreceipt->receipt }}">{{ $getPaymentreceipt->receipt }} <i class="fa fa-download" aria-hidden="true"></i></a>
                            </td>
                        <tr>
                    </tbody>
                    @else                        
                    <tbody>
                    <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty text-center">No data available in table</td>
                    </tr>
                    </tbody>
                    @endif
            </table>
            </div>
        </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.Payment upload modal -->
{!! Form::open(['class' => 'form-horizontal', 'id'=>'PaymentForm',
'method' => 'post','data-parsley-validate' => 'parsley','enctype' =>'multipart/form-data']) !!}
   @csrf
   <div class="modal fade" id="uploadPaymentReceipt"aria-modal="true">
    <input type="hidden" value="" id="vendor_id" name="vendor_id">
    <input type="hidden" value="" id="requirement_id" name="requirement_id">
      <div class="modal-dialog modal-md">
         <div class="modal-content">
            <div class="modal-header headerModal">
               <h4 class="modal-title">Payment Detail</h4>
               <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group mb-3">
                    {!! Form::label('Receipt','Payment Receipt:',['class'=>"col-sm-5 required col-form-label"],false) !!} 
                    {!! Form::file('payment_file', array('class' => 'form-control ','id' => 'paymentFile',
                    'placeholder' => 'Payment file',
                    'data-parsley-required' => 'true',
                    'data-parsley-required-message' => 'Please upload payment receipt',
                    'data-parsley-trigger' => "input",
                    'data-parsley-trigger'=>"blur",
                    'data-parsley-extension'=>'pdf')) !!}
                    <span class="text-danger error-payment-receipt" role="alert">
                    </span> 
               </div>
               <div class="form-group mb-3">
                    {!! Form::label('amount','Amount:',['class'=>"col-sm-5 required col-form-label"],false) !!} 
                    {!! Form::text('amount',null,['class' => 'form-control ','id' => 'amount','placeholder' => 'Amount','data-parsley-required' => 'true',
                    'data-parsley-required-message' => 'Please add amount',
                    'data-parsley-trigger' => "input",
                    'data-parsley-minlength' => '2',
                    'data-parsley-type'=>"digits",
                    'data-parsley-maxlength' => '1000',
                    'data-parsley-trigger'=>"blur"]) !!}
                    <span class="text-danger error-amount" role="alert">
                    </span> 
                </div>
                <div class="form-group mb-3">
                    {!! Form::label('payment_date','Payment Date:',['class'=>"col-sm-5 required col-form-label"],false) !!} 
                    {!! Form::text('payment_date',null,['class' => 'form-control','id' => 'paymentDate','placeholder' => 'Payment Date','data-parsley-required' => 'true',
                    'data-parsley-required-message' => 'Please add Payment date',
                    'data-parsley-trigger' => "input",
                    'data-parsley-trigger'=>"blur"]) !!}
                    <span class="text-danger error-payment-date" role="alert">
                    </span> 
                </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               {!! Form::button('Save', ['type' => 'button','id'=>'uploadReceipt','class' => 'btn btn-primary'] ) !!}
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
{!! Form::close() !!}
@endsection
@section('scripts')
<script>
    function openPaymentModal(requirementId,vendorId){
            $("#uploadPaymentReceipt").modal('show');
            $("#vendor_id").val(vendorId);
            $("#requirement_id").val(requirementId);
    }

    $(function(){
        var today = new Date();
        $('#paymentDate').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
            format: 'YYYY-MM-DD'
            },
        });
    });

    $("#uploadReceipt").click(function (e) {
        var form = $('#PaymentForm');
        form.parsley().validate();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        e.preventDefault();
        var vendorId = $("#vendor_id").val();
        var requirementId = $("#requirement_id").val();
        var paymentDate = $("#paymentDate").val();
        var amount = $("#amount").val();
        
        var fileData =  $("#paymentFile").prop('files')[0];
        var formData = new FormData();
        formData.append('vendor_id', vendorId);
        formData.append('requirement_id', requirementId);
        formData.append('payment_file',fileData);
        formData.append('payment_date',paymentDate);
        formData.append('amount',amount);
        
        if(form.parsley().isValid()){
            $.ajax({
                type: "POST",
                url: "{{route('upload.payment.receipt')}}",
                contentType: false,
                async:false,
                processData:false,
                data:formData,
                dataType: "json",
                success: function(result){
                    
                if(result){ 
                $('#uploadPaymentReceipt').modal('hide');
                    toastr.success(result.message);
                    setTimeout(function () {
                    location.reload(true);
                }, 2000);
                }
                },
                error:function(result){
                    if(typeof result.responseJSON.errors.payment_file != "undefined"){
                    let payment_file = (result.responseJSON.errors.payment_file[0]);
                    $('.error-payment-receipt').html(payment_file);
                    }else{
                    $('.error-payment-receipt').empty();
                    }
                    if(typeof result.responseJSON.errors.amount != "undefined"){
                    let amount = (result.responseJSON.errors.amount[0]);
                    $('.error-amount').html(amount);
                    }else{
                    $('.error-amount').empty();
                    }
                    if(typeof result.responseJSON.errors.payment_date != "undefined"){
                    let payment_date = (result.responseJSON.errors.payment_date[0]);
                    $('.error-payment-date').html(payment_date);
                    }else{
                    $('.error-payment-date').empty();
                    }
                }
            });
        }
    });

    $('#uploadPaymentReceipt').on('hidden.bs.modal', function() {  
        $('#amount').val("");
        $('input[type="file"]').val("");
        $('.parsley-required').empty();
        $('.parsley-extension').empty();
        $('.parsley-error').removeClass('parsley-error');
        $('.parsley-success').removeClass('parsley-success');
        $('.parsley-minlength').empty();
        $('.parsley-type').empty();
    });

    window.ParsleyValidator.addValidator('extension', function (value, requirement) {
        		var tagslistarr = requirement.split(',');
            var fileExtension = value.split('.').pop();
						var arr=[];
						$.each(tagslistarr,function(i,val){
   						 arr.push(val);
						});
            if(jQuery.inArray(fileExtension, arr)!='-1') {
              return true;
            } else {
              return false;
            }
        }, 32)
    .addMessage('en', 'extension', 'The extension should be pdf only.');

</script>
@endsection
