<?php

class Conexion{
    private $conexion;
    private $resultado;
    
    public function abrir(){
        $this -> conexion = new mysqli("localhost:3306", "root", "", "conjunto_residencial");
    }
    
    public function cerrar(){
        $this -> conexion -> close();
    }
    
    public function ejecutar($sentencia){
        $this -> resultado = $this -> conexion -> query($sentencia);
    }
    
    public function registro(){
        return $this -> resultado -> fetch_row();
    }
    public function registro1(){//metodo alternativo para acceder ["id"] y no [0]
    return $this->resultado->fetch_assoc();
}
    
    public function filas(){
        return $this -> resultado -> num_rows;
    }
    
}

?>