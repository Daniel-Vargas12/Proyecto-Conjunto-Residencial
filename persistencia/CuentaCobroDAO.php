<?php

class CuentaCobroDAO{
    private $id;
    private $mes;
    private $anio;
    private $estado;
    private $monto;
    private $Apartamento;
    private $Administrador;
    
    public function __construct($id="", $mes="", $anio="", $estado="",$monto='', $Apartamento="", $Administrador=""){
        $this -> id = $id;
        $this -> mes = $mes;
        $this -> anio = $anio;
        $this -> estado = $estado;
        $this -> monto = $monto;
        $this -> Apartamento = $Apartamento;
        $this -> Administrador = $Administrador;
    }

    public function consultar($rol = "", $id = "") {
        $sentencia = "
            SELECT 
                cc.id AS idCuentaCobro, cc.mes, cc.año, cc.estado, cc.monto,
                a.numero AS numeroApartamento, a.torre,
                p.nombre AS nombrePropietario, p.apellido AS apellidoPropietario,
                adm.id AS idAdmin, adm.nombre AS nombreAdmin, adm.apellido AS apellidoAdmin
            FROM cuentaCobro cc
            JOIN Apartamento a ON cc.idApartamento = a.id
            JOIN Propietario p ON a.idPropietario = p.id
            LEFT JOIN Administrador adm ON cc.idAdmin = adm.id
        ";

        if ($rol != "admin") {
            $sentencia .= " WHERE p.id = '$id'";
        }
        return $sentencia;
    }

    public function crear() {
        if (empty($this->mes) || empty($this->anio) || empty($this->estado) || 
            empty($this->Apartamento) || empty($this->Administrador)) {
            return false; 
        
        }
        $sentencia = "INSERT INTO cuentacobro (mes, año, estado, monto, idApartamento, idAdmin) 
                    VALUES ('$this->mes', '$this->anio', '$this->estado', '$this->monto', '$this->Apartamento', '$this->Administrador')";
        
        return $sentencia;
    }

    public function existeCuenta() {
        $sentencia = "SELECT COUNT(*) 
                    FROM cuentacobro 
                    WHERE mes = '$this->mes' 
                    AND año = '$this->anio' 
                    AND idApartamento = '$this->Apartamento'";
        return $sentencia;
    }
}
?>