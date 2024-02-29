<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <!-- Select para elegir la localidad a filtrar -->
        <form method=POST action="../controller/lista_citas_controller.php">
            <label for="filtroLugar">Filtrar por lugar:</label>
            <select name="filtroLugar" id="filtroLugar" onchange="this.form.submit()" placeholder="Filtrar por lugar">
                <option default>Filtrar por lugar</option>
                <option value="0">Mostrar todas las citas</option>
                <?php
                foreach ($arrayNombresLugares as $idLugar => $nombreLugar) {
                    print("<option value='$idLugar'>$nombreLugar</option>");
                }
                ?>
            </select>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Propuesta por</th>
                    <th scope="col">Aceptada por</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Id de Ubicación</th>
                    <th scope="col">Id Cita</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($arrayCitas); $i++) {
                    // Para cada registro hay que crear una nueva fila
                    print("<tr>");
                    // Mostramos todos los datos
                    print("<td>" . $arrayNombresUsuarios[$arrayCitas[$i]["usuario_propone"]] . "</td>");
                    print("<td>" . $arrayNombresUsuarios[$arrayCitas[$i]["usuario_acepta"]] . "</td>");
                    print("<td>" . $arrayCitas[$i]["fecha"] . "</td>");
                    print("<td><a href='../controller/cargar_review_controller.php?idReviewPropuesto=" . $arrayCitas[$i]["review_idreviewpropone"] . "&idReviewAcepta=" . $arrayCitas[$i]["review_idreview"] . "'>" . $arrayCitas[$i]["descripcion"] . "</a></td>");
                    print("<td>" . $arrayNombresLugares[$arrayCitas[$i]["lugar_idlugar"]] . "</td>");
                    print("<td>" . $arrayCitas[$i]["idcita"] . "</td>");
                    // Generamos los checkbox para eliminar las citas seleccionadas, devolverá después mediante un botón un array con los ids de las citas a eliminar
                    print("<td><input type=checkbox form='formEliminar' name='idCitaEliminar[]' value='" . $arrayCitas[$i]["idcita"] . "'></td>");
                    print("</tr>");
                }
                ?>
            </tbody>
        </table>

        <!-- Botón para eliminar las citas cuyo checkbox hemos seleccionado -->
        <form method=POST action="../controller/borrar_citas_controller.php" id="formEliminar">
            <button type=submit>Eliminar las Citas marcadas</button>
        </form>
    </div>
</body>

</html>