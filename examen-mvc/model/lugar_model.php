<?php

namespace CITAS\Model;

use PDOException;

class Lugar
{
    // Función para leer todos los lugares de la tabla lugar de la BDD
    public static function getLugares($pdo)
    {
        // Bloque de control de errores
        try {
            // Ejecuto directamente la query que lee todos los registros de la tabla
            $stmt = $pdo->query("SELECT * FROM lugar");
            // Recojo los resultados
            $resultSet = $stmt->fetchAll();
        } catch(PDOException $e) {
            // Muestro el mensaje de error y finalizo la ejecución
            echo $e->getMessage();
            die();
        }
        // Devuelvo el array de resultados
        return $resultSet;
    }

    // Función para generar un array asociativo con los id como claves y el nombre del lugar como valor
    public static function getNombresLugares($pdo) {
        // Bloque de control de errores
        try {
            // Inicializo el array asociativo
            $arrayNombres  = [];
            // Ejecuto la query para obtener los ids y nombres de todos los lugares
            $stmt = $pdo->query("SELECT idlugar, nombre FROM lugar");
            // Recojo los resultados
            $resultSet = $stmt->fetchAll();
            // Construyo el array asociativo
            foreach($resultSet as $lugar) {
                $arrayNombres[$lugar["idlugar"]] = $lugar["nombre"];
            }
        } catch(PDOException $e) {
            // Muestro el mensaje de error y finalizo la ejecución
            echo $e->getMessage();
            die();
        }
        // Devuelvo el array asociativo
        return $arrayNombres;
    }
}
