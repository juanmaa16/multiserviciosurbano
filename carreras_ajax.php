<?php

include_once 'init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/carrera.php';

$servicios = new Servicios();

$idUniversidad = $_POST['idUniversidad'];

$vCarreras = $servicios->getCarrerasByIdUniversidad($idUniversidad);

$opciones = '<option disabled="disabled" selected="selected">Seleccione carrera...</option>';

foreach ($vCarreras as $oCarrera) {
    $opciones.='<option value="' . $oCarrera->getId() . '">' . $oCarrera->getNombre() . '</option>';
}

echo $opciones;
?>
