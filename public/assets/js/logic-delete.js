function deleteRegister(id,stats,route)
{
    Swal.fire({
        title: 'Deseja excluir o registro o id: '+ id +' ?',
        showDenyButton: true,
        confirmButtonText: '<i class="fas fa-trash-alt"></i> Excluir',
        denyButtonText: 'Cancelar',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type : 'GET',
                url : route,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data,status){

                    if(data == 1 && status == 'success'){

                        if(stats == 1){
                            $("#button_del_"+id).addClass("disabled");
                            $("#status_active_"+id).addClass("sr-only");
                            $("#status_inactive_"+id).removeClass("sr-only");
                        }else{
                            $("#button_del_"+id).removeClass("disabled");
                            $("#status_active_"+id).removeClass("sr-only");
                            $("#status_inactive_"+id).addClass("sr-only");
                        }
                        Swal.fire({
                            icon:  'success',
                            title: 'Status alterado.',
                        })
                    }else{
                        $("#button_del_"+id).removeClass("disabled");
                        Swal.fire({
                            icon:  'error',
                            title: 'Erro ao alterar o status.',
                        })
                    }
                }
            })
        } else if (result.isDenied) {
          Swal.fire('Operação cancelada pelo usuário', '', 'info')
        }
      })
}
