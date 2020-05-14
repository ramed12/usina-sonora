$("#filial-submit").on('click', function(e){
    e.preventDefault()

    const data = $("#form-filial").serialize()
    const route = '/dashboard/company/basic/edit'

    console.log(data)
    $.ajax({
        url : route,
        type: 'POST',
        data: data,
        beforeSend: function() {
            $('#filial-submit').html('<i class="fas fa-sync-alt fa-spin"></i> Enviado')
            $('#filial-submit').addClass('disabled')
        },
        complete: function() {
            $('#filial-submit').html('<i class="fas fa-save"></i> Salvar')
            $('#filial-submit').removeClass('disabled')
        },
        success: function(data, textStatus) {
            Swal.fire({
                icon:  'success',
                title: 'Registro alterado.',
            })
        },
        error: function(xhr,er) {
            Swal.fire({
                icon:  'error',
                title: 'Erro ao alterar o registro.',
            })
        }
    })
})
$("#matriz-submit").on('click', function(e){
    e.preventDefault()

    const data = $("#form-matriz").serialize()
    const route = '/dashboard/company/basic/edit'

    $.ajax({
        url : route,
        type: 'POST',
        data: data,
        beforeSend: function() {
            $('#matriz-submit').html('<i class="fas fa-sync-alt fa-spin"></i> Enviado')
            $('#matriz-submit').addClass('disabled')
        },
        complete: function() {
            $('#matriz-submit').html('<i class="fas fa-save"></i> Salvar')
            $('#matriz-submit').removeClass('disabled')
        },
        success: function(data, textStatus) {
            Swal.fire({
                icon:  'success',
                title: 'Registro alterado.',
            })
        },
        error: function(xhr,er) {
            Swal.fire({
                icon:  'error',
                title: 'Erro ao alterar o registro.',
            })
        }
    })
})
