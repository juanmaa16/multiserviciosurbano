<?php
include 'admin_check.php';
?>
<html>
    <head>
        <title>Multiservicios Urbano - Administración</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="contenedor">
            <?php include 'header.php' ?>
            <div id="contenido">
                <div style="color:white; padding-left:40px;">
                    <h1>PANEL ADMINISTRADOR</h1>
                </div>

                <div id="centro">
                    <div style="margin-top:40px;margin-bottom: 40px;">
                        <a href="universidades.php">
                            <input type="button" class="textbox" value="UNIVERSIDADES">
                        </a>
                        <br/>
                        <br/>
                        <a href="carreras.php">
                            <input type="button" class="textbox" value="CARRERAS">
                        </a>
                        <br/>
                        <br/>
                        <a href="materias.php">
                            <input type="button" class="textbox" value="MATERIAS">
                        </a>
                        <br/>
                        <br/>
                        <a href="documentos.php">
                            <input type="button" class="textbox" value="DOCUMENTOS">
                        </a>
                    </div>
                </div>
            </div>
            <?php include 'footer.php' ?>
        </div>
    </body>
</html>






