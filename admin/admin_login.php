<html>
    <head>
        <title>Multiservicios Urbano - Administración</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    </head>

    <body>

        <div id="contenedor">
            <?php include 'header.php'; ?>


            <div id="contenido">
                <div style="color:white; padding-left:40px;">
                    <h1>INGRESO ADMINISTRADOR</h1>
                </div>

                <div id="centro">
                    <form action="index.php" method="POST">
                        <div style="margin-top:40px;width: 100%">
                            <label for="nombre_usuario">Usuario</label><input type="text" class="textbox" id="nombre_usuario" name="nombre_usuario"><br/><br/>
                            <label for="password_usuario">Password</label><input type="password" class="textbox" id="password_usuario" name="password_usuario"><br/><br/>
                            <label>&nbsp;</label><input type="submit" class="textbox" value="Iniciar sesión">
                        </div>
                    </form>

                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>



