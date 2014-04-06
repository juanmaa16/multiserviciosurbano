<?php

include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/carrera.php';
include_once ROOT_DIR . '/entidades/materia.php';

$servicios = new Servicios();

$idCarrera = $_POST['idCarrera'];

$vMaterias = $servicios->getMateriasByIdCarrera($idCarrera);

$opciones = '<option disabled="disabled" selected="selected">Seleccione materia...</option>';

foreach ($vMaterias as $oMateria) {
    $opciones.='<option value="' . $oMateria->getId() . '">' . $oMateria->getNombre() . '</option>';
}

echo $opciones;
?>
