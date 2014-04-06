<?php
include 'admin_check.php';
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
        <title>Multiservicios Urbano - Administración - Materias</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <script language="javascript" src="../js/jquery-1.9.1.min.js"></script>
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
            });
        </script>
    </head>
    <body>
        <div id="contenedor">

            <?php include_once 'header.php'; ?>

            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">CARGAR MATERIA</h1>
                </div>
                <div id="centro">
                    <div style="margin-top:40px;">
                        <form action="materias_abm.php?action=add" method="post">
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
                            <label>Materia</label><input type="text" class="textbox" name="nombre_materia">
                            <br/><br/>
                            <label>&nbsp;</label><input type="submit" class="textbox" value="Agregar materia">
                        </form>    
                    </div>

                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
