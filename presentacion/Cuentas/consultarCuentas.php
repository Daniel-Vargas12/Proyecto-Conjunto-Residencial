<?php 
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
?>

<body>
<?php 
include(__DIR__ . "/../encabezado.php");
include(__DIR__ . "/../menu" . ucfirst($rol) . ".php");

?>
<div class="container">
	<div class="row mt-3">
		<div class="col">
			<div class="card">
				<div class="card-header"><h4>Cuentas de Cobro</h4></div>
				<div class="card-body">
    				<?php 
    				$CuentaCobro = new CuentaCobro();
    				$cuentas = $CuentaCobro -> consultar($rol,$id);
    				echo "<table class='table table-striped table-hover'>";
    				echo "<tr><td>Id</td><td>Año</td><td>Mes</td><td>Estado</td>";
    				if($rol == "admin"){
						echo "<th>Propietario</th>";
					} elseif($rol == "propietario"){
						echo "<th>Administrador</th>";
					}
                    
    				foreach($cuentas as $c){
    				    echo "<tr>";
    				    echo "<td>" . $c -> getId() . "</td>";
    				    echo "<td>" . $c -> getAnio() . "</td>";
    				    echo "<td>" . $c -> getMes() . "</td>";
                        echo "<td>" . $c -> getEstado() . "</td>";
    				    if($rol != "propietario"){
        				    echo "<td>" . $c -> getIdApartamento() ."</td>";
    				    }
    				    if($rol != "admin"){
    				        echo "<td>" . $c -> getIdAdmin()."</td>";
    				    }
    				}
    				echo "</table>";
    				?>			
				</div>
			</div>
		</div>
	</div>
</div>
</body>

