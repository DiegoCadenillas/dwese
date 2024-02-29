<?php

namespace CITAS\Model;

use PDO;
use PDOException;

class Utils
{
    // Función para conectar con la BDD
    public static function conectar()
    {
        // Cargamos las variables de la conexión
        include("../settings.inc");
        // Bloque de control de errores
        try {
            // Nos conectamos a la BDD con las variables del fichero settings.inc
            $pdo = new PDO("mysql:host={$host};dbname={$dbname}", $usuario, $password);
        } catch (PDOException $e) {
            // Muestro el mensaje de error y finalizo la ejecución
            echo $e->getMessage();
            die();
        }
        // Devuelvo el objeto PDO
        return $pdo;
    }
}
