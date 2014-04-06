<?php
include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/carrera.php';
include_once ROOT_DIR . '/entidades/universidad.php';

$servicios = new Servicios();

$vCarreras = $servicios->getCarreras();
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="contenedor">

            <?php include '../header.php'; ?>

            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">CARRERAS</h1>
                </div>
                <div id="centro">
                    <table width="85%" style="margin: 40px auto; border: solid 1px #000">
                        <tr>
                            <td style="width: 45%;">Nombre</td>
                            <td style="width: 45%;">Universidad</td>
                            <td style="width: 10%;">Acciones</td>
                        </tr>
                        <?php
                        foreach ($vCarreras as $oCarrera) {
                            $oUniversidad=$servicios->getUniversidadById($oCarrera->getIdUniversidad());
                            ?>
                            <tr>
                                <td><?php echo $oCarrera->getNombre(); ?></td>
                                <td><?php echo $oUniversidad->getNombre(); ?></td>
                                <td>
                                    <a href="carreras_edicion.php?id=<?php echo $oCarrera->getId(); ?>"><img src="../images/edit.png"/></a> 
                                    <a href="carreras_abm.php?action=del&id=<?php echo $oCarrera->getId(); ?>"><img src="../images/delete.png"/></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <a href="carreras_alta.php">
                        <input type="button" class="textbox" value="Nueva carrera">
                    </a>
                    <br/>
                </div>
            </div>

            <?php include '../footer.php'; ?>
        </div>
    </body>
</html>
