<?php

abstract class Usuario{
protected $id;
protected $nombre;
protected $apellido;
protected $email;
protected $clave;
protected $telefono;

public function __construct($id = "", $nombre="", $apellido="", $email="", $clave="", $telefono="")
{
    $this -> id = $id;
    $this -> nombre = $nombre;
    $this -> apellido = $apellido;
    $this -> email = $email;
    $this -> clave = $clave;
    $this -> telefono=$telefono;
}

public function getId(){
        return $this -> id;
    }
    
public function getNombre() {
        return $this->nombre;
    }

public function getApellido() {
        return $this->apellido;
    }

public function getEmail() {
        return $this->email;
    }

public function getClave() {
        return $this->clave;
    }


public function getTelefono() {
        return $this->telefono;
    }

public function setId($id){
        $this -> id = $id;
    }
    
public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

public function setEmail($email) {
        $this->email = $email;
    }

public function setClave($clave) {
        $this->clave = $clave;
    }
 
public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }


}






?>

