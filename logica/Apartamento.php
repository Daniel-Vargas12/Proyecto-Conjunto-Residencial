<?php

require_once("persistencia/Conexion.php");
require_once("persistencia/ApartamentoDAO.php");

class Apartamento {
    private $id;
    private $numero;
    private $torre;
    private $metrosCuadrados;
    private $idPropietario;
    private $propietario;

    public function __construct($id = "", $numero = "", $torre = "", $metrosCuadrados = "", $idPropietario = "", $propietario = null) {
        $this->id = $id;
        $this->numero = $numero;
        $this->torre = $torre;
        $this->metrosCuadrados = $metrosCuadrados;
        $this->idPropietario = $idPropietario;
        $this->propietario = $propietario;
    }

    public function getId()
    {
        return $this -> id;
    }
    public function getNumero()
    {
        return $this -> numero;
    }
    public function getTorre()
    {
        return $this -> torre;
    }
    public function getMetrosCuadrados()
    {
        return $this -> metrosCuadrados;
    }
    public function getIdPropietario()
    {
        return $this -> idPropietario;
    }
    public function setPropietario($propietario) {
        $this->propietario = $propietario;
    }

    public function getPropietario() {
        return $this->propietario;
    }

    public function consultar() {
    $conexion = new Conexion();
    $aptoDAO = new ApartamentoDAO(
        "",
        $this->numero,
        $this->torre,
        $this->metrosCuadrados,
        $this->idPropietario
    );

    $conexion->abrir();
    $conexion->ejecutar($aptoDAO->consultar($this->idPropietario));
    $aptos = array();

    while (($datos = $conexion->registro()) != null) {
        $propietario = new Propietario(
            $datos[5],  // id propietario
            $datos[6],  // nombre
            $datos[7],  // apellido
            $datos[8],  // email
            "",         // clave 
            $datos[9]   // teléfono
        );
        // Crear el apartamento y asignar el propietario
        $apto = new Apartamento($datos[0], $datos[1], $datos[2], $datos[3], $datos[4]);
        $apto->setPropietario($propietario);

        array_push($aptos, $apto);
    }
    $conexion->cerrar();
    return $aptos;
    }

}
?>