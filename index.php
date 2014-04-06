<?php
include_once 'init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/universidad.php';
include_once ROOT_DIR . '/entidades/carrera.php';
include_once ROOT_DIR . '/entidades/materia.php';
include_once ROOT_DIR . '/entidades/documento.php';

$servicios = new Servicios();

$vUniversidades = $servicios->getUniversidades();

$idUniversidad = $_GET['idu'];
$idCarrera = $_GET['idc'];
$idMateria = $_GET['idm'];
if (isset($idUniversidad) && isset($idCarrera) && isset($idMateria)) {
    $oUniversidad = $servicios->getUniversidadById($idUniversidad);
    $oCarrera = $servicios->getCarreraById($idCarrera);
    $oMateria = $servicios->getMateriaById($idMateria);
    $vDocumentos = $servicios->getDocumentosByIdMateria($oMateria->getId());
}
?>
<html>
    <head>
        <title>Multiservicios Urbano</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <script language="javascript" src="js/jquery-1.11.0.min.js"></script>
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
                        url:"materias_ajax.php",
                        type: "POST",
                        data:"idCarrera="+$("#carrera").val(),
                        success: function(opciones){
                            $("#materia").html(opciones);
                        }
                    })
                });
            });
        </script>
    </head>
    <body>
        <div id="contenedor">
            <?php include 'header.php'; ?>
            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">CONSULTAR APUNTES</h1>
                </div>	
                <form method="get">
                    <ul id="list-select">
                        <li>
                            <label>
                                <select name="idu" id="universidad">
                                    <option disabled="disabled" selected="selected">Universidad</option>
                                    <?php foreach ($vUniversidades as $oUniversidad) {
                                        ?>
                                        <option value="<?php echo $oUniversidad->getId(); ?>" <?php echo ($oUniversidad->getId() == $idUniversidad) ? 'selected' : ''; ?>><?php echo $oUniversidad->getNombre(); ?></option>
                                    <?php } ?>
                                </select>
                            </label>
                        </li>
                        <li>
                            <label>
                                <select name="idc" id="carrera">
                                    <option disabled="disabled" selected="selected">Carrera</option>
                                    <?php
                                    if (isset($idCarrera)) {
                                        $vCarreras = $servicios->getCarrerasByIdUniversidad($idUniversidad);
                                        foreach ($vCarreras as $oCarreraSelect) {
                                            ?>
                                            <option value="<?php echo $oCarreraSelect->getId(); ?>" <?php echo ($oCarreraSelect->getId() == $idCarrera) ? 'selected' : ''; ?>><?php echo $oCarreraSelect->getNombre(); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </label>
                        </li>
                        <li>
                            <label>
                                <select name="idm" id="materia">
                                    <option disabled="disabled" selected="selected">Materia</option>
                                    <?php
                                    if (isset($idMateria)) {
                                        $vMaterias = $servicios->getMateriasByIdCarrera($idCarrera);
                                        foreach ($vMaterias as $oMateriaSelect) {
                                            ?>
                                            <option value="<?php echo $oMateriaSelect->getId(); ?>" <?php echo ($oMateriaSelect->getId() == $idCarrera) ? 'selected' : ''; ?>><?php echo $oMateriaSelect->getNombre(); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </label>
                        </li>
                        <li id="last">
                            <input type="submit" value="" id="lupa" />
                        </li>
                    </ul>
                </form>
                <div id="centro" >
                    <?php
                    if (isset($idUniversidad) && isset($idCarrera) && isset($idMateria)) {
                        ?>
                        <table width="85%" style="margin: 40px auto; border: solid 1px #000">
                            <tr>
                                <td id="codigo">Codigo</td>
                                <td id="fecha">Fecha</td>
                                <td>Nombre</td>
                                <td id="paginas">Paginas</td>
                                <td id="ver">Ver</td>
                            </tr>
                            <?php
                            foreach ($vDocumentos as $oDocumento) {
                                ?>
                                <tr>
                                    <td><?php echo $oDocumento->getId(); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($oDocumento->getFecha())); ?></td>
                                    <td><?php echo $oDocumento->getNombre(); ?></td>
                                    <td><?php echo $oDocumento->getPaginas(); ?></td>
                                    <td>
                                        <a href="<?php echo $oDocumento->getPath() . "/" . $oDocumento->getNombre(); ?>" target="_blank">
                                            <img src="images/pages.png">
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                        <?php
                    } else {
                        ?>
                        <p style="margin: 100px auto;">
                            Para consultar los apuntes seleccione una Universidad, una Carrera y una Materia.
                        </p>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>


