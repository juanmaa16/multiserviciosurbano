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
$anio = $_GET['anio'];
if (isset($idUniversidad) && isset($idCarrera) && isset($idMateria) && isset($anio)) {
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
                $("#anio").change(function(){
                    $.ajax({
                        url:"materias_ajax.php",
                        type: "POST",
                        data:"idCarrera="+$("#carrera").val()+"&anioMateria="+$("#anio").val(),
                        success: function(opciones){
                            $("#materia").html(opciones);
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
            <?php include 'header.php'; ?>
            <div id="contenido">
                <div style="color:white; margin-left:40px; overflow: hidden;">
                    <h1 id="consultar-texto" style="width: 50%;float: left;">
                        CONSULTAR APUNTES
                    </h1>
                    <a title="Solo es posible realizar pedidos si cuenta con un abono" href="form-pedido.php" target="popup" onClick="window.open(this.href, this.target, 'scrollbars=0,width=305,height=395'); return false;">
                        <img src="images/pedido.png" id="pedido"/>
                    </a>
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
                                <select name="anio" id="anio">
                                    <option disabled="disabled" selected="selected">Año</option>
                                    <?php
                                    if (isset($anio)) {
                                        $aniosCarrera = $oCarrera->getAnios();
                                        for ($i = 1; $i <= $aniosCarrera; $i++) {
                                            if ($i == $anio) {
                                                echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                            } else {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
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
                                        $vMaterias = $servicios->getMateriasByIdCarreraAnio($idCarrera, $anio);
                                        foreach ($vMaterias as $oMateriaSelect) {
                                            ?>
                                            <option value="<?php echo $oMateriaSelect->getId(); ?>" <?php echo ($oMateriaSelect->getId() == $idMateria) ? 'selected' : ''; ?>><?php echo $oMateriaSelect->getNombre(); ?></option>
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
                    if (isset($idUniversidad) && isset($idCarrera) && isset($idMateria) && isset($anio)) {
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
                                        <?php
                                        $nombreArchivoDocumento = $oDocumento->getNombreArchivo();
                                        if (isset($nombreArchivoDocumento) && $nombreArchivoDocumento != NULL) {
                                            ?>
                                            <a href="<?php echo $oDocumento->getPath() . "/" . $oDocumento->getNombreArchivo(); ?>" target="_blank">
                                                <img src="images/pages.png">
                                            </a>
                                            <?php
                                        }
                                        ?>

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


