<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/carrera.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/materia.php';

$servicios = new Servicios();

$vMaterias = $servicios->getMaterias();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Multiservicios Urbano - Administración - Materias</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="contenedor">

            <?php include 'header.php'; ?>

            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">MATERIAS</h1>
                </div>
                <div id="centro">
                    <table width="85%" style="margin: 40px auto; border: solid 1px #000">
                        <div style="margin-top: 20px;">
                          <a href="materia-index.html">
                            <input type="button" class="textbox" value="Nueva materia">
                          </a>
                        </div> 
                        
                        <tr>
                            <td style="width: 30%;">Nombre</td>
                            <td style="width: 30%;">Carrera</td>
                            <td style="width: 30%;">Universidad</td>
                            <td style="width: 10%;">Acciones</td>
                        </tr>
                        <?php
                        foreach ($vMaterias as $oMateria) {
                            $oCarrera=$servicios->getCarreraById($oMateria->getIdCarrera());
                            $oUniversidad=$servicios->getUniversidadById($oCarrera->getIdUniversidad());
                            ?>
                            <tr>
                                <td><?php echo $oMateria->getNombre(); ?></td>
                                <td><?php echo $oCarrera->getNombre(); ?></td>
                                <td><?php echo $oUniversidad->getNombre(); ?></td>
                                <td>
                                    <a href="materias_edicion.php?id=<?php echo $oMateria->getId(); ?>"><img src="../images/edit.png"/></a> 
                                    <a href="materias_abm.php?action=del&id=<?php echo $oMateria->getId(); ?>"><img src="../images/delete.png"/></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
            
                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
