<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';

$servicios = new Servicios();

$vUniversidades = $servicios->getUniversidades();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Multiservicios Urbano - Administración - Universidades</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="contenedor">

            <?php include 'header.php'; ?>

            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">UNIVERSIDADES</h1>
                </div>
                <div id="centro">
                    <table width="85%" style="margin: 40px auto; border: solid 1px #000">
                        <tr>
                            <td>Nombre</td>
                            <td style="width: 10%;">Acciones</td>
                        </tr>
                        <?php
                        foreach ($vUniversidades as $oUniversidad) {
                            ?>
                            <tr>
                                <td><?php echo $oUniversidad->getNombre(); ?></td>
                                <td>
                                    <a href="universidades_edicion.php?id=<?php echo $oUniversidad->getId(); ?>"><img src="../images/edit.png"/></a> 
                                    <a href="universidades_abm.php?action=del&id=<?php echo $oUniversidad->getId(); ?>"><img src="../images/delete.png"/></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <a href="universidades_alta.php">
                        <input type="button" class="textbox" value="Nueva universidad">
                    </a>
                    <br/>
                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
