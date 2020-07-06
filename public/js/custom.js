// function delete_com(id){
//  	var catid = id;
//   	$.confirm({
//         title: 'Confirmation',
//         content: 'Are You Sure?',
//         buttons: {
//             confirm: function () {
//                 $.ajax({
//                     id: catid,
//         			type: 'DELETE',
//                     url: "/admin/categories/"+catid,
//                     data: {_token:  '{{ csrf_token() }}' , id: catid  },
//                        success: function(result){
//                          window.location.replace('/admin/categories'); 
//                     }
//                 });
//             },
//             cancel: function () {
                    
//                 } 
//         }
//     });
//  }

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