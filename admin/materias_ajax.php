<?php

include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/carrera.php';
include_once ROOT_DIR . '/entidades/materia.php';

$servicios = new Servicios();

$idCarrera = $_POST['idCarrera'];
$anioMateria = $_POST['anioMateria'];

$vMaterias = $servicios->getMateriasByIdCarreraAnio($idCarrera, $anioMateria);

$opciones = '<option disabled="disabled" selected="selected">Seleccione materia...</option>';

foreach ($vMaterias as $oMateria) {
    $opciones.='<option value="' . $oMateria->getId() . '">' . $oMateria->getNombre() . '</option>';
}

echo $opciones;
?>
