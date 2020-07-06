$(document).ready(function(){
	$('body').on('click', 'a.delete_class', function() {
    	var url = $(this).attr("data-url");
    	var id = $(this).attr("id");
    	var data_title = $(this).attr("data-title");
    	var csrf_token = $(this).attr("token");
    	var tr = $(this).closest('tr');
    	console.log(tr);
    	console.log(id);
    	$.confirm({
	        title: 'Confirmation',
	        content: 'Are You Sure?',
	        buttons: {
	            confirm: function () {
	                $.ajax({
	                    id: id,
	        			type: 'DELETE',
	                    url: url,
	                    data: {_token:csrf_token , id: id  },
	                       success: function(result){
	                       		if (result.success = true) {
	                       			tr.remove();
	                                toastr.options = {
	                                  "closeButton": true,
	                                  "debug": false,
	                                  "positionClass": "toast-top-right",
	                                  "onclick": null,
	                                  "showDuration": "1000",
	                                  "hideDuration": "1000",
	                                  "timeOut": "5000",
	                                  "extendedTimeOut": "1000",
	                                  "showEasing": "swing",
	                                  "hideEasing": "swing",
	                                  "showMethod": "show",
	                                  "hideMethod": "hide"
	                                }  
                                	Command: toastr.success(data_title+" Deleted Successfully"); 
                            }else{
	                                toastr.options = {
	                                  "closeButton": true,
	                                  "debug": false,
	                                  "positionClass": "toast-top-right",
	                                  "onclick": null,
	                                  "showDuration": "1000",
	                                  "hideDuration": "1000",
	                                  "timeOut": "5000",
	                                  "extendedTimeOut": "1000",
	                                  "showEasing": "swing",
	                                  "hideEasing": "swing",
	                                  "showMethod": "show",
	                                  "hideMethod": "hide"
	                                }  
                                 Command: toastr.error("Some Error Occured");

                            }
	                    }
	                });
	            },
	            cancel: function () {
	                    
	                } 
	        }
    	});	
	});
});