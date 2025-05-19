<?php
    if($_SESSION["rol"] != "propietario"){
        header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
    }
?>

<body>
    
<?php 
include ("presentacion/encabezado.php");
include ("presentacion/menuPropietario.php");
?>

</body>