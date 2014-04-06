<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';

$servicios = new Servicios();

$idUniversidad = $_GET['id'];

$oUniversidad = $servicios->getUniversidadById($idUniversidad);
?>
<html>
    <head>
        <title>Multiservicios Urbano - Administración - Universidades</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="contenedor">

            <?php include_once 'header.php'; ?>

            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">EDITAR UNIVERSIDAD</h1>
                </div>
                <div id="centro">
                    <div style="margin-top:40px;">
                        <form action="universidades_abm.php?action=edit" method="post">
                            <label>Universidad</label><input type="text" class="textbox" name="nombre_universidad" value="<?php echo $oUniversidad->getNombre(); ?>"><br/><br/>
                            <input type="hidden" name="id_universidad" value="<?php echo $idUniversidad ?>"/>
                            <label>&nbsp;</label><input type="submit" class="textbox" value="Agregar universidad">                 
                        </form>
                    </div>

                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
