<div class="form-group">
	<div class="row">
		<a href="{{ route('categories.edit', $row->id)}}" class="edit btn btn-primary btn-sm editProduct" rel="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>&nbsp;
		<a href="#" class="btn btn-danger btn-sm delete_class" rel="tooltip" title="Delete" id="{{ $row->id }}" token="{{ csrf_token() }}" data-url="{{ route('categories.destroy', $row->id)}}" data-title="Category"><i class="far fa-trash-alt"></i>
		</a>
	    </form>
    </div>
</div>