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
}
?>