<?php
require_once "../model/UsuarioDAO.php";

$dao = new UsuarioDAO();

if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case "listar":
            echo json_encode($dao->listar());
            break;

        case "crear":
            $u = new Usuario();
            $u->setNombre($_POST['nombre']);
            $u->setApellidos($_POST['apellidos']);
            $u->setEmail($_POST['email']);
            $u->setApodo($_POST['apodo']);
            $u->setPwd($_POST['pwd']);
            echo json_encode(["ok" => $dao->crear($u)]);
            break;

        case "actualizar":
            $u = new Usuario();
            $u->setIdUsuario($_POST['idUsuario']);
            $u->setNombre($_POST['nombre']);
            $u->setApellidos($_POST['apellidos']);
            $u->setEmail($_POST['email']);
            $u->setApodo($_POST['apodo']);
            echo json_encode(["ok" => $dao->actualizar($u)]);
            break;

        case "eliminar":
            echo json_encode(["ok" => $dao->eliminar($_POST['idUsuario'])]);
            break;
    }
}
