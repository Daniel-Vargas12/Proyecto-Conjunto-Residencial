<?php
$idCuenta = $_GET['idCuenta']; // Se espera que venga por GET
?>

<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header"><h5>Registrar Pago</h5></div>
        <div class="card-body">
            <form method="post" action="">
                <input type="hidden" name="idCuentaCobro" value="<?php echo $idCuenta; ?>">

                <div class="mb-3">
                    <label for="fechaPago" class="form-label">Fecha de Pago</label>
                    <input type="date" class="form-control" name="fechaPago" required>
                </div>

                <div class="mb-3">
                    <label for="montoPagado" class="form-label">Monto Pagado</label>
                    <input type="number" step="0.01" class="form-control" name="montoPagado" required>
                </div>

                <div class="mb-3">
                    <label for="medioPago" class="form-label">Medio de Pago</label>
                    <select class="form-select" name="medioPago" required>
                        <option value="">Seleccione...</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Nequi">Nequi</option>
                        <option value="Daviplata">Daviplata</option>
                        <option value="Tarjeta">Tarjeta</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Registrar Pago</button>
            </form>
        </div>
    </div>
</div>

<?php
// Procesar el formulario-seria mejor usar isset¿?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once(__DIR__ . "/../../logica/Pago.php");
    include_once(__DIR__ . "/../../persistencia/PagoDAO.php");
    include_once(__DIR__ . "/../../persistencia/Conexion.php");

    $pago = new Pago(
        "",                              // ID auto incremental
        $_POST['fechaPago'],
        $_POST['montoPagado'],
        $_POST['medioPago'],
        $_POST['idCuentaCobro']
    );

    $pago->crear();

    echo "<div class='alert alert-success mt-3'>Pago registrado correctamente.</div>";
    echo "<script>setTimeout(() => { window.location.href = '?pid=" . base64_encode("presentacion/Cuentas/consultarCuentas.php") . "'; }, 1500);</script>";
}
?>
</body>
