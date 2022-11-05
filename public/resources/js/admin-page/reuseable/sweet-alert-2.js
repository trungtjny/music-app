

  function actionDelete(event){
    event.preventDefault();
   
    let urlRequest = $(this).data('url');

    let thisBtn = $(this);

    Swal.fire({
        title: 'Xác nhận xóa?',
        text: "Khi xóa sẽ không thể phục hồi",
        icon: 'warning',
        showDenyButton: true,
        confirmButtonColor: '#3085d6',
        denyButtonColor: '#d33',
        confirmButtonText: 'Xác nhận xóa',
        denyButtonText: "Hủy bỏ"
      }).then((result) => {
        // if(result.value){
        //   $.ajax({
        //     type: 'GET',
        //     url: urlRequest,
        //     success: function(data){
             
        //     },
        //     error:function(){

        //     }
        //   });
        // }
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          window.location = urlRequest;
        } else if (result.isDenied) {
          Swal.fire('Bạn đã hủy thao tác', '', 'info')
        }
      })
      
   }

   $(function (){
       $(document).on('click', '.action-delete', actionDelete)
   });

