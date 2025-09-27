$(document).ready(function () {
    cargarUsuarios();

    // Guardar (crear o actualizar)
    $("#frmUsuario").submit(function (e) {
        e.preventDefault();

        let accion = $("#idUsuario").val() === "" ? "crear" : "actualizar";

        $.post("controller/UsuarioController.php",
            $(this).serialize() + "&accion=" + accion,
            function (res) {
                if (res.ok) {
                    alert("Usuario " + (accion === "crear" ? "guardado" : "actualizado") + " correctamente");
                    $("#modalNuevoUsuario").modal("hide"); // cerrar modal
                    $("#frmUsuario")[0].reset();
                    $("#idUsuario").val(""); // limpiar hidden
                    $("#exampleModalLabel").text("Nuevo usuario"); // reset título
                    $("#btnGuardar").text("Guardar"); // reset botón
                    cargarUsuarios();
                } else {
                    alert("Ocurrió un error al " + (accion === "crear" ? "guardar" : "actualizar") + " el usuario");
                }
            },
            "json"
        );
    });
});

// Cargar usuarios en tabla
function cargarUsuarios() {
    $.post("controller/UsuarioController.php", { accion: "listar" }, function (data) {
        let filas = "";
        $.each(data, function (i, u) {
            filas += `<tr>
                <td>${u.nombre}</td>
                <td>${u.apellidos}</td>
                <td>${u.email}</td>
                <td>${u.apodo}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editarUsuario(${u.idUsuario}, '${u.nombre}', '${u.apellidos}', '${u.email}', '${u.apodo}')">Editar</button>
                    <button class="btn btn-sm btn-danger" onclick="eliminarUsuario(${u.idUsuario})">Eliminar</button>
                </td>
            </tr>`;
        });
        $("#tablaUsuarios tbody").html(filas);
    }, "json");
}

// Nuevo usuario (abre modal vacío)
function nuevoUsuario() {
    $("#frmUsuario")[0].reset();     // limpiar formulario
    $("#idUsuario").val("");         // limpiar id oculto
    $("#exampleModalLabel").text("Nuevo usuario");
    $("#btnGuardar").text("Guardar");
    $("#grupoPwd").show();
    $("#pwd").attr("required", true);
    $("#modalNuevoUsuario").modal("show");
}


// Editar usuario (abre modal con datos)
function editarUsuario(id, nombre, apellidos, email, apodo) {
    $("#idUsuario").val(id);
    $("#nombre").val(nombre);
    $("#apellidos").val(apellidos);
    $("#email").val(email);
    $("#apodo").val(apodo);
    $("#pwd").val(""); // no mostrar la contraseña

    $("#exampleModalLabel").text("Editar usuario");
    $("#btnGuardar").text("Actualizar");
    $("#grupoPwd").hide();
    $("#pwd").removeAttr("required");
    $("#modalNuevoUsuario").modal("show");
}

// Eliminar usuario
function eliminarUsuario(id) {
    if (confirm("¿Seguro de eliminar?")) {
        $.post("controller/UsuarioController.php", { accion: "eliminar", idUsuario: id }, function (res) {
            if (res.ok) {
                alert("Usuario eliminado correctamente");
                cargarUsuarios();
            } else {
                alert("No se pudo eliminar el usuario");
            }
        }, "json");
    }
}
