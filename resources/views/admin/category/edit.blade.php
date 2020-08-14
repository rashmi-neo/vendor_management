@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Category</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
         	<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Category</a></li>
            <li class="breadcrumb-item active">Edit</li>
         </ol> 
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="col-md-10">
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Edit Category</h3>
		</div>
		<div class="card-body">
			{!! Form::model($category,['route' =>  ['categories.update', $category->id],'class' => 'form-horizontal',
            'method' => 'put','data-parsley-validate' => 'parsley']) !!}
            	@csrf
				<input type="hidden" name="id" value="{{ $category->id}}">
				<div class="form-group row">
					 <label for="inputName" class="col-sm-2 required col-form-label">Name :</label>
					 	<div class="col-sm-8">
						 {!! Form::text('name', $category->name, ['class' => 'form-control ','placeholder' => 'Category Name',
							'data-parsley-required' => 'true',
							'data-parsley-required-message' => 'Category name is required',
							'data-parsley-trigger' => "input",
							'data-parsley-trigger'=>"blur",
							'data-parsley-pattern'=>"/^[ A-Za-z_@./:#&+-]*$/",
							'data-parsley-minlength' => '2',
							'data-parsley-maxlength' => '50']) !!}
							@error('name')
								<span class="text-danger errormsg" role="alert">
								<p>{{ $message }}</p>
								</span>
							@enderror
	                    </div>
				</div>
				<div class="form-group row">
					<label for="inputStatus" class="col-sm-2 required col-form-label">Status :</label>
					<div class="form-check ml-1 mt-2">
						{{ Form::radio('status', '1', false, array('class'=>'form-check-input','id'=>'activeCheck')) }}
						{{ Form::label('status', 'Active',array('class'=>'form-check-label')) }}
					</div>
					<div class="form-check ml-3 mt-2">
						{{ Form::radio('status', '0', false, array('class'=>'form-check-input','id'=>'inactiveCheck')) }}
						{{ Form::label('status', 'Inactive',array('class'=>'form-check-label')) }}
					</div>
				</div>
				<div class="form-group row">
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



