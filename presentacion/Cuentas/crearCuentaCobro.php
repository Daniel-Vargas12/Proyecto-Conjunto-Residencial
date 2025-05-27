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
        $mensaje = "<div class='alert alert-success mt-3'><i class='bi bi-check-circle-fill'></i> Se crearon <strong>$creadas</strong> cuentas de cobro para este mes.</div>";
    } else {
        $mensaje = "<div class='alert alert-warning mt-3'><i class='bi bi-exclamation-triangle-fill'></i> Ya existen cuentas de cobro para todos los apartamentos este mes.</div>";
    }
}
?>

<div class="container my-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-success"><i class="bi bi-receipt-cutoff"></i> Generar Cuentas de Cobro</h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-body text-center">
            <form method="post">
                <button class="btn btn-success btn-lg" type="submit" name="generar">
                    <i class="bi bi-file-earmark-plus-fill me-2"></i>Generar Cuentas de Cobro
                </button>
            </form>
            <?php echo $mensaje; ?>
        </div>
    </div>
</div>
