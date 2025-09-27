<?php

class Usuario
{
    private $usuarioId;
    private $nombres;
    private $apellidos;
    private $correo;
    private $apodo;
    private $constrasena;


    public function getUsuarioID()
    {
        return $this->usuarioId;
    }

    public function setUsuarioId($value)
    {
        $this->usuarioId = $value;
    }

    public function getNombres()
    {
        return $this->nombres;
    }
    public function setNombre($value)
    {
        $this->nombres = $value;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function setApellidos($value)
    {
        $this->apellidos = $value;
    }

    public function getCorreo()
    {
        return $this->correo;
    }
    public function setCorreo($value)
    {
        $this->correo = $value;
    }

    public function getApodo()
    {
        return $this->apodo;
    }
    public function setApodo($value)
    {
        $this->apodo = $value;
    }


    public function geContrasena()
    {
        return $this->constrasena;
    }
    public function setContasena($value)
    {
        $this->constrasena = $value;
    }
}
