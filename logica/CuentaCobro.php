<?php

require_once("persistencia/Conexion.php");
require_once ("persistencia/CuentaCobroDAO.php");


class CuentaCobro{
    private $id;
    private $mes;
    private $anio;
    private $estado;
    private $idApartamento;
    private $idAdmin;

public function __construct($id="",$mes="", $anio="", $estado="", $idApartamento="", $idAdmin="")
{
    $this -> id = $id;
    $this -> mes = $mes;
    $this -> anio = $anio;
    $this -> estado = $estado;
    $this -> idApartamento = $idApartamento;
    $this -> idAdmin = $idAdmin;
}

public function getId()
{
    return $this -> id;
}

public function getMes()
{
    return $this -> mes;
}

public function getAnio()
{
    return $this -> anio;
}

public function getEstado()
{
    return $this -> estado;
}

public function getIdApartamento()
{
    return $this -> idApartamento;
}

public function getIdAdmin()
{
    return $this -> idAdmin;
}

public function consultar($rol="", $id=""){
        $conexion = new Conexion();
        $ccDAO = new CuentaCobroDAO(
            "", 
    $this->mes, 
    $this->anio, 
    $this->estado, 
    $this->idApartamento, 
    $this->idAdmin
        );
        $conexion -> abrir();
        $conexion -> ejecutar($ccDAO -> consultar($rol,$id));
        $cuentasC = array();
        while(($datos = $conexion -> registro()) != null){
            $cuenta = new CuentaCobro($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]);
            array_push($cuentasC, $cuenta);
        }
        $conexion -> cerrar();
        return $cuentasC;
    }

public function crear(){
    $conexion = new Conexion();
   $ccDAO = new CuentaCobroDAO(
    "", // ID vacío porque es autoincremental
    $this->mes,
    $this->anio,
    $this->estado,
    $this->idApartamento,
    $this->idAdmin
);
    $conexion->abrir();
    $conexion->ejecutar($ccDAO->crear($this->mes, $this->anio, $this->estado, $this->idApartamento, $this->idAdmin));
    $conexion->cerrar();
}
}

?>