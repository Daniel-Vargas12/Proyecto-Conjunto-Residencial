<?php 
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
?>

<body>
<?php 
include ("presentacion/encabezado.php");
include ("presentacion/menu" . ucfirst($rol) . ".php");
?>
<?php
$error = false;
if (isset($_POST["crear"])) {    
    $cuenta = new CuentaCobro(
        '',                          
        $_POST['mes'],
        $_POST['anio'],
        $_POST['estado'],
        $_POST['apartamento'],
        $_POST['administrador']
    );
    
    $cuenta->crear();

    header(
      'Location: index.php?pid='
      . base64_encode('presentacion/Cuentas/consultarCuentas.php')
    );
    exit;
}else $error=true;
?>

<form action="?pid=<?php echo base64_encode("presentacion/Cuentas/crearCuentaCobro.php") ?>" method="post">
    <label for="mes">Mes:</label>
    <input type="text" name="mes" required><br>

    <label for="anio">Año:</label>
    <input type="number" name="anio" required><br>

    <label for="estado">Estado:</label>
    <select name="estado">
        <option value="paga">Paga</option>
        <option value="no paga">No paga</option>
    </select><br>

    <label for="apartamento">ID Apartamento:</label>
    <input type="number" name="apartamento" required><br>

    <label for="administrador">ID Administrador:</label>
    <input type="number" name="administrador" required><br>

    <button type="submit" class="btn btn-primary" name="crear">Crear Cuenta de Cobro</button>
</form>


</body>