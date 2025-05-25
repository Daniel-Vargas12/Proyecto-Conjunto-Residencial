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

<div class="container mt-4">
    <h3>Mis Apartamentos</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Torre</th>
                <th>Metros Cuadrados</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaAptos as $apto) { ?>
    <tr>
        <td><?php echo $apto->getId(); ?></td>
        <td><?php echo $apto->getNumero(); ?></td>
        <td><?php echo $apto->getTorre(); ?></td>
        <td><?php echo $apto->getMetrosCuadrados(); ?> m²</td>
    </tr>
<?php } ?>

        </tbody>
    </table>
</div>


</body>