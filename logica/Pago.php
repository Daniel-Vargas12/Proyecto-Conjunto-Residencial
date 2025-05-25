<?php
class Pago {
    private $id;
    private $fechaPago;
    private $montoPagado;
    private $medioPago;
    private $idCuentaCobro;

    public function __construct($id = "", $fechaPago = "", $montoPagado = "", $medioPago = "", $idCuentaCobro = "") {
        $this->id = $id;
        $this->fechaPago = $fechaPago;
        $this->montoPagado = $montoPagado;
        $this->medioPago = $medioPago;
        $this->idCuentaCobro = $idCuentaCobro;
    }

    public function crear() {
        $conexion = new Conexion();
        $pagoDAO = new PagoDAO($this->fechaPago, $this->montoPagado, $this->medioPago, $this->idCuentaCobro);
        $conexion->abrir();
        $conexion->ejecutar($pagoDAO->crear());

        // Marcar la cuenta como pagada
        $conexion->ejecutar("UPDATE cuentaCobro SET estado = 'pago' WHERE id = {$this->idCuentaCobro}");
        
        $conexion->cerrar();
    }
}
?>