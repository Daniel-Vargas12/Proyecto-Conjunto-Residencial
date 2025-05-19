<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conjunto Residencial</title>
    <!-- Asegúrate de incluir Bootstrap y Font Awesome -->
</head>
<body>
    <nav class="bg-primary text-white py-2">
        <div class="container">
            <div class="fw-bold fs-5 mb-2 mb-md-0">
                Conjunto Residencial
            </div>
            <div class="d-flex flex-column flex-md-row gap-3 text-center text-md-start">
                <a href="#" class="text-white text-decoration-none">Pagar cuenta de cobro</a>
                <a href="#" class="text-white text-decoration-none">Consultar estado</a>
                <a href="?pid=<?php echo base64_encode('presentacion/autenticar.php') ?>" class="text-white text-decoration-none">
                    <i class="fas fa-user me-1"></i>Autenticar
                </a>
            </div>
        </div>
    </nav>
</body>
</html>
