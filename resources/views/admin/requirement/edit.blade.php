@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Requirement</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('requirements.index') }}">Requirement</a></li>
            <li class="breadcrumb-item active">Edit</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="col-md-12">
 	<div class="card">
 		 <div class="card-header" >
			<h3 class="card-title">Edit Requirement</h3>
		 </div>
			<div class="card-body">
                {!! Form::open(['route' => ['requirements.update',$requirementEditDetails->id],'id' => 'requirementForm','class' => 'form-horizontal','method' => 'post','data-parsley-validate' => 'parsley','enctype' =>'multipart/form-data']) !!}
                @csrf
                @method('PUT')
                <div class="form-group row">
                    {!! Form::label('title','Title :',['class' => 'col-sm-3 required label_class']) !!}
                        <div class="col-sm-7">
                            {!! Form::text('title', $requirementEditDetails->title, ['class' => 'form-control','placeholder' => 'Title',
                            'data-parsley-required' => 'true',
                            'data-parsley-required-message' => 'Please enter title',
                            'data-parsley-trigger' => "input",
                            'data-parsley-trigger'=>"blur",
                            'data-parsley-pattern' => '/^[a-zA-Z ]*$/',
                            'data-parsley-pattern-message' => 'Please enter only characters',
                            'data-parsley-minlength' => '2',
                            'data-parsley-maxlength' => '50']) !!}
                           @error('title')
                         <span class="text-danger errormsg" role="alert">
                            <p>{{ $message }}</p>
                         </span>
                         @enderror
                       </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('category_id', 'Category :',['class' => 'col-sm-3 label_class']) !!}
                        <div class="col-sm-7">
                            {!! Form::select('category_id',$categories,$requirementEditDetails->category_id, array('class'=>'form-control', 'id'=>'category_id','disabled'=>'disabled','placeholder'=>'Select Category')) !!}
                           @error('category_id')
                           <span class="text-danger errormsg" role="alert">
                               <p>{{ $message }}</p>
                           </span>
                           @enderror
                        </div>
                    </div>

                    @foreach ($vendorDetails as $key=>$vendors)
                    @php $selectedVendors[]=$key @endphp
                    @endforeach

					 <div class="form-group row">
                        {!! Form::label('vendor_id', 'Select Vendors:',['class' => 'col-sm-4  label_class']) !!}

				 		<div class="col-sm-7">
                            {!! Form::select('vendor_id[]',$vendorDetails,$selectedVendors, array('class'=>'form-control vendor','multiple'=>'multiple','id'=>'vendor','disabled'=>'disabled')) !!}
                            @error('vendor_id')
                            <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                          @enderror
				 		</div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('budget', 'Budget :',['class' => 'col-sm-3 required label_class']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('budget', $requirementEditDetails->budget, ['class' => 'form-control ','placeholder' => 'Budget',
                                'data-parsley-required' => 'true',
                                'data-parsley-required-message' => 'Please enter budget',
                                'data-parsley-trigger' => "input",
                                'data-parsley-trigger'=>"blur",
                                'data-parsley-pattern' => '/^[0-9.]*$/',
                                'data-parsley-pattern-message' => 'Please enter only numbers',
                                'data-parsley-minlength' => '2',
                                'data-parsley-maxlength' => '10']) !!}
                           @error('budget')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                            </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('fromDate', 'From Date :',['class' => 'col-sm-3 required label_class']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('fromDate', $requirementEditDetails->from_date, ['class' => 'form-control ','data-date-format'=>'yyyy-mm-dd','id'=>'requirmentFromDate','placeholder' => 'Select From date',
                                'data-parsley-required' => 'true',
                                'data-parsley-required-message' => 'Please select from date',
                                'data-date-format'=>'YYYY/MM/DD',
                                'data-parsley-trigger' => "input",
                                'data-parsley-trigger'=>"blur"]) !!}
                             @error('fromDate')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                            </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('toDate', 'To Date :',['class' => 'col-sm-3 required label_class']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('toDate', $requirementEditDetails->to_date, ['class' => 'form-control ','data-date-format'=>'yyyy-mm-dd','id'=>'requirmentToDate','placeholder' => 'Select To date',
                                'data-parsley-required' => 'true',
                                'data-parsley-required-message' => 'Please select to date',
                                'data-parsley-trigger' => "input",
                                'data-date-format'=>'YYYY/MM/DD',
                                'data-date-maxDate'=>"YYYY/MM/DD",
                                'data-parsley-maxdate'=>"From date",
                                'data-parsley-trigger'=>"blur"]) !!}
                             @error('toDate')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                            </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('priority', 'Priority :',['class' => 'col-sm-3 required label_class']) !!}
                        <div class="col-sm-7">
                            {!! Form::select('priority',['Low' => 'Low', 'Medium' => 'Medium','High'=>'High'],$requirementEditDetails->priority, array('class'=>'form-control', 'placeholder'=>'Select priority', 'data-parsley-required' => 'true',
                            'data-parsley-required-message' => 'Please select priority',
                            'data-parsley-trigger' => "select",
                            'data-parsley-trigger'=>"blur")) !!}
                            @error('priority')
                             <span class="text-danger errormsg" role="alert">
                                <p>{{ $message }}</p>
                             </span>
                             @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('document', 'Proposal Document(if/any) :',['class' => 'col-sm-3 label_class']) !!}
                        <div class="col-sm-7">
                            {!! Form::file('proposal_document', array('class' => 'form-control ','placeholder' => 'Proposal Document','data-parsley-trigger' => "input",
                            'data-parsley-extension'=>'jpg,png,jpeg',
                            'data-parsley-trigger'=>"blur",'data-parsley-maxlength' => '1000')) !!}
                            <div>{{$requirementEditDetails->proposal_document}}</div>
                            @error('proposal_document')
                            <span class="text-danger errormsg" role="alert">
                               <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>
				 	<div class="form-group row">
                        {!! Form::label('description', 'Description :',['class' => 'col-sm-3 label_class']) !!}
						   <div class="col-sm-7">
                                {!! Form::textarea('description',$requirementEditDetails->description, ['class' => 'form-control ','placeholder' => 'Brief description']) !!}
						 	</div>
				 	</div>
				 	<div class="form-group row">
                        {!! Form::label('comment', 'Note/Special Comment :',['class' => 'col-sm-3 label_class']) !!}
						   <div class="col-sm-7">
                                {!! Form::textarea('comment',$requirementEditDetails->comment, ['class' => 'form-control ','placeholder' => 'Special Comment']) !!}
						 	</div>
				 	</div>
				 	<div class="form-group row">
						<div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                {!! Form::submit('Save',['class' => 'btn btn-primary col-sm-2']) !!}
                                <a href="{{route('requirements.index')}}" class=" col-sm-2 btn btn-default">Cancel</a>
                            </div>
				    </div>
                {!! Form::close() !!}
			</div>
		</div>
 	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(function(){
        $('#vendor').select2({
            theme: 'bootstrap4'
        })
    });

    $(function(){
        var today = new Date();
        $('#requirmentToDate').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minDate:today,
            locale: {
            format: 'YYYY-MM-DD'
            },
        });
    });
// append the vendors as per category id.
// $("#category").click(function (e) {
//         e.preventDefault();
//         var id= $(this).val();
//         $.ajax({
//         type: "GET",
//         url: "../vendors/"+id,
//         dataType: "json",
//         success: function(result){
//             $("#vendor").empty();
//             $.each(result,function(key,val){
//                 $("#vendor").append('<option value='+val.vendor.id+' selected>'+val.vendor.first_name+'</option>');
//             });
//          }});
//     });
</script>
<script>
    window.ParsleyValidator
    .addValidator('maxdate', function (value, requirement) {
        
        var fromDate = $('#requirmentFromDate').val();
        
        var toDate = Date.parse(value),
            startDate = Date.parse(fromDate);
            
        return isNaN(toDate) ? false : toDate >= startDate;    
    }, 32)
    .addMessage('en', 'maxdate', 'This date should be greater than or equal to  %s');
    
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
            .addMessage('en', 'extension', 'The extension should be xls,pdf,xlsx,doc,docx');

$('#requirementForm').parsley();
</script>
@endsection
