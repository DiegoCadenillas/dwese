<?php

namespace CITAS\Model;

use PDOException;

class Cita
{
    // Función para obtener todas las citas de la BDD
    public static function getCitas($pdo)
    {
        // Bloque de control de errores
        try {
            // Ejecuto directamente la query para leer todos los registros de la tabla cita
            $stmt = $pdo->query("SELECT * FROM cita");
            // Recojo los resultados
            $resultSet = $stmt->fetchAll();
        } catch (PDOException $e) {
            // Muestro el mensaje de error por pantalla si es que ha habido un error y finalizo la ejecución
            echo $e->getMessage();
            die();
        }
        // Devuelvo el array de resultados
        return $resultSet;
    }

    // Función para obtener las citas de la BDD en un lugar con id dado
    public static function getCitasLocalidad($pdo, $idLugar)
    {
        // Bloque de control de errores
        try {
            // Preparo la query para leer los registros de la tabla cita cuyo idLugar sea el especificado
            $stmt = $pdo->prepare("SELECT * FROM cita WHERE lugar_idlugar = :idLugar");
            // Asocio el id recibido al de la query
            $stmt->bindValue(":idLugar", $idLugar);
            // Ejecuto la query
            $stmt->execute();
            // Recojo los resultados
            $resultSet = $stmt->fetchAll();
        } catch (PDOException $e) {
            // Muestro el mensaje de error y finalizo la ejecución
            echo $e->getMessage();
            die();
        }
        // Devuelvo los resultados
        return $resultSet;
    }

    // Función para borrar la cita con id dado de la BDD
    public static function borrarCita($pdo, $idCita)
    {
        // Bloque de control de errores
        try {
            // Preparo la query para borrar la cita con id dado
            $stmt = $pdo->prepare("DELETE FROM cita WHERE idcita = :idCita");
            // Le asocio el id de la cita
            $stmt->bindValue(":idCita", $idCita);
            // Ejecuto la query
            $stmt->execute();
            // Si se ha borrado la cita con éxito el feedback será 1, de lo contrario será 0
            $feedback = ($stmt->rowCount() != 0) ? 1 : -1;
        } catch (PDOException $e) {
            // Muestro el mensaje de error por pantalla si hay error y finalizo la ejecución
            echo $e->getMessage();
            die();
        } finally {
            // Quito la conexión
            $pdo = null;
        }
        // Devuelvo el feedback
        return $feedback;
    }
}
