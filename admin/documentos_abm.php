<?php

include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/materia.php';

$servicios = new Servicios();

$action = $_GET['action'];
if ($action == "add") {
    $nombreMateria = $_POST['nombre_materia'];
    $idCarrera = $_POST['id_carrera'];
    $oMateria = new Materia();
    $oMateria->setNombre($nombreMateria);
    $oMateria->setIdCarrera($idCarrera);
    $servicios->insertMateria($oMateria);
} elseif ($action == "edit") {
    $idMateria= $_POST['id_materia'];
    $nombreMateria = $_POST['nombre_materia'];
    $idCarrera= $_POST['id_carrera'];
    $oMateria = new Materia();
    $oMateria->setId($idMateria);
    $oMateria->setNombre($nombreMateria);
    $oMateria->setIdCarrera($idCarrera);
    $servicios->updateMateria($oMateria);
} elseif ($action == "del") {
    $idMateria = $_GET['id'];
    $oMateria = new Materia();
    $oMateria->setId($idMateria);
    $servicios->deleteMateria($oMateria);
}
header("Location: materias.php");
?>
