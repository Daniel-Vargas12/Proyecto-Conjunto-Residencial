<?php 
if (!isset($_SESSION['id'])) {
    header('Location: ?pid=' . base64_encode('presentacion/autenticar.php'));
    exit;
}

$id = $_SESSION["id"];
$admin = new Administrador($id);
$admin -> consultar();
?>


<?php include("presentacion/barraNavegacion.php"); ?>
<!-- Módulo de propietarios -->
<?php include("presentacion/propietarios/listarPropietarios.php"); ?>

