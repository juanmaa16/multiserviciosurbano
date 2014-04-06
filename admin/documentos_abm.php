<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/documento.php';

$servicios = new Servicios();

$action = $_GET['action'];
if ($action == "add") {
    $codigoDocumento = $_POST['documento_codigo'];
    $pathDocumento = "documentos"; //hardcodeado
    $fechaDocumento = Utilidades::my_date_parse($_POST['documento_fecha']);
    $paginasDocumento = $_POST['documento_paginas'];
    $idMateria = $_POST['id_materia'];
    $nombreDocumento = $_FILES["nombre"]["name"];
    $oDocumento = new Documento();
    $oDocumento->setId($codigoDocumento);
    $oDocumento->setNombre($nombreDocumento);
    $oDocumento->setPath($pathDocumento);
    $oDocumento->setPaginas($paginasDocumento);
    $oDocumento->setFecha($fechaDocumento);
    $oDocumento->setIdMateria($idMateria);
    $servicios->insertDocumento($oDocumento);
    move_uploaded_file($_FILES["nombre"]["tmp_name"], ROOT_DIR . "/documentos/" . $_FILES["nombre"]["name"]);
} elseif ($action == "edit") {
    //TODO
} elseif ($action == "del") {
    $codigoDocumento = $_GET['id'];
    $oDocumento = $servicios->getDocumentoById($codigoDocumento);
    $servicios->deleteDocumento($oDocumento);
    unlink(ROOT_DIR . "/documentos/" . $oDocumento->getNombre());
}
header("Location: documentos.php");
?>
