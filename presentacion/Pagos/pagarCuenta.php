<?php
$idCuenta = $_GET['idCuenta']; 
?>

<body class="bg-light">
  <div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg">
          <div class="card-header bg-primary text-white fw-bold">Registrar Pago</div>
          <div class="card-body">
            <form method="post" action="">
              <input type="hidden" name="idCuentaCobro" value="<?php echo $idCuenta; ?>">

              <div class="mb-3">
                <label for="fechaPago" class="form-label">Fecha de Pago</label>
                <input type="date" class="form-control" name="fechaPago" required value="<?php echo date('Y-m-d'); ?>">

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

              <button type="submit" class="btn btn-primary w-100">Registrar Pago</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once(__DIR__ . "/../../logica/Pago.php");
    include_once(__DIR__ . "/../../persistencia/PagoDAO.php");
    include_once(__DIR__ . "/../../persistencia/Conexion.php");

    $pago = new Pago(
        "", // ID auto incremental
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
