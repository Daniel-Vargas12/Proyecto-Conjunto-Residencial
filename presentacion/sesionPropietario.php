<?php
    if($_SESSION["rol"] != "propietario"){
        header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
    }
?>
<?php
$apartamento = new Apartamento("", "", "", "", $_SESSION["id"]);
$listaAptos = $apartamento->consultar();
?>

<body>
<?php 
include ("presentacion/encabezado.php");
include ("presentacion/menuPropietario.php");
?>

<div class="container my-5">
    <div class="text-center mb-4">
        <h2 class="text-primary fw-bold"><i class="bi bi-house-door-fill"></i> Mis Apartamentos</h2>
        <p class="text-muted">Listado detallado de tus apartamentos registrados en el sistema.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Apartamento</th>
                            <th>Metros²</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listaAptos as $apto) { ?>
                            <tr>
                                <td><?php echo $apto->getId(); ?></td>
                                <td><?php echo "Torre " . $apto->getTorre() . " - Apto " . $apto->getNumero(); ?></td>
                                <td><?php echo $apto->getMetrosCuadrados(); ?> m²</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
