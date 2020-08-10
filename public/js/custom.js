$(document).ready(function(){
	$('body').on('click', 'a.delete_class', function () {
      var url = $(this).attr("data-url");
    	var id = $(this).attr("id");
    	var data_title = $(this).attr("data-title");
    	var csrf_token = $(this).attr("token");
		  var tr = $(this).closest('tr');
        Swal.fire({
          title: 'Are you sure want to delete this category?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((e) => {
        if (e.value === true) {
          $.ajax({
            id: id,
            type: 'DELETE',
            url: url,
            data: {_token:csrf_token , id: id  },
            success: function (data) {
              if(data){
                Swal.fire(
                  'Deleted!',
                  'Your Category has been deleted.',
                  'success'
                  ).then(function() {
                window.location.reload();}); 
                }else{
                  Swal.fire({
                    title : 'Opps...',
                    text : 'Something wrong!',
                    icon : 'error',
                    timer : '1500'
                  });
                }              
              },
            });
        }else{
          Swal.fire("Your record is safe.");
        }
      });
    });
  });

function markAsRead(id)
  {
    $.ajax({
            type: "GET",
            url:  "notification/markAsRead/"+id,
            data: {id:id},
            success: function(response)
            {
                console.log("success");
            }
       });

  }

$(function(){
    var today = new Date();
    $('#requirmentFromDate').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minDate:today,
        locale: {
        format: 'YYYY-MM-DD'
        },
    });
    $('input[id="requirmentFromDate"]').on('apply.daterangepicker', function(ev, picker) {
         fromMinDate = new Date($('#requirmentFromDate').val());
       //fromMinDate = moment(minDate1).format('YYYY-MM-DD');
       $('#requirmentToDate').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minDate:fromMinDate,
        locale: {
        format: 'YYYY-MM-DD'
        },
    });
    });
});

// append the vendors as per category id.
$("#category_id").click(function (e) {
    e.preventDefault();
    var id= $(this).val();
    $.ajax({
    type: "GET",
    url: "vendors/"+id,
    dataType: "json",
    success: function(result){
        $("#vendor").empty();
        $.each(result,function(key,val){
            $("#vendor").append('<option value='+val.vendor.id+' selected>'+val.vendor.first_name+'</option>');
        });
     }});
});
