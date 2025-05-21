<?php
require_once("persistencia/Conexion.php");
require_once("logica/Usuario.php");
require_once("persistencia/PropietarioDAO.php");

class Propietario extends Usuario {
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $telefono = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave, $telefono);
    }

    public function autenticar(){
        $conexion = new Conexion();
        $propDAO = new PropietarioDAO("","","", $this -> email, $this -> clave,"");
        $conexion -> abrir();
        $conexion -> ejecutar($propDAO -> autenticar());
        if($conexion -> filas() == 1){            
            $this -> id = $conexion -> registro()[0];
            $conexion->cerrar();
            return true;
        }else{
            $conexion->cerrar();
            return false;
        }
    }

    public function consultar(){
        $conexion = new Conexion();
        $propDAO = new PropietarioDAO($this -> id);
        $conexion -> abrir();
        $conexion -> ejecutar($propDAO -> consultar());
        $datos = $conexion -> registro();
        $this -> nombre = $datos[0];
        $this -> apellido = $datos[1];
        $this -> email = $datos[2];
        $this -> telefono = $datos[3];
        $conexion->cerrar();
    }
}
?>