<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Descripción</th>
                    <th scope="col">Puntuación</th>
                    <th scope="col">ID de Usuario</th>
                </tr>
            </thead>
            <tbody>
                <!-- Primera review, empiezo por la del usuario que propuso la cita-->
                <tr>
                    <?php
                    // Muestro una celda por cada dato de la review, como debo saltarme el id empiezo por el segundo dato
                    for ($i = 1; $i < count($reviewPropuesto)/2; $i++) {
                        print("<td>" . $reviewPropuesto[$i] . "</td>");
                    }
                    ?>
                </tr>
                <!-- Ahora lo mismo con la review del usuario que aceptó la propuesta de cita -->
                <tr>
                    <?php
                    // Muestro una celda por cada dato de la review, como debo saltarme el id empiezo por el segundo dato
                    for ($i = 1; $i < count($reviewAcepta)/2; $i++) {
                        print("<td>" . $reviewAcepta[$i] . "</td>");
                    }
                    ?>
                </tr>
            </tbody>
        </table>

        <!-- Botón para eliminar las citas cuyo checkbox hemos seleccionado -->
        <form method=POST action="../controller/borrar_citas_controller.php" id="formEliminar">
            <button type=submit>Eliminar las Citas marcadas</button>
        </form>
    </div>
</body>

</html>