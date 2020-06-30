<div class="form-group">
	<div class="row">
		<a href="{{ route('categories.edit', $row->id)}}" class="edit btn btn-primary btn-sm editProduct"><i class="fas fa-pencil-alt"></i></a>&nbsp;
		<form id="confirmationForm"  action="{{ route('categories.destroy', $row->id)}}" method="post">
			@csrf
			@method('DELETE')
			<a href="#" class="btn btn-danger btn-sm" onclick="return delete_com({{ $row->id }});"><i class="far fa-trash-alt"></i>
			</a>
	    </form>
    </div>
</div>