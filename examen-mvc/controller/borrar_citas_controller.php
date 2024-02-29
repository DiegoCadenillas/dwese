<?php

namespace CITAS\Controller;

use CITAS\Model\Cita as ModelCita;
use CITAS\Model\Utils as ModelUtils;

use PDOException;

include_once("../model/cita_model.php");
include_once("../model/utils.php");

// Iniciar la sesión si no está iniciada aún
if (session_status() != PHP_SESSION_ACTIVE) session_start();

// Bloque de control de errores
try {
    //Conectar con la BDD
    $pdo = ModelUtils::conectar();
    // Si he recibido el array de ids por post
    if (isset($_POST["idCitaEliminar"])) {
        $idCitaEliminar = $_POST["idCitaEliminar"];
        // Por cada id del array llamo al método de borrar citas
        for ($i = 0; $i < count($idCitaEliminar); $i++) {
            ModelCita::borrarCita($pdo, $idCitaEliminar[$i]);
        }
    }
    // Llamo al controller para cargar los datos nuevamente y cargar la lista
    include("../controller/lista_citas_controller.php");
} catch (PDOException $e) {
    echo $e->getMessage();
}
