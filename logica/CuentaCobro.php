<?php
require_once("persistencia/Conexion.php");
require_once ("persistencia/CuentaCobroDAO.php");
require_once ("logica/Apartamento.php");

class CuentaCobro{
    private $id;
    private $mes;
    private $anio;
    private $estado;
    private $monto;
    private $apartamento;
    private $admin;

    public function __construct($id="",$mes="", $anio="", $estado="", $monto="", $apartamento=null, $admin=null)
    {
        $this -> id = $id;
        $this -> mes = $mes;
        $this -> anio = $anio;
        $this -> estado = $estado;
        $this -> monto = $monto;
        $this -> apartamento = $apartamento;
        $this -> admin = $admin;
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

    public function getMonto()
    {
        return $this -> monto;
    }

    public function getApartamento()
    {
        return $this -> apartamento;
    }

    public function getAdmin()
    {
        return $this -> admin;
    }

    public function consultar($rol = "", $id = "") {
        $conexion = new Conexion();
        $ccDAO = new CuentaCobroDAO(
            "", 
            $this->mes, 
            $this->anio, 
            $this->estado,
            $this->monto,
            $this->apartamento, 
            $this->admin
        );
        $conexion->abrir();
        $conexion->ejecutar($ccDAO->consultar($rol, $id));
        $cuentasC = array();

        while (($datos = $conexion->registro()) != null) {
            if ($rol == "admin") {
                if ($rol == "admin") {
                    $propietario = new Propietario("", $datos[7], $datos[8]); // ID vacío
                    $apartamento = new Apartamento("", $datos[5], $datos[6], "", "", $propietario);
                    $admin = null;
                }
            } else {
                $apartamento = new Apartamento("", $datos[5], $datos[6]);
                if (!empty($datos[9])) { 
                    $admin = new Administrador($datos[9], $datos[10], $datos[11]);
                    } else {
                        $admin = null;
                    }
                }
            $cuenta = new CuentaCobro($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $apartamento, $admin);
            $cuentasC[] = $cuenta;
            }
        $conexion->cerrar();
        return $cuentasC;
    }

    public function crear(){
        $conexion = new Conexion();
        $ccDAO = new CuentaCobroDAO(
            "", // ID vacío, es autoincremental
            $this->mes,
            $this->anio,
            $this->estado,
            $this->monto,
            $this->apartamento,
            $this->admin
        );
        $conexion->abrir();
        $conexion->ejecutar($ccDAO->crear());
        $conexion->cerrar();
    }

    public function existeCuenta() {
        $conexion = new Conexion();
        $ccDAO = new CuentaCobroDAO(
            "", 
            $this->mes,
            $this->anio,
            "", 
            "", 
            $this->apartamento, 
            ""
        );
        $conexion->abrir();
        $conexion->ejecutar($ccDAO->existeCuenta());
        $resultado = $conexion->registro();
        $conexion->cerrar();
        return $resultado[0] > 0; // true si existe al menos una
    }
}

?>