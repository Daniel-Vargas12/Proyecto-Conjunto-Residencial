<?php 
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
?>

<body>
<?php 
include(__DIR__ . "/../encabezado.php");
if($rol=="admmin")
include(__DIR__ . "/../barraNavegacion.php");
else {
	include(__DIR__ . "/../barraNavegacionP.php");
}
?>
<div class="container">
	<div class="row mt-3">
		<div class="col">
			<div class="card">
				<div class="card-header"><h4>Cuentas de Cobro</h4></div>
				<div class="card-body">
    				<?php 
    				$CuentaCobro = new CuentaCobro();
    				$cuentas = $CuentaCobro->consultar($rol, $id);

                    // Agrupar por estado
    				$cuentasPagadas = [];
    				$cuentasNoPagadas = [];

    				foreach($cuentas as $c){
    				    if(strtolower($c->getEstado()) == "pago"){
    				        $cuentasPagadas[] = $c;
    				    } else {
    				        $cuentasNoPagadas[] = $c;
    				    }
    				}

                    // Función para renderizar tabla
                    function mostrarTablaCuentas($titulo, $cuentas, $rol, $mostrarAccion = false){
						echo "<h5 class='mt-4'>$titulo</h5>";
						echo "<table class='table table-striped table-hover'>";
						echo "<tr><th>Id</th><th>Fecha</th><th>Monto</th>";

						if ($rol == "admin") {
								echo "<th>Propietario</th><th>Apartamento</th>";
							}
							elseif($rol == "propietario"){
							echo "<th>Administrador</th>";
							echo "<th>Apartamento</th>";
							if($mostrarAccion){
							echo "<th>Acción</th>";
						}
						}
						
						echo "</tr>";

						foreach($cuentas as $c){
							echo "<tr>";
							echo "<td>" . $c->getId() . "</td>";
							echo "<td>" . $c->getMes() . "-" . $c->getAnio() . "</td>";

							echo "<td>" . $c->getMonto() . "</td>";
							if ($rol != "propietario") {
								$apto = $c->getApartamento();
								$prop = $apto->getPropietario();
								echo "<td>" . $prop->getNombre() . " " . $prop->getApellido() . "</td>";
								echo "<td>Torre " . $apto->getTorre() . " - Apto " . $apto->getNumero() . "</td>";
							}
							if($rol != "admin"){
								$apto = $c->getApartamento();
								$prop = $apto->getPropietario();
								$admin = $c->getAdmin();
								echo "<td>" . $admin->getNombre() . " " . $admin->getApellido() . "</td>";
								echo "<td>Torre " . $apto->getTorre() . " - Apto " . $apto->getNumero() . "</td>";
								if($mostrarAccion){
								echo "<td><a href='?pid=" . base64_encode("presentacion/Pagos/pagarCuenta.php") . "&idCuenta=" . $c->getId() . "' class='btn btn-sm btn-success'>Pagar</a></td>";
							}
							}

							echo "</tr>";
						}
						echo "</table>";
					}
                    // Mostrar ambas tablas
                    mostrarTablaCuentas("Cuentas Pagadas", $cuentasPagadas, $rol, false);
                    mostrarTablaCuentas("Cuentas No Pagadas", $cuentasNoPagadas, $rol, true);
    				?>			
				</div>
			</div>
		</div>
	</div>
</div>
</body>


