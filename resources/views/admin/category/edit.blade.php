@extends('layouts.master')
@section('main-content')
<div class="col-md-10">
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Edit Category</h3>
		</div>
		<div class="card-body">
			{!! Form::model($category,['route' =>  ['categories.update', $category->id],'class' => 'form-horizontal',
            'method' => 'put']) !!}
            	@csrf
				<input type="hidden" name="id" value="{{ $category->id}}">
				<div class="form-group row">
					 <label for="inputName" class="col-sm-2 col-form-label">Name</label>
					 	<div class="col-sm-8">
						 {!! Form::text('name', $category->name, ['class' => 'form-control ','placeholder' => 'Category Name',
							'data-parsley-required' => 'true',
							'data-parsley-required-message' => 'Category name is required',
							'data-parsley-trigger' => "input",
							'data-parsley-trigger'=>"blur",
							'data-parsley-maxlength' => '50']) !!}
							@error('name')
								<span class="text-danger errormsg" role="alert">
								<p>{{ $message }}</p>
								</span>
							@enderror
	                    </div>
				</div>
				<div class="form-group row">
					 <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
					 	<div class="col-sm-2">
					 		<div class="form-check">
								{{ Form::radio('status', '1', false, array('class'=>'form-check-input','id'=>'activeCheck')) }}
								{{ Form::label('status', 'Active',array('class'=>'form-check-label')) }}
					 		</div>
					 	</div>
					 	<div class="col-sm-1">
					 		<div class="form-check">
								{{ Form::radio('status', '0', false, array('class'=>'form-check-input','id'=>'inactiveCheck')) }}
								{{ Form::label('status', 'Inactive',array('class'=>'form-check-label')) }}
					 		</div>
					 	</div>
				</div>
				 <div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-6">	
						{!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}
						 <a href="{{route('categories.index')}}" class="btn btn-default">Cancel</a>
					</div>
				</div>      
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection