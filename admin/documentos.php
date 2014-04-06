<?php
include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/carrera.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/materia.php';
include_once ROOT_DIR . '/entidades/documento.php';

$servicios = new Servicios();

$vDocumentos= $servicios->getDocumentos();
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
                    <h1 id="consultar-texto">DOCUMENTOS</h1>
                </div>
                <div id="centro">
                    <table width="85%" style="margin: 40px auto; border: solid 1px #000">
                        <tr>
                            <td style="width: 10%;">Código</td>
                            <td style="width: 20%;">Nombre</td>
                            <td style="width: 20%;">Materia</td>
                            <td style="width: 20%;">Carrera</td>
                            <td style="width: 20%;">Universidad</td>
                            <td style="width: 10%;">Acciones</td>
                        </tr>
                        <?php
                        foreach ($vDocumentos as $oDocumento) {
                            $oMateria=$servicios->getMateriaById($oDocumento->getIdMateria());
                            $oCarrera=$servicios->getCarreraById($oMateria->getIdCarrera());
                            $oUniversidad=$servicios->getUniversidadById($oCarrera->getIdUniversidad());
                            ?>
                            <tr>
                                <td><?php echo $oDocumento->getId(); ?></td>
                                <td><?php echo $oDocumento->getNombre(); ?></td>
                                <td><?php echo $oMateria->getNombre(); ?></td>
                                <td><?php echo $oCarrera->getNombre(); ?></td>
                                <td><?php echo $oUniversidad->getNombre(); ?></td>
                                <td>
                                    <!--<a href="documentos_edicion.php?id=<?php echo $oDocumento->getId(); ?>"><img src="../images/edit.png"/></a>--> 
                                    <a href="#"><img src="../images/edit.png"/></a> 
                                    <a href="documentos_abm.php?action=del&id=<?php echo $oDocumento->getId(); ?>"><img src="../images/delete.png"/></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <a href="documentos_alta.php">
                        <input type="button" class="textbox" value="Nuevo documento">
                    </a>
                    <br/>
                </div>
            </div>

            <?php include '../footer.php'; ?>
        </div>
    </body>
</html>
