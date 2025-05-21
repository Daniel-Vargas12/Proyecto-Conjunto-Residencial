<?php
require_once("persistencia/Conexion.php");
require_once("logica/Usuario.php");
require_once("persistencia/AdminDAO.php");

class Administrador extends Usuario {
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $telefono = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave, $telefono);
    }

    public function autenticar(){
        $conexion = new Conexion();
        $adminDAO = new AdminDAO("","","", $this -> email, $this -> clave,"");
        $conexion -> abrir();
        $conexion -> ejecutar($adminDAO -> autenticar());
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
        $adminDAO = new AdminDAO($this -> id);
        $conexion -> abrir();
        $conexion -> ejecutar($adminDAO -> consultar());
        $datos = $conexion -> registro();
        $this -> nombre = $datos[0];
        $this -> apellido = $datos[1];
        $this -> email = $datos[2];
        $this -> telefono = $datos[3];
        $conexion->cerrar();
    }

}
?>