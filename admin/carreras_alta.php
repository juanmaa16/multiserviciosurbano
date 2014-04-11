<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/carrera.php';

$servicios = new Servicios();

$vUniversidades = $servicios->getUniversidades(); //obtengo todas las universidades para listarlas
?>

<html>
    <head>
        <title>Multiservicios Urbano - Administración - Carreras</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="contenedor">

            <?php include_once 'header.php'; ?>

            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">CARGAR CARRERA</h1>
                </div>
                <div id="centro">
                    <div style="margin-top:40px;">
                        <form action="carreras_abm.php?action=add" method="post">
                            <label>Universidad</label>
                            <select name="id_universidad" class="textbox">                                
                                <option disabled="disabled" selected="selected">Seleccione universidad...</option>
                                <?php foreach ($vUniversidades as $oUniversidad) {
                                    ?>
                                    <option value="<?php echo $oUniversidad->getId(); ?>"><?php echo $oUniversidad->getNombre(); ?></option>
                                <?php } ?>
                            </select><br/><br/>
                            <label>Carrera</label><input type="text" class="textbox" name="nombre_carrera">
                            <br/><br/>
                            <label>Cantidad de años</label>
                            <select name="anios_carrera" class="textbox">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5" selected>5</option>
                                <option value="6">6</option>
                            </select>
                            <br/><br/>
                            <label>&nbsp;</label><input type="submit" class="textbox" value="Agregar carrera">
                        </form>    
                    </div>

                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
