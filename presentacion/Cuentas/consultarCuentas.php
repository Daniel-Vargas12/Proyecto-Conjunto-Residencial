<?php 
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
?>

<body>
<?php 
include(__DIR__ . "/../encabezado.php");
include(__DIR__ . "/../barraNavegacion.php")
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
						echo "<tr><th>Id</th><th>Año</th><th>Mes</th><th>Estado</th><th>Monto</th>";
						if($rol == "admin"){
							echo "<th>Propietario</th>";
						} elseif($rol == "propietario"){
							echo "<th>Administrador</th>";
							if($mostrarAccion){
							echo "<th>Acción</th>";
						}
						}
						
						echo "</tr>";

						foreach($cuentas as $c){
							echo "<tr>";
							echo "<td>" . $c->getId() . "</td>";
							echo "<td>" . $c->getAnio() . "</td>";
							echo "<td>" . $c->getMes() . "</td>";
							echo "<td>" . $c->getEstado() . "</td>";
							echo "<td>" . $c->getMonto() . "</td>";
							if($rol != "propietario"){
								echo "<td>" . $c->getIdApartamento() . "</td>";
							}
							if($rol != "admin"){
								echo "<td>" . $c->getIdAdmin() . "</td>";
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


