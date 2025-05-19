<?php 
if(isset($_GET["sesion"])){
    if($_GET["sesion"] == "false"){
        session_destroy();
    }
}
$error=false;
if(isset($_POST["autenticar"])){
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $admin = new Administrador("", "", "", $correo, $clave, "");
    if($admin->autenticar()){
        $_SESSION["id"] = $admin -> getId();
        $_SESSION["rol"] = "admin";
        header("Location: ?pid=" . base64_encode("presentacion/sesionAdmin.php"));
    }else{
        $prop = new Propietario("", "", "", $correo, $clave, "");
        if($prop -> autenticar()){
            $_SESSION["id"] = $prop -> getId();
        $_SESSION["rol"] = "propietario";
        header("Location: ?pid=" . base64_encode("presentacion/sesionPropietario.php"));
        }else{
            $error=true;
        }
    }
}
?>

<body class="bg-light">
    <?php include ("presentacion/encabezado.php");?>

    <div class="container my-5">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4>Autenticar</h4>
                    </div>
                    <div class="card-body">
                        <form action="?pid=<?php echo base64_encode("presentacion/autenticar.php")?>" method="post">
                            <div class="mb-3">
                                <input type="email" class="form-control" name="correo" placeholder="Correo">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="clave" placeholder="Clave">
                            </div>
                            <button type="submit" class="btn btn-primary" name="autenticar">Autenticar</button>
                        </form>
                        <?php 
    					if ($error){
    					    echo "<div class='alert alert-danger mt-3' role='alert'>Credenciales incorrectas</div>";
    					}
    					?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
