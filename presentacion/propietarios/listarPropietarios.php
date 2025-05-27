<div class="container my-5">
    <div class="text-center mb-4">
        <h2 class="text-primary fw-bold"><i class="bi bi-people-fill"></i> Propietarios Registrados</h2>
        <p class="text-muted">Consulta rápida de información general de propietarios activos en el sistema.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th><i class="bi bi-person-fill"></i> Nombre</th>
                            <th><i class="bi bi-envelope-fill"></i> Email</th>
                            <th><i class="bi bi-telephone-fill"></i> Teléfono</th>
                            <th><i class="bi bi-house-fill"></i> Apartamentos</th>
                            <th><i class="bi bi-telephone-fill"></i> Estado Actual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once("logica/Propietario.php");
                        $propietario = new Propietario();
                        $propietarios = Propietario::consultarTodos();

                        foreach ($propietarios as $p) {
                            echo "<tr>";
                            echo "<td>" . $p->getNombre() . " " . $p->getApellido() . "</td>";
                            echo "<td>" . $p->getEmail() . "</td>";
                            echo "<td>" . $p->getTelefono() . "</td>";
                            
                            echo "<td><ul class='mb-0 ps-3'>";
                            foreach ($p->getApartamentos() as $apto) {
                                echo "<li class='mb-1'>";
                                echo "<span class='badge bg-primary me-1'>Torre " . $apto["torre"] . "</span>";
                                echo "<span class='badge bg-secondary me-1'>Apto " . $apto["numero"] . "</span>";
                                echo "<span class='badge bg-info text-dark'>Área: " . $apto["metrosCuadrados"] . " m²</span>";
                                echo "</li>";
                            }
                            echo "</ul></td>";
                            echo "<td>" . $p->getEstadoGeneral() . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
