function verificarCoincidencia() 
{
    var password = $("#contraseña").val(); 
    var confirmPassword = $("#confirmarContraseña").val();

    if(password !== "" && confirmPassword !== "")
    {
        if (password != confirmPassword)
        {
            $('#coincidenciaResultado').removeClass()
            $('#coincidenciaResultado').addClass('mal')
            $('#coincidenciaResultado').html("Las contraseñas no coinciden.")
            $('#btnRegistro').attr('disabled','disabled');
        }
        else
        {
            $('#coincidenciaResultado').removeClass()
            $('#coincidenciaResultado').addClass('bien')
            $('#coincidenciaResultado').html("Las contraseñas coinciden.")
            $('#btnRegistro').removeAttr('disabled');
        }
    }
    else
    {
        $('#coincidenciaResultado').removeClass();
        $('#coincidenciaResultado').html("");
        $('#btnRegistro').removeAttr('disabled');
    }
}

function editarPublicacion(id)
{
    $('#btnGuardar-'+id).addClass('btn-mostrar');
    $('#contenidoPublicacion-'+id).removeAttr('disabled');
    $('#contenidoPublicacion-'+id).focus();
}