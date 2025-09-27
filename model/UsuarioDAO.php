<?php
require_once "Conexion.php";
require_once "Usuario.php";

class UsuarioDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::getInstance()->getConexion();
    }

    public function listar() {
        $sql = "SELECT idUsuario, nombre, apellidos, email, apodo FROM usuarios";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear(Usuario $u) {
        $sql = "INSERT INTO usuarios(nombre, apellidos, email, apodo, pwd) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $u->getNombre(),
            $u->getApellidos(),
            $u->getEmail(),
            $u->getApodo(),
            password_hash($u->getPwd(), PASSWORD_DEFAULT) 
        ]);
    }

    public function actualizar(Usuario $u) {
        $sql = "UPDATE usuarios SET nombre=?, apellidos=?, email=?, apodo=? WHERE idUsuario=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $u->getNombre(),
            $u->getApellidos(),
            $u->getEmail(),
            $u->getApodo(),
            $u->getIdUsuario()
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM usuarios WHERE idUsuario=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
