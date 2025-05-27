<?php 
	$id = $_SESSION["id"];
	$rol = $_SESSION["rol"];
	?>

	<body>
	<?php 
	include(__DIR__ . "/../encabezado.php");
	if($rol=="admin")
	include(__DIR__ . "/../barraNavegacion.php");
	else {
		include(__DIR__ . "/../barraNavegacionP.php");
	}
	?>
	<div class="container">
		<div class="row mt-3">
			<div class="col">
				<div class="card shadow">
					<div class="card-header bg-primary text-white">
						<h4><i class="bi bi-receipt"></i> Cuentas de Cobro</h4>
					</div>
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

	// Función para mostrar tablas
	function mostrarTablaCuentas($titulo, $cuentas, $rol, $mostrarAccion = false){
		echo "<div class='mt-4'>";
		echo "<h5 class='mb-3'><i class='bi bi-table'></i> $titulo</h5>";
		echo "<div class='table-responsive'>";
		echo "<table class='table table-bordered table-striped align-middle shadow-sm'>";
		echo "<thead class='table-light'>";
		echo "<tr>";
		echo "<th>#</th>";
		echo "<th>Fecha</th>";
		echo "<th>Monto</th>";

		if ($rol == "admin") {
			echo "<th>Propietario</th><th>Apartamento</th>";
		} elseif ($rol == "propietario") {
			echo "<th>Administrador</th><th>Apartamento</th>";
			if ($mostrarAccion) {
				echo "<th>Acción</th>";
			}
		}
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";

		foreach($cuentas as $c){
			echo "<tr>";
			echo "<td>" . $c->getId() . "</td>";
			echo "<td>" . $c->getMes() . "-" . $c->getAnio() . "</td>";
			echo "<td>$" . number_format($c->getMonto(), 0, ',', '.') . "</td>";

			$apto = $c->getApartamento();

			if ($rol == "admin") {
				$prop = $apto->getPropietario();
				echo "<td>" . $prop->getNombre() . " " . $prop->getApellido() . "</td>";
				echo "<td>Torre " . $apto->getTorre() . " - Apto " . $apto->getNumero() . "</td>";
			} elseif ($rol == "propietario") {
				$admin = $c->getAdmin();
				echo "<td>" . $admin->getNombre() . " " . $admin->getApellido() . "</td>";
				echo "<td>Torre " . $apto->getTorre() . " - Apto " . $apto->getNumero() . "</td>";
				if ($mostrarAccion) {
					echo "<td><a href='?pid=" . base64_encode("presentacion/Pagos/pagarCuenta.php") . "&idCuenta=" . $c->getId() . "' class='btn btn-sm btn-outline-success'><i class='bi bi-cash-coin'></i> Pagar</a></td>";
				}
			}

			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>"; 
		echo "</div>"; 
	}


	if (!empty($cuentasNoPagadas)) {
		mostrarTablaCuentas("Cuentas No Pagadas", $cuentasNoPagadas, $rol, true);
	} else {
		echo "<div class='alert alert-success mt-4' role='alert'>
				<i class='bi bi-check-circle-fill me-2'></i>
				No hay cuentas de cobro pendientes por pagar.
			</div>";
	}

	mostrarTablaCuentas("Cuentas Pagadas", $cuentasPagadas, $rol, false);
	?>

					</div>
				</div>
			</div>
		</div>
	</div>

</body>


