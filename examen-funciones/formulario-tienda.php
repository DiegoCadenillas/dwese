<!doctype html>
<html lang="en">

<head>
    <title>Formulario Tienda Manga</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <!-- 
    Crear una página web en php que muestre un formulario con los siguientes campos, Con
    información sobre una tienda manga y su stock en los almacenes.

    Nombre texto
    Física(checkbox si/no)
    dirección texto
    provincia (desplegable, todas las provincias andaluzas)
    Presupuesto range con steps de 1 unidad 15-150
    fecha apertura tienda (date)
    Tomos Manga Área de Texto
    Botón Solicitud


    Los tomos se introducirán en un área de texto, en cada línea (Recordar que \n es
    separador de línea) se introduce una fase en el siguiente formato:
    one piece, tomo 23, 324, 5, shonen, S, Málaga
    nombre,detalles,paginas,stock,categoria,coleccionista,almacen

    Siendo los datos, nombre, detalle,paginas, unidades en stock, categoria (shonen, shojo,
    kodomo) ,Edición coleccionista (S/N) y almacén (Provincias Andaluzas) separados por ‘,’


    Cuando se pulse el botón, se enviará a otra página php que realizara lo siguiente:

    Mostrará una estadística de los datos del manga, de la siguiente manera:

    Número de Volumenes Totales (suma de stocks): X

    Cantidad de Unidades XLS Disponibles(Más de 300pag y ed colecionista):X

    Hay Stock Colecionista: La función recibirá los almacenes, devolverá true si hay mas de
    10 tomos coleccionista en cada provincia y es tienda física.

    Stock por Provincia: (calculará y la suma de los stock de los tomos de cada provincia, se
    calculará utilizando una función que reciba los datos de los tomos y devuelva un array
    asociativo del tipo [“jaen” =&gt;230,”sevilla”=&gt;400,”almeria”=&gt;320]. No tienen porque estar
    todas las provincias)

    Cumple Cercanía : Utilizar una función que recibe los datos de los tomos y la provincia de
    la tienda y devuelva true si sólo hay tomos en provincias colindantes con la tienda

    Stock Tomo: La función recibe los datos de los tomos ,la provincia y el nombre de un
    manga y comprueba si en los almacenes de las provincias colindantes a la tienda hay stock
    de dicho manga, para saber si es el manga, tiene que buscar el nombre del manga y estar
    presente en el nombre o en la descripción. Devuelve el número de stock disponible.
    -->

    <h1>Formulario de Datos de Tienda</h1>

    <!-- Contenedor para el formulario con el cual se mandarán los datos. -->
    <div class="container-sm  pt-4 pl-4 pr-4">
        <div class="row">
            <div class="col-7 p-5">
                <!--El formulario envia con el metodo post los datos -->
                <form method="post" action="recepcion-tienda.php">
                    <!-- Texto "nombre" -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de la tienda: </label>
                        <input type="text" required class="form-control" name="nombre" id="nombre" rows="1"></textarea>
                    </div>

                    <!-- Checkbox "fisico" -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" name="fisica" id="fisica">
                        <label class="form-check-label" for="fisica">
                            Física
                        </label>
                    </div>

                    <!-- Texto "direccion" -->
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección de la tienda: </label>
                        <input type="text" class="form-control" name="direccion" id="direccion" rows="1"></textarea>
                    </div>

                    <!-- Select "provincia" -->
                    <div class="mb-3">
                        <label for="provincia" class="form-label">Provincia: </label>
                        <select class="form-select form-select-lg" name="provincia" id="provincia">
                            <option selected>Elija una</option>
                            <option value="cadiz">Cádiz</option>
                            <option value="malaga">Málaga</option>
                            <option value="granada">Granada</option>
                            <option value="almeria">Almería</option>
                            <option value="huelva">Huelva</option>
                            <option value="sevilla">Sevilla</option>
                            <option value="cordoba">Córdoba</option>
                            <option value="jaen">Jaén</option>
                        </select>
                    </div>

                    <!-- Range "presupuesto" -->
                    <div class="mb-3">
                        <label for="presupuesto" class="form-label">Presupuesto: </label>
                        <input type="range" name="presupuesto" id="presupuesto" min=15 max=150 step=1>
                    </div>

                    <!-- Date "fch_apertura" -->
                    <div class="mb-3">
                        <label for="fch-apertura" class="form-label">Fecha de apertura: </label>
                        <input type="date" class="form-control" name="fch_apertura" id="fch-apertura">
                    </div>

                    <!-- Text Area "tomos" -->
                    <div class="mb-3">
                        <label for="tomos" class="form-label">Tomos disponibles: </label>
                        <br />
                        <textarea class="form-control" name="tomos" id="tomos" rows="5"></textarea>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>


    <!-- JavaScript de Boosstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>