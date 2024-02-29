<!doctype html>
<html lang="en">

<head>
    <title>Recepción Datos Tienda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <?php
    // Reviso que al menos se haya mandado el nombre de la tienda, que tengo puesto como campo obligatorio
    if (isset($_POST["nombre"])) {
        function volumenes_totales($datos_tomos)
        {
            // Creo la variable para contar la suma de las unidades o volúmenes totales
            $cant_volumenes = 0;

            foreach ($datos_tomos as $tomo) {
                // Datos de forma [nombre, detalles, paginas, unidades, categoria, coleccionista, almacen]
                $datos_tomo = explode(",", trim($tomo));

                // Sumo las unidades del tomo actual al total
                $cant_volumenes += $datos_tomo[3];
            }

            return $cant_volumenes;
        }

        function cantidad_unidades_xls($datos_tomos)
        {
            // Creo la variable que contará la cantidad de unidades XLS
            $cant_xls = 0;

            foreach ($datos_tomos as $tomo) {
                // Datos de forma [nombre, detalles, paginas, unidades, categoria, coleccionista, almacen]
                $datos_tomo = explode(",", trim($tomo));


                // Verifico si las unidades del tomo actual cuentan como XLS
                if ($datos_tomo[2] > 300 && $datos_tomo[5] == "S") $cant_xls += $datos_tomo[3];
            }

            return $cant_xls;
        }

        function hay_stock_coleccionista($datos_tomos)
        {
            // Asumo que se cumple al principio
            $result = true;
            // Array que lleva cuenta del stock de las provincias
            $arr_stock_coleccionista = [
                "cadiz" => 0,
                "malaga" => 0,
                "granada" => 0,
                "almeria" => 0,
                "huelva" => 0,
                "sevilla" => 0,
                "cordoba" => 0,
                "jaen" => 0
            ];

            if (isset($_POST["fisica"])) {
                foreach ($datos_tomos as $tomo) {
                    // Datos de forma [nombre, detalles, paginas, unidades, categoria, coleccionista, almacen]
                    $datos_tomo = explode(",", trim($tomo));

                    // Si es coleccionista, sumo las unidades al stock de la provincia del tomo
                    if ($datos_tomo[5] == "S") $arr_stock_coleccionista[$datos_tomo[6]] += $datos_tomo[3];
                }

                // Recorro los stock que tiene cada provincia
                foreach ($arr_stock_coleccionista as $provincia => $stock) {
                    if ($stock < 10) $result = false;   // Si no se cumple que hayan más de 10 entonces el resultado es falso
                }
            } else $result = false;

            return $result;
        }

        function stock_por_provincia($datos_tomos)
        {
            // Creo el array asociativo que contendrá los stocks por provincia
            $arr_stock = [
                "cadiz" => 0,
                "malaga" => 0,
                "granada" => 0,
                "almeria" => 0,
                "huelva" => 0,
                "sevilla" => 0,
                "cordoba" => 0,
                "jaen" => 0
            ];

            foreach ($datos_tomos as $tomo) {
                // Datos de forma [nombre, detalles, paginas, unidades, categoria, coleccionista, almacen]
                $datos_tomo = explode(",", trim($tomo));


                // Sumo las unidades del tomo actual al array de stock
                $arr_stock[strtolower($datos_tomo[6])] += $datos_tomo[3]; // strtolower es por si se escriben con mayúsculas las provincias, pero como ha dicho en clase que en todo caso leerá el código, tampoco es necesario
            }

            return $arr_stock;
        }

        function cumple_cercania($datos_tomos, $provincia_tienda)
        {
            $cumple = true; // Asumo que se cumple la condición
            // Creo un array con las cercanías de cada provincia
            $arr_cercanias = [
                "cadiz" => ["huelva", "sevilla", "malaga"],
                "malaga" => ["cadiz", "sevilla", "cordoba", "granada"],
                "granada" => ["malaga", "cordoba", "jaen", "almeria"],
                "almeria" => ["granada"],
                "huelva" => ["cadiz", "sevilla"],
                "sevilla" => ["huelva", "cadiz", "malaga", "cordoba"],
                "cordoba" => ["sevilla", "malaga", "granada", "jaen"],
                "jaen" => ["cordoba", "granada"]
            ];

            foreach ($datos_tomos as $tomo) {
                // Datos de forma [nombre, detalles, paginas, unidades, categoria, coleccionista, almacen]
                $datos_tomo = explode(",", trim($tomo));


                // Si no se cumple que la provincia del tomo actual es una cercanía de la provincia de la tienda, o la misma provincia, es false
                if (!in_array(strtolower($datos_tomo[6]), $arr_cercanias[$provincia_tienda]) || strtolower($datos_tomo[6]) == $provincia_tienda) $cumple = false;
                // strtolower es por si se escriben con mayúsculas las provincias, pero como ha dicho en clase que en todo caso leerá el código, tampoco es necesario
            }

            return $cumple;
        }

        function stock_tomo($datos_tomos, $provincia, $nombre_tomo)
        {
            // Creo un array con las provincias colindantes de cada provincia
            $arr_cercanias = [
                "cadiz" => ["huelva", "sevilla", "malaga"],
                "malaga" => ["cadiz", "sevilla", "cordoba", "granada"],
                "granada" => ["malaga", "cordoba", "jaen", "almeria"],
                "almeria" => ["granada"],
                "huelva" => ["cadiz", "sevilla"],
                "sevilla" => ["huelva", "cadiz", "malaga", "cordoba"],
                "cordoba" => ["sevilla", "malaga", "granada", "jaen"],
                "jaen" => ["cordoba", "granada"]
            ];

            $stock_disponible = 0;

            foreach ($datos_tomos as $tomo) {
                // Datos de forma [nombre, detalles, paginas, unidades, categoria, coleccionista, almacen]
                $datos_tomo = explode(",", trim($tomo));

                // Si el nombre recibido se encuentra en el nombre o descripcion del tomo actual
                if (str_contains($datos_tomo[0], $nombre_tomo) || str_contains($datos_tomo[1], $nombre_tomo)) {
                    // Si la provincia del tomo actual es colindante o la misma provincia recibida, se suman las unidades al stock
                    if ($datos_tomo[6] == $provincia || in_array($datos_tomo[6], $arr_cercanias[$provincia])) $stock_disponible += $datos_tomo[3];
                    echo $provincia."|".$datos_tomo[6];
                }
            }

            return $stock_disponible;
        }

        echo "<h1>Recepción de datos</h1>";

        // Recojo los datos de todos los tomos
        $datos_tomos = explode("\n", $_POST["tomos"]);

        // Muestro por pantalla las pruebas de las funciones usando los datos de la tienda recibidos
        echo "<p>Número de volúmenes totales: " . volumenes_totales($datos_tomos) . ".</p>";

        echo "<p>Cantidad de unidades XLS (+300 pág y de edición coleccionista): " . cantidad_unidades_xls($datos_tomos) . ".</p>";

        if (hay_stock_coleccionista($datos_tomos)) echo "<p>Sí hay stock coleccionista.</p>";
        else echo "<p>No hay stock coleccionista.</p>";

        echo "<p>Stock por provincia:";
        foreach (stock_por_provincia($datos_tomos) as $provincia => $stock) {
            if ($stock > 0) echo "<br/>$provincia: $stock.";
        }
        echo "</p>";

        if (cumple_cercania($datos_tomos, $_POST["provincia"])) echo "<p>Sí cumple cercanía.</p>";
        else echo "<p>No cumple cercanía.</p>";

        echo "<p>Si desea probar la última función, le he dejado en el código fuente, el código necesario comentado para realizar la prueba.</p>";

        $nombre_tomo = "juan";
        echo "<p>El stock del tomo $nombre_tomo es: ".stock_tomo($datos_tomos, $_POST["provincia"], $nombre_tomo).".</p>";

    } else {
        echo "<h1>ERROR: No se ha accedido a la página correctamente.</h1>";
        echo "<p>Introduzca los datos de la tienda en el siguiente <a href=\"./formulario-tienda.php\">formulario</a>";
    }
    ?>



    <!-- JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>