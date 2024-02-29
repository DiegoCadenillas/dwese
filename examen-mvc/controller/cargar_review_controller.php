<?php

namespace CITAS\Controller;

use CITAS\Model\Review as ModelReview;
use CITAS\Model\Utils as ModelUtils;

use PDOException;

include_once("../model/review_model.php");
include_once("../model/utils.php");

// Iniciar la sesión si no está iniciada aún
if (session_status() != PHP_SESSION_ACTIVE) session_start();

// Bloque de control de errores
try {
    // Entablo la conexión
    $pdo = Modelutils::conectar();
    // Recojo los ids de las reviews de la cita
    $idReviewPropuesto = $_GET["idReviewPropuesto"];
    $idReviewAcepta = $_GET["idReviewAcepta"];
    // Leo todos los registros de la tabla review
    $reviewPropuesto = ModelReview::getReview($pdo, $idReviewPropuesto);
    $reviewAcepta = ModelReview::getReview($pdo, $idReviewAcepta);
} catch (PDOException $e) {
    echo $e->getMessage();
}
// Muestro la vista de reviews
include("../view/mostrar_review_view.php");