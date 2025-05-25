<div class="container my-5">
    <div class="text-center mb-4">
        <h2 class="text-primary fw-bold">Propietarios Registrados</h2>
        <p class="text-muted">Consulta rápida de información general de propietarios activos en el sistema.</p>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Apartamentos</th>
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
                    
                    echo "<td><ul class='mb-0'>";
                    foreach ($p->getApartamentos() as $apto) {
                        echo "<li>Torre: " . $apto["torre"] . ", Número: " . $apto["numero"] . ", Metros²: " . $apto["metrosCuadrados"] . "</li>";
                    }
                    echo "</ul></td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
