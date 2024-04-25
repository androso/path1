<?php

class ConexionaBD
{
    private $server;
    private $usuario;
    private $contraseña;
    private $db;
    public $conexion;
    public function __construct($server, $usuario, $contraseña, $db)
    {
        $this->server = $server;
        $this->usuario = $usuario;
        $this->contraseña = $contraseña;
        $this->db = $db;
        $this->conexion = null;
    }

    public function conectar()
    {
        $this->conexion = new mysqli($this->server, $this->usuario, $this->contraseña, $this->db);
        if ($this->conexion->connect_error) {
            die("Conexión a la base de datos mala" . $this->conexion->connect_error);
        } else {
            // echo "conexion a base de datos exitosa";
        }
    }

    public function desconectar()
    {
        if ($this->conexion === null) {
        } else {
            $this->conexion->close();
            // echo "se cerro la conexion";
        }
    }
}
$conexion = new ConexionaBD('localhost', 'root', '', 'kanban');
