function getPassword() {
    var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJLMNOPQRSTUVWXYZ!@#$%^&*()+?><:{}[]";
    var passwordLength = 12;
    var password = "";

    for (var i = 0; i < passwordLength; i++) {
      var randomNumber = Math.floor(Math.random() * chars.length);
      password += chars.substring(randomNumber, randomNumber + 1);
    }
    document.getElementById('password').value = password
}


$("#passwordGenerate").on('click',function() {

    const route2 = '/dashboard/investor/password';
    $("#passwordGenerate").addClass("disabled");
    $.ajax({
        url: route2,
        type: 'POST',
        data: {
                id: $("#id").val(),
                name: $("#name").val(),
                email: $("#email").val(),
                password: $("#password").val(),
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        success: function( data,status ) {
 
            if(data == 1 && status == 'success'){
            $("#passwordGenerate").removeClass("disabled");
            Swal.fire({
                icon:  'success',
                title: 'Senha criada com sucesso.',
            })
            }else{
                Swal.fire({
                    icon:  'error',
                    title: 'Erro não foi possível enviar a senha.',
                })
            }
        },
        error: function (request, status, error) {
            $("#passwordGenerate").removeClass("disabled");
            alert(request.responseText);
        }
    });
});
