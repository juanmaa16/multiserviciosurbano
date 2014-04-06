<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="contenedor">

            <?php include_once '../header.php'; ?>

            <div id="contenido">
                <div style="color:white; margin-left:40px;">
                    <h1 id="consultar-texto">CARGAR UNIVERSIDAD</h1>
                </div>
                <div id="centro">
                    <div style="margin-top:40px;">
                        <form action="universidades_abm.php?action=add" method="post">
                            <label>Universidad</label><input type="text" class="textbox" name="nombre_universidad"><br/><br/>
                            <label>&nbsp;</label><input type="submit" class="textbox" value="Agregar universidad">                        </form>
                    </div>

                </div>
            </div>

            <?php include '../footer.php'; ?>
        </div>
    </body>
</html>
