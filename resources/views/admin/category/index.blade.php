@extends('layouts.master')
@section('main-content')
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Vendor Category</h3>
			<a class="btn btn-success btn-sm" href="{{route('categories.create')}}" style="margin-left: 826px;">Add New</a>
		</div>
	<div class="card-body">
		 @if(session()->get('success'))
		    <div class="alert alert-success">
		      {{ session()->get('success') }}  
		    </div><br />
  		 @endif
		<table id="example2" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>SrNo</th>
					<th>Category Name</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0;?>
				@foreach($categories as $category)
				<tr>
					<td>{{++$i}}</td>
					<td>{{$category->name}}</td>
					<td>
						@if($category->status == 1)
							Active
						@else
							Inactive
						@endif
					</td>
					<td>
						<div class="form-group">
							<div class="row">
								<a href="{{ route('categories.edit', $category->id)}}" class="edit btn btn-primary btn-sm editProduct">Edit</a>
								&nbsp;
					 			 <form action="{{ route('categories.destroy', $category->id)}}" method="post">
		                  			@csrf
		                  			@method('DELETE')
                  					<button class="btn btn-danger btn-sm" type="submit">Delete</button>
                	 			</form>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection