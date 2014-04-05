<?php

include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';

$servicios = new Servicios();

$action = $_GET['action'];
if ($action == "add") {
    $nombreUniversidad = $_POST['nombre_universidad'];
    $oUniversidad = new Universidad();
    $oUniversidad->setNombre($nombreUniversidad);
    $servicios->insertUniversidad($oUniversidad);
} elseif ($action == "edit") {
    $nombreUniversidad = $_POST['nombre_universidad'];
    $idUniversidad = $_POST['id_universidad'];
    $oUniversidad = new Universidad();
    $oUniversidad->setId($idUniversidad);
    $oUniversidad->setNombre($nombreUniversidad);
    $servicios->updateUniversidad($oUniversidad);
} elseif ($action == "del") {
    $idUniversidad = $_GET['id'];
    $oUniversidad = new Universidad();
    $oUniversidad->setId($idUniversidad);
    $servicios->deleteUniversidad($oUniversidad);
}
header("Location: universidades.php");
//falta redireccionar a la lista
?>
