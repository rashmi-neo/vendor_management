@extends('layouts.master')
@section('main-content')
<div class="col-md-12">
   <div class="card">
      <div class="card-header" >
         <h3 class="card-title">Edit New Requirement</h3>
      </div>
      <div class="card-body"> 
            {!! Form::model($newRequirement,['route' =>  ['new.requirement.update',$newRequirement->id],'class' => 'form-horizontal',
               'method' => 'post','data-parsley-validate' => 'parsley','enctype' =>'multipart/form-data']) !!}
               @csrf
            <div class="form-group row">
               <label for="inputTitle" class="col-sm-3 label_class">Title</label>
               <div class="col-sm-7">
                  {!! Form::text('title', $newRequirement->title, ['class' => 'form-control ','placeholder' => 'First Name','readonly']) !!}
               </div>
            </div>
            <div class="form-group row">
               <label for="description" class="col-sm-3 label_class">Description</label>
               <div class="col-sm-7">
               {!! Form::textarea('description',$newRequirement->description,['class'=>'form-control', 'rows' => 2, 'cols' => 80,
                    'placeholder'=>'Brief Description','readonly']) !!}

               </div>
            </div>
            <div class="form-group row">
               <label for="description" class="col-sm-3 label_class">Special Comment</label>
               <div class="col-sm-7">
                  {!! Form::textarea('special_comment',$newRequirement->comment,['class'=>'form-control','rows' => 2, 'cols' => 80,
                    'placeholder'=>'Special Comment','readonly']) !!}
               </div>
            </div>
            <div class="form-group row">
               <label for="document" class="col-sm-3 label_class">Proposal Document(if/any)</label>
               <div class="col-sm-7">
               {{$newRequirement->proposal_document}} 
               <a href="{{route('download.document',$newRequirement->proposal_document)}}" id="download_document" class="btn btn-primary btn-sm">
               <i class="fas fa-arrow-circle-down "></i></a>&nbsp;
               </div>
            </div>
            <div class="form-group row">
               <label for="document" class="col-sm-3 label_class">Priority</label>
               <div class="col-sm-7">
               {{$newRequirement->priority}}
               </div>
            </div>
            <div class="form-group row">
               <label for="document" class="col-sm-3 label_class">Upload quotation</label>
               <div class="col-sm-7">
                  {!! Form::file('quotation', array('class' => 'form-control ','placeholder' => 'Upload Quotation',
                  'data-parsley-required' => 'true',
                  'data-parsley-required-message' => 'Please upload quotation',
                  'data-parsley-trigger' => "input",
                  'data-parsley-trigger'=>"blur")) !!}
                  @error('quotation')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               <label for="comment" class="col-sm-3 label_class">Comment</label>
               <div class="col-sm-7">
                  {!! Form::textarea('vendor_comment',null,['class'=>'form-control','rows' => 2, 'cols' => 80,
                  'placeholder'=>'Comment']) !!}
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-3"></div>
               <div class="col-sm-8">
                  <button type="submit" class="btn btn-primary col-sm-2">Save</button>
                  <a href="{{route('new.requirement.index')}}" class=" col-sm-2 btn btn-default">Cancel</a>
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
	
</script>
@endsection