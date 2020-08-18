@extends('layouts.master')
<link rel="stylesheet" href="{{ asset('css/star-rating.css')}}">
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Requirements</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Requirements</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Requirements</h3>
			<a class="btn btn-success float-right btn-sm" rel="tooltip" title="Add New" href="{{route('requirements.create')}}">Add New</a>
		</div>
	<div class="card-body">
			<table id="requirementTable" class="table table-bordered table-hover">
				<thead>
					<tr>
                        <th>SrNo</th>
                        <th>Requirement ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Priority</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>


    <div class="modal hide fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <form method="POST"  id="reviewRatingForm" data-parsley-validate="parsley">
                <div class="modal-content">
                    <div class="modal-header headerModal">
                    <h4 class="modal-title">Review and Rating</h4>
                    <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    @csrf
                    <input type="hidden" value="" id="requirement_id" name="requirement_id">
                    <div class="modal-body">
                    <div class="form-group">
                        <div>
                            {!! Form::label('rating','Rating:',['class'=>"col-sm-2 required col-form-label"],false) !!} 
                                <!-- Rating Stars Box -->
                                <div class='rating-stars text-center'>
                                    <ul id='stars'>
                                    <li class='star' title='Poor' data-value='1'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Fair' data-value='2'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Good' data-value='3'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Excellent' data-value='4'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='WOW!!!' data-value='5'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    </ul>
                                </div>
                                <span class="text-danger error-rating" role="alert">
                        </span> 
                        </div>
                    </div>
                    <div class="form-group">
                    {!! Form::label('review','Review:',['class'=>"col required col-form-label"],false) !!} 
                        <div>
                            {!! Form::textarea('review', null, ['class' => 'form-control','id' => 'review','rows'=>'4','cols'=>'4','placeholder' => 'Review',
                            'data-parsley-required' => 'true',
                            'data-parsley-required-message' => 'Review is required',
                            'data-parsley-trigger' => "input",
                            'data-parsley-trigger'=>"blur",
                            'data-parsley-pattern'=>'/^[a-zA-Z ]*$/',
                            'data-parsley-pattern-message' => 'Please enter alphabets',
                            'data-parsley-minlength' => '4',
                            'data-parsley-maxlength' => '200']) !!}
                        </div>
                        <span class="text-danger error-review" role="alert">
                        </span> 
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveRatingReview" >Save</button>
                </div>
            </form>
        </div>
    </div>
	</div>

<!-- /.Requirement status modal -->
<div class="modal hide fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <form method="POST"  data-parsley-validate="parsley">
            <div class="modal-content">
                <div class="modal-header headerModal">
                <h4 class="modal-title">Update status</h4>
                <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                @csrf
                <input type="hidden" value="" id="requirementId" name="requirement_id">
                <div class="modal-body">
                <div class="form-group">
                    <div>
                    {!! Form::label('status','Status:',['class'=>"col-sm-2 col-form-label"],false) !!} 
                    <select id="status" class="form-control" name="status">
                        <option value="in_progress" selected>In Progress</option>
                        <option value="Approved">Approved</option>
                        <option value="Completed" >Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                    
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="updateStatus" >Save</button>
            </div>
        </form>
    </div>
        <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
        var table = $('#requirementTable').DataTable({
            processing: true,
            serverSide: true,
            "scrollX": true,
            bLengthChange: false,
            ajax: "{{ route('requirements.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'code', name: 'code'},
                {data: 'title', name: 'title'},
                {data: 'category_id', name: 'category'},
                {data: 'priority', name: 'priority'},
                {data: 'created_at', name: 'date'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'},
            ],
            "columnDefs": [
                { "width": "150px", "targets": 7 }
                ],
        });
    });

    function openStatusModal(data)
    {
       
        $('#status option:selected').removeAttr('selected');
        $("#modal1").modal('show');
        $("#requirementId").val(data.id);
        var status = data.status;
        $("select option[value='" + status + "']").attr("selected","selected");
    }
</script>
<script type="text/javascript">

    function openRatingModal(data)
    {
        $("#requirement_id").val(data.id);
        $("#modal2").modal('show');
    }
    $("#updateStatus").click(function (e) {
        
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        e.preventDefault();
        var requirementId = $("#requirementId").val();
        var status = $("#status").val();


            $.ajax({
            type: "POST",
            url: "{{ route('update.requirement.status') }}",
            data:{'requirementId':requirementId,'status':status},
            dataType: "json",
            success: function(result){
                
             if(result)
             {
                $('#modal1').modal('hide');
                toastr.success('Status updated successfully');
                setTimeout(function () {
                    location.reload(true);
                }, 2000);
             }
            }});
    });

    $("#saveRatingReview").click(function (e) {
        
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        e.preventDefault();
        var form = $('#reviewRatingForm');
        form.parsley().validate();
        var requirementId = $("#requirement_id").val();
        var review = $("#review").val();
        var ratingValue = $('#stars li.selected').last().data("value");
       
        if(form.parsley().isValid()){
            
            $.ajax({
            type: "POST",
            url: "{{ route('save.review.rating') }}",
            data:{'requirementId':requirementId,'review':review,'rating':ratingValue},
            dataType: "json",
            success: function(result){
                
                if(result.success == true)
                {
                $('#modal2').modal('hide');
                toastr.success(result.message);
                setTimeout(function () {
                    location.reload(true);
                }, 2000);
                }

                if(result.success == false)
                {
                $('#modal2').modal('hide');
                toastr.error(result.message);
                setTimeout(function () {
                    location.reload(true);
                }, 2000);
                }
            },
            error:function(result){
                    if(typeof result.responseJSON.errors.rating != "undefined"){
                    let rating = (result.responseJSON.errors.rating[0]);
                    $('.error-rating').html(rating);
                    }else{
                    $('.error-rating').empty();
                    }
                    if(typeof result.responseJSON.errors.review != "undefined"){
                    let review = (result.responseJSON.errors.review[0]);
                    $('.error-review').html(review);
                    }else{
                    $('.error-review').empty();
                    }
                }
            });
        }

    });

    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li').on('mouseover', function(){
    
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
            if (e < onStar) {
            $(this).addClass('hover');
            }
            else {
            $(this).removeClass('hover');
            }
        });

        }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
        });
    });


    /* 2. Action to perform on click */
    $('#stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');
        
        for (i = 0; i < stars.length; i++) {
        $(stars[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
        $(stars[i]).addClass('selected');
        }
        
        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        
    });
    
    $('#modal2').on('hidden.bs.modal', function() {  
        $('#review').val("");
        $('.error-rating').empty();
        $('.parsley-required').empty();
        $('.parsley-fileextension').empty();
        $('.parsley-error').removeClass('parsley-error');
        $('.parsley-success').removeClass('parsley-success');
        $('.parsley-minlength').empty();
        $('.parsley-pattern').empty();
        $('#stars li.selected').removeClass('selected');
    });
</script>

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
