function detailRegister(id,name,phone,email)
{

    $('#exampleModal').modal('show');
    $("#title-name").html(name);
    $("#id").val(id);
    $("#name").val(name);
    $("#email").val(email);
    $("#phone").val(phone);

}
