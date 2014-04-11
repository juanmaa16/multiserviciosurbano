<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/carrera.php';
include_once ROOT_DIR . '/entidades/materia.php';

$servicios = new Servicios();

$idMateria = $_GET['id'];

$oMateria = $servicios->getMateriaById($idMateria);
$oCarrera = $servicios->getCarreraById($oMateria->getIdCarrera());
$oUniversidad = $servicios->getUniversidadById($oCarrera->getIdUniversidad());


$vUniversidades = $servicios->getUniversidades(); //obtengo todas las universidades para listarlas
$vCarreras = $servicios->getCarrerasByIdUniversidad($oUniversidad->getId()); //obtengo todas las carreras de la univ para listarlas
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
    </head>
    <body>
        <div id="contenedor">

            <?php include_once 'header.php'; ?>

            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">EDITAR CARRERA</h1>
                </div>
                <div id="centro">
                    <div style="margin-top:40px;">
                        <form action="materias_abm.php?action=edit" method="post">
                            <label>Universidad</label>
                            <select name="id_universidad" id="universidad" class="textbox">                           
                                <?php foreach ($vUniversidades as $oUniversidad) {
                                    ?>
                                    <option value="<?php echo $oUniversidad->getId(); ?>"<?php echo ($oUniversidad->getId() == $oCarrera->getIdUniversidad()) ? 'selected' : ''; ?>><?php echo $oUniversidad->getNombre(); ?></option>
                                <?php } ?>
                            </select>
                            <br/><br/>
                            <label>Carrera</label>
                            <select name="id_carrera" id="carrera" class="textbox"> 
                                <?php foreach ($vCarreras as $oCarrera) {
                                    ?>
                                    <option value="<?php echo $oCarrera->getId(); ?>"<?php echo ($oCarrera->getId() == $oMateria->getIdCarrera()) ? 'selected' : ''; ?>><?php echo $oCarrera->getNombre(); ?></option>
                                <?php } ?>
                            </select>
                            <br/><br/>
                            <label>Año de cursado</label>
                            <select name="anio_materia" id="anio" class="textbox"> 
                                <?php 
                                $aniosCarrera=$oCarrera->getAnios();
                                for ($i = 1; $i <= $aniosCarrera; $i++) {
                                    ?>
                                    <option value="<?php echo $i; ?>"<?php echo ($i == $oMateria->getAnio()) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                            <br/><br/>
                            <label>Materia</label><input type="text" class="textbox" name="nombre_materia" value="<?php echo $oMateria->getNombre(); ?>">
                            <input type="hidden" name="id_materia" value="<?php echo $oMateria->getId(); ?>"/>
                            <br/><br/>
                            <label>&nbsp;</label><input type="submit" class="textbox" value="Editar materia">
                        </form>    
                    </div>

                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
