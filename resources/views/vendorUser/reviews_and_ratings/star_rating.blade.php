@for($index =0;$index<5;$index++)
<span class="fa fa-star {{ ($row->rating <=$index)? '' : 'checked' }}"></span>
@endfor
