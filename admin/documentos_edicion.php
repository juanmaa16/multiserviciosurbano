<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/carrera.php';
include_once ROOT_DIR . '/entidades/materia.php';
include_once ROOT_DIR . '/entidades/documento.php';

$servicios = new Servicios();

$idDocumento = $_GET['id'];

$oDocumento = $servicios->getDocumentoById($idDocumento);
$oMateriaDocumento = $servicios->getMateriaById($oDocumento->getIdMateria());
$anioMateria = $oMateriaDocumento->getAnio();
$oCarreraDocumento = $servicios->getCarreraById($oMateriaDocumento->getIdCarrera());
$oUniversidadDocumento = $servicios->getUniversidadById($oCarreraDocumento->getIdUniversidad());


$vUniversidades = $servicios->getUniversidades(); //obtengo todas las universidades para listarlas
$vCarreras = $servicios->getCarreras(); //obtengo todas las carreras para listarlas
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Multiservicios Urbano - Administración - Documentos</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <script language="javascript" src="../js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#universidad").change(function(){
                    $.ajax({
                        url:"carreras_ajax.php",
                        type: "POST",
                        data:"idUniversidad="+$("#universidad").val(),
                        success: function(opciones){
                            $("#carrera").html(opciones);
                        }
                    })
                });
                $("#anio").change(function(){
                    $.ajax({
                        url:"materias_ajax.php",
                        type: "POST",
                        data:"idCarrera="+$("#carrera").val()+"&anioMateria="+$("#anio").val(),
                        success: function(opciones){
                            $("#materia").html(opciones);
                        }
                    })
                });
                $("#carrera").change(function(){
                    $.ajax({
                        url:"carreras_anios_ajax.php",
                        type: "POST",
                        data:"idCarrera="+$("#carrera").val(),
                        success: function(opciones){
                            $("#anio").html(opciones);
                        }
                    })
                });
            });
        </script>   

        <!--DatePicker-->
        <link href="../js/datepicker/jquery.datepick.css" rel="stylesheet">
        <script src="../js/datepicker/jquery.plugin.js"></script>
        <script src="../js/datepicker/jquery.datepick.js"></script>
        <script>
            $(function() {
                $('#fecha_documento').datepick({dateFormat: 'dd-mm-yyyy',defaultDate: '0d',selectDefaultDate: true, showTrigger: '#calImg'});;
            });
        </script>
        <!--End DatePicker-->
    </head>
    <body>
        <div id="contenedor">

            <?php include_once 'header.php'; ?>

            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">CARGAR DOCUMENTO</h1>
                </div>
                <div id="centro">
                    <div style="margin-top:40px;">
                        <form action="documentos_abm.php?action=edit" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_documento" value="<?php echo $idDocumento; ?>"/>
                            <label>Código</label>
                            <input type="text" name="documento_codigo" class="textbox" value="<?php echo $oDocumento->getId(); ?>"/>
                            <br/><br/>
                            <label>Universidad</label>
                            <select name="id_universidad" id="universidad" class="textbox">                                
                                <option disabled="disabled" selected="selected">Seleccione universidad...</option>
                                <?php foreach ($vUniversidades as $oUniversidad) {
                                    ?>
                                    <option value="<?php echo $oUniversidad->getId(); ?>" <?php echo ($oUniversidad->getId() == $oUniversidadDocumento->getId()) ? "selected" : ""; ?>><?php echo $oUniversidad->getNombre(); ?></option>
                                <?php } ?>
                            </select>
                            <br/><br/>
                            <label>Carrera</label>
                            <select name="id_carrera" id="carrera" class="textbox"> 
                                <option value="<?php echo $oCarreraDocumento->getId(); ?>"><?php echo $oCarreraDocumento->getNombre(); ?></option>
                            </select>
                            <br/><br/>
                            <label>Año de cursado</label>
                            <select name="anio_materia" id="anio" class="textbox"> 
                                <option value="<?php echo $anioMateria; ?>"><?php echo $anioMateria; ?></option>
                            </select>
                            <br/><br/>
                            <label>Materia</label>
                            <select name="id_materia" id="materia" class="textbox"> 
                                <option value="<?php echo $oMateriaDocumento->getId(); ?>"><?php echo $oMateriaDocumento->getNombre(); ?></option>
                            </select>
                            <br/><br/>
                            <label>Fecha</label>
                            <input type="text" name="documento_fecha" id="fecha_documento" class="textbox" value="<?php echo date("d-m-Y", strtotime($oDocumento->getFecha())) ?>"/>
                            <br/><br/>
                            <label>Nro páginas</label>
                            <input type="text" name="documento_paginas" id="documento_paginas" class="textbox" value="<?php echo $oDocumento->getPaginas(); ?>"/>
                            <br/><br/>
                            <label>
                                <a data="Si el nombre del archivo se deja en blanco, se completara con el nombre del documento">
                                    <img src="../images/interrogation.png" width="16"/>
                                </a>
                                Nombre 
                            </label>
                            <input type="text" name="documento_nombre" class="textbox" value="<?php $oDocumento->getNombre(); ?>"/>
                            <br/><br/>
                            <label>Documento</label><input type="file" name="nombre">
                            <br/><br/>
                            <label>&nbsp;</label><input type="submit" class="textbox" value="Agregar documento">
                        </form>    
                    </div>

                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
