<?php
$id = $_SESSION["id"];
$admin = new Administrador($id);
$admin -> consultar();
?>

<?php
$id = $_SESSION["id"];
$admin = new Administrador($id);
$admin->consultar();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <!-- Logo / Inicio -->
    <a class="navbar-brand fw-bold" href="?pid=<?php echo base64_encode("presentacion/sesionAdmin.php") ?>">
      <i class="fa-solid fa-house me-2"></i>Inicio
    </a>

    <!-- Botón hamburguesa -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin"
      aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido colapsable -->
    <div class="collapse navbar-collapse" id="navbarAdmin">
      <!-- Izquierda -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- Dropdown Cuentas -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="cuentasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-file-invoice-dollar me-1"></i>Cuentas de cobro
          </a>
          <ul class="dropdown-menu" aria-labelledby="cuentasDropdown">
            <li>
              <a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/Cuentas/consultarCuentas.php") ?>">
                <i class="fa-solid fa-search me-1"></i>Consultar
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/Cuentas/crearCuentaCobro.php") ?>">
                <i class="fa-solid fa-plus-circle me-1"></i>Generar
              </a>
            </li>
          </ul>
        </li>
      </ul>

      <!-- Derecha -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user-tie me-1"></i>Administrador: <?php echo $admin->getNombre() . " " . $admin->getApellido(); ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-pen me-1"></i>Editar Perfil</a></li>
            <li>
              <a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/autenticar.php") ?>&sesion=false">
                <i class="fa-solid fa-right-from-bracket me-1"></i>Cerrar Sesión
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
