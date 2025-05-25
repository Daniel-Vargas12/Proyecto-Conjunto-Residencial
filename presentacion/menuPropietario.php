<?php 
$id = $_SESSION["id"];
$prop = new Propietario($id);
$prop -> consultar();
include("presentacion/barraNavegacionP.php"); 
?>

