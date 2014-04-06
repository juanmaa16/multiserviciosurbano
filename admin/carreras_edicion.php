<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/carrera.php';

$servicios = new Servicios();

$idCarrera = $_GET['id'];

$oCarrera = $servicios->getCarreraById($idCarrera);
$oUniversidad = $servicios->getUniversidadById($oCarrera->getIdUniversidad());


$vUniversidades = $servicios->getUniversidades(); //obtengo todas las universidades para listarlas
?>
<html>
    <head>
        <title>Multiservicios Urbano - Administración - Carreras</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
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
                        <form action="carreras_abm.php?action=edit" method="post">
                            <label>Universidad</label>
                            <select name="id_universidad" class="textbox">                                
                                <?php foreach ($vUniversidades as $oUniversidad) {
                                    ?>
                                    <option value="<?php echo $oUniversidad->getId(); ?>" <?php echo ($oUniversidad->getId() == $oCarrera->getIdUniversidad()) ? 'selected' : ''; ?>><?php echo $oUniversidad->getNombre(); ?></option>
                                <?php } ?>
                            </select><br/><br/>
                            <label>Carrera</label><input type="text" class="textbox" name="nombre_carrera" value="<?php echo $oCarrera->getNombre(); ?>">
                            <input type="hidden" name="id_carrera" value="<?php echo $idCarrera; ?>"/>
                            <br/><br/>
                            <label>&nbsp;</label><input type="submit" class="textbox" value="Editar carrera">
                        </form>    
                    </div>

                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
