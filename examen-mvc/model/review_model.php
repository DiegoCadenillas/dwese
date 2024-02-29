<?php

namespace CITAS\Model;

use PDOException;

class Review
{
    // Función para buscar el registro de una review específica y devolver un array con sus datos
    public static function getReview($pdo, $idReview)
    {
        // Bloque de control de errores
        try {
            // Preparo la query para sacar los listados cuyo id sean el especificado
            $stmt = $pdo->prepare("SELECT * FROM review WHERE idreview = :idReview");
            // Introduzco la id especificada en la query
            $stmt->bindValue(":idReview", $idReview);
            // Ejecuto la query
            $stmt->execute();
            // Recojo los resultados
            $resultSet = $stmt->fetch();
        } catch(PDOException $e) {
            // Muestro el mensaje de error y finalizo la ejecución
            echo $e->getMessage();
            die();
        }
        // Devuelvo el array de resultados
        return $resultSet;
    }
}
