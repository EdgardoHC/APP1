<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1); 
//error_reporting(E_ALL);

include_once 'config.php';
include_once 'Usuario.php';

class DAOUsuario
{
    private $pdo;


    private function conectar()
    {
        $dsn = "mysql:host=" . SERVER . ";dbname=" . BD . ";charset=utf8mb4";
        try {
            $this->pdo = new PDO($dsn, USUARIO, PWD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Conexión fallida: " . $e->getMessage());
        }
    }

    private function desconectar()
    {
        $this->pdo = null;
    }

    // Retorna un arreglo de objetos usuarios
    public function getAll()
    {
        $this->conectar();
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $usuarios = [];
        foreach ($result as $row) {
            $usr = new Usuario;
            $usr->setUsuarioId($row['idUsuario']);
            $usr->setNombre($row['nombre']);
            $usr->setApellidos($row['apellidos']);
            $usr->setApodo($row['apodo']);
            $usr->setContasena($row['pwd']);

            $usuarios[] = $usr;
        }
        $this->desconectar();
        return $usuarios;
    }

    //1. GUARDAR
    public function guardar(Usuario $usr)
    {
        $this->conectar();
        $stmt = $this->pdo->prepare('INSERT INTO usuarios(nombre, apellidos, email, apodo, pwd) VALUES (?,?,?,?,?)');
        $nombre = $usr->getNombres();
        $apellidos = $usr->getApellidos();
        $correo = $usr->getCorreo();
        $apodo = $usr->getApodo();
        $pwd = $usr->geContrasena();

        //los parametros de la consulta
        $stmt->execute([$nombre, $apellidos, $correo, $apodo, $pwd]);
        $noFilas = $stmt->rowCount();
        if ($noFilas > 0) {
            return true;
        } else {
            return false;
        }
        $this->desconectar();
    }

    // 2. MODIFICAR


    //3. ELIMINAR
}
