<?php
class AdminDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $clave;
    private $telefono;

    public function __construct($id = 0, $nombre = "", $apellido = "", $email = "", $clave = "", $telefono ="") {
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> email = $email;
        $this -> clave = $clave;
        $this -> telefono = $telefono;
    }
    
    public function autenticar(){
        return "select id
                from administrador 
                where email = '" . $this -> email . "' and clave = '" . md5($this -> clave) . "'";
    }

    public function consultar(){
        return "select nombre, apellido, email, telefono
                from administrador
                where id = '" . $this -> id . "'";
    }
}

?>