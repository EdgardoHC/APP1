<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1); 
//error_reporting(E_ALL);
include_once '../model/DAOUsuario.php';


$dao = new DAOUsuario();
$result = null;
$usuario = new Usuario();
$data = [];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['key'])) {
        $key = $_POST["key"];
        switch ($key) {
            case 'getTabla':
                $categories = $dao->getAll();
                // Renderizamos tabla aquí
                $html = "<table class='table table-striped'>";
                $html .= "<thead><tr>
                            <th>UsuarioId</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Apodo</th>
                            <th>Acciones</th>
                          </tr></thead><tbody>";
                foreach ($categories as $cat) {
                    $html .= "<tr>";
                    $html .= "<td>" . htmlspecialchars($cat->getUsuarioID()) . "</td>";
                    $html .= "<td>" . htmlspecialchars($cat->getNombres()) . "</td>";
                    $html .= "<td>" . htmlspecialchars($cat->getApellidos()) . "</td>";
                    $html .= "<td>" . htmlspecialchars($cat->getApodo()) . "</td>";
                    $html .= "<td><button class='btn btn-primary'>Editar</button></td>";
                    $html .= "</tr>";
                }
                $html .= "</tbody></table>";
                $result = $html;
                break;
            case 'guardar':
                parse_str($_POST["data"], $data);
                $usuario->setNombre($data["nombre"]);
                $usuario->setApellidos($data["apellidos"]);
                $usuario->setCorreo($data["correo"]);
                $usuario->setApodo($data["apodo"]);
                $usuario->setContasena(password_hash($data["contrasena"], PASSWORD_DEFAULT));
                $result = $dao->guardar($usuario);
                break;

            default:
                $result = null;
                break;
        }
    }
}

echo $result;
