@extends('layouts.master')
@section('main-content')
<div class="col-md-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title">Edit Profile</h3>
      </div>
      @if(session()->get('error'))
		    <div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fa fa-check"></i>{{ Session::get('error') }}
			</div><br />
  		@endif
      <div class="card-body">
         <form class="form-horizontal" method="post" action="{{ route('profiles.update', $user->id ) }}" data-parsley-validate="parsley">
            @csrf
            @method('PUT')
            <div class="form-group row">
               <label for="userName" class="col-sm-2 col-form-label">Username</label>
               <div class="col-sm-8">
                  <input type="text" class="form-control" id="userName" placeholder="Username" name="username" value="{{$user->username}}"data-parsley-required="true" data-parsley-error-message="Please Enter Username">
                  @error('username')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               <label for="email" class="col-sm-2 col-form-label">Email</label>
               <div class="col-sm-8">
                  <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{$user->email}}"data-parsley-required="true" data-parsley-error-message="Please Enter Email">
                  @error('email')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               <label for="password" class="col-sm-2 col-form-label">Current Password</label>
               <div class="col-sm-8">
                  <input type="password" class="form-control" id="password" placeholder="Password" name="current_password" data-parsley-required="true" data-parsley-error-message="Please enter password">
                  @error('current_password')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               <label for="changePassword" class="col-sm-2 col-form-label">New Password</label>
               <div class="col-sm-8">
                  <input type="password" class="form-control" id="changePassword" placeholder="New Password" name="new_password" data-parsley-required="true" data-parsley-error-message="Please enter new password">
                  @error('new_password')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               <label for="confirm_password" class="col-sm-2 col-form-label">Confirm New Password</label>
               <div class="col-sm-8">
                  <input type="password" class="form-control" id="confirm_password" placeholder="Confirm New Password" name="new_confirm_password" data-parsley-required="true" data-parsley-error-message="Please enter new confirm password">
                  @error('new_confirm_password')
                  <span class="text-danger errormsg" role="alert">
                     <p>{{ $message }}</p>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-6">	
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{route('profiles.index')}}" class="btn btn-default">Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection