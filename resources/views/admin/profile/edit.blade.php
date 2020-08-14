@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">My Account</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
   		 	<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">My Account</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="col-md-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title">My Account</h3>
      </div>
      <div class="card-body">
            {!! Form::model($user,['route' =>  ['profiles.update', $user->id],'class' => 'form-horizontal',
            'method' => 'post','data-parsley-validate' => 'parsley']) !!}
            @csrf
            @method('PUT')
            <div class="form-group row">
            {!! Form::label('user_name','Username :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
               <div class="col-sm-8">
                  {!! Form::text('username', $user->username, ['class' => 'form-control ','placeholder' => 'Username',
                  'data-parsley-required' => 'true',
                  'data-parsley-required-message' => 'Username is required',
                  'data-parsley-trigger' => "input",
                  'data-parsley-trigger'=>"blur",
                  'data-parsley-maxlength' => '50']) !!}
                  
                  @error('username')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               {!! Form::label('email','Email :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
               <div class="col-sm-8">
                  {!! Form::email('email', $user->email, ['class' => 'form-control ','placeholder' => 'Email Address',
                  'data-parsley-required' => 'true',
                  'data-parsley-required-message' => 'Email address is required',
                  'data-parsley-trigger' => "input",
                  'data-parsley-trigger'=>"blur",
                  'data-parsley-maxlength' => '50']) !!}
                  
                  @error('email')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               {!! Form::label('current_password','Current Password :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
               <div class="col-sm-8">
                  {!! Form::password('current_password', ['class' => 'form-control ','placeholder' => 'Current Password',
                  'data-parsley-required' => 'true',
                  'data-parsley-required-message' => 'Password is required',
                  'data-parsley-trigger' => "input",
                  'data-parsley-trigger'=>"blur",
                  'data-parsley-maxlength' => '100']) !!}
                  
                  @error('current_password')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               {!! Form::label('new_password','New Password :',['class'=>"col-sm-2 required  col-form-label"],false) !!} 
               <div class="col-sm-8">
                  {!! Form::password('new_password',array('class' => 'form-control','id' => 'newPassword','placeholder' => 'New  Password',
                  'data-parsley-required' => 'true',
                  'data-parsley-required-message' => 'New Password is required',
                  'data-parsley-trigger' => "input",
                  'data-parsley-trigger'=>"blur",
                  'data-parsley-maxlength' => '100')) !!}
                  
                  @error('new_password')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               {!! Form::label('confirm_password','Confirm New Password :',['class'=>"col-sm-2 required col-form-label"],false) !!} 
               <div class="col-sm-8">
                  {!! Form::password('new_confirm_password', ['class' => 'form-control','placeholder' => 'Confirm New Password',
                  'data-parsley-required' => 'true',
                  'data-parsley-required-message' => 'Confirm new password is required',
                  'data-parsley-trigger' => "input",
                  'data-parsley-equalto'=>'#newPassword',
                  'data-parsley-equalto-message' => 'Confirm new password should be same as new password',
                  'data-parsley-trigger'=>"blur",
                  'data-parsley-maxlength' => '100']) !!}
                  
                  @error('new_confirm_password')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-6">
                  {!! Form::button('Update', ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}
                  <a href="{{route('profiles.index')}}" class="btn btn-default">Cancel</a>
               </div>
            </div>
            {!! Form::close() !!}
      </div>
   </div>
</div>
@endsection

@section('scripts')
@if(session()->get('success'))
	<script>
		var message = "{{ Session::get('success') }}"
		toastr.success(message);
	</script>
@endif
@if(session()->get('error'))
	<script>
		var message = "{{ Session::get('error') }}"
		toastr.error(message);
	</script>
@endif
@endsection
