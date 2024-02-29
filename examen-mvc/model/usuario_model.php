<?php

namespace CITAS\Model;

use PDOException;

class Usuario
{
    // Función para leer todos los registros de la tabla usuario de la BDD
    public static function getUsuarios($pdo)
    {
        // Bloque de control de errores
        try {
            // Ejecuto directamente la query para leer todos los registros de la tabla
            $stmt = $pdo->query("SELECT * FROM usuario");
            // Recojo los resultados
            $resultSet = $stmt->fetchAll();
        } catch (PDOexception $e) {
            // Muestro el mensaje de error y finalizo la ejecución
            echo $e->getMessage();
            die();
        }
        // Devuelvo el array de resultados
        return $resultSet;
    }

    // Función para obtener un array asociativo, con los ids de usuarios como claves y sus nombres y apellidos como valores
    public static function getNombresUsuarios($pdo)
    {
        // Bloque de control de errores
        try {
            // Inicializo el array asociativo
            $arrayNombres = [];
            // Ejecuto la query para obtener el nombre del usuario cuyo id sea el especificado
            $stmt = $pdo->query("SELECT idusuario, nombre, apellido FROM usuario");
            // Recojo los resultados
            $resultSet = $stmt->fetchAll();
            // Construyo el array asociativo
            foreach($resultSet as $usuario) {
                $arrayNombres[$usuario["idusuario"]] = $usuario["nombre"] . " " . $usuario["apellido"];
            }
        } catch (PDOException $e) {
            // Muestro el mensaje de error y finalizo la ejecución
            echo $e->getMessage();
            die();
        }
        // Devuelvo el array de nombres
        return $arrayNombres;
    }
}
