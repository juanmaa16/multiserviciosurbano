<?php

include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/carrera.php';

$servicios = new Servicios();

$action = $_GET['action'];
if ($action == "add") {
    $nombreCarrera = $_POST['nombre_carrera'];
    $idUniversidad = $_POST['id_universidad'];
    $oCarrera = new Carrera();
    $oCarrera->setNombre($nombreCarrera);
    $oCarrera->setIdUniversidad($idUniversidad);
    $servicios->insertCarrera($oCarrera);
} elseif ($action == "edit") {
    $idCarrera = $_POST['id_carrera'];
    $nombreCarrera = $_POST['nombre_carrera'];
    $idUniversidad = $_POST['id_universidad'];
    $oCarrera = new Carrera();
    $oCarrera->setId($idCarrera);
    $oCarrera->setNombre($nombreCarrera);
    $oCarrera->setIdUniversidad($idUniversidad);
    $servicios->updateCarrera($oCarrera);
} elseif ($action == "del") {
    $idCarrera = $_GET['id'];
    $oCarrera = new Carrera();
    $oCarrera->setId($idCarrera);
    $servicios->deleteCarrera($oCarrera);
}
header("Location: carreras.php");
?>
