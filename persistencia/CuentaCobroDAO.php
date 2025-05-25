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
    
    public function consultar($rol, $id) {
        if($rol == "admin"){
            $sentencia= "SELECT * FROM cuentacobro";
            return $sentencia;
        } else if($rol == "propietario") {
            $sentencia= "SELECT * FROM cuentacobro 
                    WHERE idApartamento IN (
                        SELECT id FROM apartamento WHERE idPropietario = '$id')";
            return $sentencia;
        }
    }

    public function crear() {
        if (empty($this->mes) || empty($this->anio) || empty($this->estado) || 
            empty($this->Apartamento) || empty($this->Administrador)) {
            return false; // o lanza una excepción, o devuelve un mensaje de error
        
        }

        $sentencia = "INSERT INTO cuentacobro (mes, año, estado, monto, idApartamento, idAdmin) 
                    VALUES ('$this->mes', '$this->anio', '$this->estado', '$this->monto', '$this->Apartamento', '$this->Administrador')";
        echo $sentencia;//para verificar consulta-borrar despues
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