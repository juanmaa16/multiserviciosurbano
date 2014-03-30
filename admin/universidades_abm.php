<?php

include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';

$servicios = new Servicios();

$action = $_GET['action'];
if ($action == "add") {
    $nombre_universidad = $_POST['nombre_universidad'];
    echo $nombre_universidad;
    $oUniversidad = new Universidad();
    $oUniversidad->setNombre($nombre_universidad);
    $servicios->insertUniversidad($oUniversidad);
}
?>
