<?php

namespace CITAS\Controller;

use CITAS\Model\Usuario as ModelUsuario;
use CITAS\Model\Cita as ModelCita;
use CITAS\Model\Lugar as ModelLugar;
use CITAS\Model\Utils as ModelUtils;

use PDOException;

include_once("../model/usuario_model.php");
include_once("../model/cita_model.php");
include_once("../model/lugar_model.php");
include_once("../model/utils.php");

// Iniciar la sesión si no está iniciada aún
if (session_status() != PHP_SESSION_ACTIVE) session_start();

// Bloque de control de errores
try {
    // Conectar a la base de datos
    $pdo = ModelUtils::conectar();
    // Recojo el array asociativo de nombres de lugares
    $arrayNombresLugares = ModelLugar::getNombresLugares($pdo);
    // Recojo el array asociativo de id de usuario con nombre de usuario
    $arrayNombresUsuarios = ModelUsuario::getNombresUsuarios($pdo);
    // Verifico si se ha elegido un lugar en especifico, caso contrario se muestran todas las citas de la BDD
    if (!isset($_POST["filtroLugar"]) || $_POST["filtroLugar"] == 0) {
        $arrayCitas = ModelCita::getCitas($pdo);
    } else {
        $idLugar = $_POST["filtroLugar"];
        $arrayCitas = ModelCita::getCitasLocalidad($pdo, $idLugar);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
include("../view/mostrar_citas_view.php");
