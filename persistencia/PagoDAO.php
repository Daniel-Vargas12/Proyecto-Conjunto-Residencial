<?php
class PagoDAO {
    private $fechaPago;
    private $montoPagado;
    private $medioPago;
    private $idCuentaCobro;

    public function __construct($fechaPago = "", $montoPagado = "", $medioPago = "", $idCuentaCobro = "") {
        
        $this->fechaPago = $fechaPago;
        $this->montoPagado = $montoPagado;
        $this->medioPago = $medioPago;
        $this->idCuentaCobro = $idCuentaCobro;
    }

    public function crear() {
        return "INSERT INTO Pago (fechaPago, medioPago, idCuentaCobro)
                VALUES ('{$this->fechaPago}', '{$this->medioPago}', {$this->idCuentaCobro})";
    }
}
?>