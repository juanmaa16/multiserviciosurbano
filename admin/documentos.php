<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/carrera.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/materia.php';
include_once ROOT_DIR . '/entidades/documento.php';

$perpage = 12;
$total_results = 0;
if (!isset($_GET['pag'])) {
    $page = 1;
} else {
    $page = $_GET['pag'];
}
$from = (($page * $perpage - $perpage));

$servicios = new Servicios();

$vDocumentos = $servicios->getDocumentosPag($from, $perpage);
$total_results = count($servicios->getDocumentos());
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Multiservicios Urbano - Administración - Documentos</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="contenedor">

            <?php include 'header.php'; ?>

            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">DOCUMENTOS</h1>
                </div>
                <div id="centro">
                    <a href="documentos_alta.php">
                        <input type="button" class="textbox" value="Nuevo documento" style="margin-top:20px;">
                    </a>
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
                            $oMateria = $servicios->getMateriaById($oDocumento->getIdMateria());
                            $oCarrera = $servicios->getCarreraById($oMateria->getIdCarrera());
                            $oUniversidad = $servicios->getUniversidadById($oCarrera->getIdUniversidad());
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
                    <br/>
                    <div id="tnt_pagination" style="clear: both;text-align: center;margin-bottom: 20px;">
                        <?php
                        //PAGINACION
                        $total_pages = ceil($total_results / $perpage);
                        if ($page > 1) {
                            $prev = ($page - 1);
                            echo '<a href="?pag=' . $prev . '">&lt;&lt;</a>';
                        } elseif ($total_pages == 1 || $page == 1) {
                            echo '<span class="disabled_tnt_pagination"><<</span>';
                        }

                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($page == $i) {
                                echo '<a href="#"><b> ' . $i . ' </b></a>';
                            } else {
                                echo '<a href="?pag=' . $i . '"> ' . $i . ' </a>';
                            }
                        }

                        if ($page < $total_pages) {
                            $next = ($page + 1);
                            echo '<a href="?pag=' . $next . '"> >></a>';
                        }
                        if ($page == $total_pages) {
                            echo '<span class="disabled_tnt_pagination">>></span>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
