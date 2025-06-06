<?php 
session_start();
require("logica/Administrador.php");
require("logica/Propietario.php");
require("logica/CuentaCobro.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conjunto Residencial</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link href="https://use.fontawesome.com/releases/v6.7.2/css/all.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" ></script>
</head>
<?php
$paginas_sin_autenticacion = array(
    "presentacion/autenticar.php",
    "presentacion/noAutorizado.php",
);
$paginas_con_autenticacion = array(
    "presentacion/sesionAdmin.php",
    "presentacion/sesionPropietario.php",
    "presentacion/Cuentas/consultarCuentas.php",
    "presentacion/Cuentas/crearCuentaCobro.php",
    "presentacion/Pagos/pagarCuenta.php"
);
if(!isset($_GET["pid"])){
    include ("presentacion/autenticar.php");
}else{
$pid = base64_decode($_GET["pid"]);
    if(in_array($pid, $paginas_sin_autenticacion)){
        include $pid;
    }else if(in_array($pid, $paginas_con_autenticacion)){
        if(!isset($_SESSION["id"])){
            include "presentacion/autenticar.php";
        }else{
            include $pid;
        }
    }else{
        echo "error 404";
    }
}

?>
</html>


