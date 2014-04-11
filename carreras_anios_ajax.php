<?php

include_once 'init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/carrera.php';

$servicios = new Servicios();

$idCarrera = $_POST['idCarrera'];

$oCarreras = $servicios->getCarreraById($idCarrera);
$aniosCarrera=$oCarreras->getAnios();
$opciones = '<option disabled="disabled" selected="selected">Seleccione año...</option>';

for ($i = 1; $i <= $aniosCarrera; $i++) {
    $opciones.='<option value="' . $i . '">' . $i . '</option>';
}

echo $opciones;
?>
