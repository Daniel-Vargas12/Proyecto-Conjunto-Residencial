<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
include("presentacion/encabezado.php");

include("presentacion/barraNavegacion.php");



$mensaje = "";

if (isset($_POST['generar'])) {
    $apartamento = new Apartamento();
    $listaApartamentos = $apartamento->consultar();

    $mes = date("m");
    $anio = date("Y");
    $estado = "no pago";
    $monto = 60000; 
    $idAdmin = $_SESSION["id"];

    $creadas = 0;
    $yaExistian = 0;

    foreach ($listaApartamentos as $apto) {
        $idApartamento = $apto->getId();
        $cuenta = new CuentaCobro("", $mes, $anio, $estado, $monto, $idApartamento, $idAdmin);

        if (!$cuenta->existeCuenta()) {
            $cuenta->crear();
            $creadas++;
        } else {
            $yaExistian++;
        }
    }

    if ($creadas > 0) {
        $mensaje = "<div class='alert alert-success'>Se crearon $creadas cuentas de cobro para este mes.</div>";
    } else {
        $mensaje = "<div class='alert alert-warning'>Ya existen cuentas de cobro para todos los apartamentos este mes.</div>";
    }

}

?>

<div class="container mt-4">
    <h2>Generar Cuentas de Cobro</h2>
    <form method="post">
        <button class="btn btn-success" type="submit" name="generar">Generar Cuentas</button>
    </form>
    <br>
    <?php echo $mensaje; ?>
</div>