function cargarTabla() {
    $.ajax({
        url: 'controller/UsuarioController.php',
        type: 'post',
        data: { key: 'getTabla' }
    }).done(function (resp) {
        $("#contenido").empty();
        $("#contenido").append(resp);
    }).fail(function (resp) {
        console.log("Error al conecar con controlador...s")
    });
}


$(document).ready(function () {
    //cargando tabla 
    cargarTabla();


    $("#btnGuardar").click(function () {
        var formulario = $("#formUsuarios").serialize();
        $.ajax({
            url: 'controller/UsuarioController.php',
            type: "post",
            data: { key: "guardar", data: formulario },
        }).done(function (resp) {
            if (resp) {
                alert("El usuario ha sido guardado satisfactoriamente");
            } else {
                alert("Hubo un problema al guardar el usuario");
            }
            cargarTabla();
        }).fail(function(jqXHR, textEstatus, errorThrown) {
            alert("Sucedió un problema");
           // console.error("ocurrió un error: ");
           // console.error("Estado:",jqXHR);
            //console.error("Error: ",errorThrown);
            //console.error("Respuesta del servidor: ", jqXHR.responseText);
        });
    });

}); 
