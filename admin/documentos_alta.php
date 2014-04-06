<?php
include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/carrera.php';
include_once ROOT_DIR . '/entidades/materia.php';

$servicios = new Servicios();

$vUniversidades = $servicios->getUniversidades(); //obtengo todas las universidades para listarlas
?>

<html>
    <head>
        <meta charset="UTF-8">
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
                $("#carrera").change(function(){
                    $.ajax({
                        url:"materias_ajax.php",
                        type: "POST",
                        data:"idCarrera="+$("#carrera").val(),
                        success: function(opciones){
                            $("#materia").html(opciones);
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

            <?php include_once '../header.php'; ?>

            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">CARGAR DOCUMENTO</h1>
                </div>
                <div id="centro">
                    <div style="margin-top:40px;">
                        <form action="documentos_abm.php?action=add" method="POST" enctype="multipart/form-data">
                            <label>Código</label>
                            <input type="text" name="documento_codigo" class="textbox"/>
                            <br/><br/>
                            <label>Universidad</label>
                            <select name="id_universidad" id="universidad" class="textbox">                                
                                <option disabled="disabled" selected="selected">Seleccione universidad...</option>
                                <?php foreach ($vUniversidades as $oUniversidad) {
                                    ?>
                                    <option value="<?php echo $oUniversidad->getId(); ?>"><?php echo $oUniversidad->getNombre(); ?></option>
                                <?php } ?>
                            </select>
                            <br/><br/>
                            <label>Carrera</label>
                            <select name="id_carrera" id="carrera" class="textbox"> 
                            </select>
                            <br/><br/>
                            <label>Materia</label>
                            <select name="id_materia" id="materia" class="textbox"> 
                            </select>
                            <br/><br/>
                            <label>Fecha</label>
                            <input type="text" name="documento_fecha" id="fecha_documento" class="textbox"/>
                            <br/><br/>
                            <label>Nro páginas</label>
                            <input type="text" name="documento_paginas" id="fecha_documento" class="textbox"/>
                            <br/><br/>
                            <label>Documento</label><input type="file" name="nombre">
                            <br/><br/>
                            <label>&nbsp;</label><input type="submit" class="textbox" value="Agregar documento">
                        </form>    
                    </div>

                </div>
            </div>

            <?php include '../footer.php'; ?>
        </div>
    </body>
</html>
