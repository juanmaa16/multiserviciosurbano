<?php
date_default_timezone_set('UTC');
$submitted=$_POST['submitted'];
if($submitted){
$email_to = 'prueba@prueba.com'; 
$site_name = 'Multiservicios Urbano';
$nombreApellido = trim($_POST['nombre_apellido']);
$telefono = trim($_POST['telefono']);
$email = trim($_POST['email']);
$codigo = trim($_POST['codigo']);
$mensaje = trim($_POST['mensaje']);
$subject = 'Nuevo pedido - ' . $site_name;
$body = "Nombre: $nombre \n\nEmail: $email \n\nTeléfono: $telefono \n\nCódigo de abono: $codigo \n\nMensaje: $mensaje";
$headers = 'From: ' . $nombre . ' <' . $email . '> ' . "\r\n" . 'Reply-To: ' . $email;
mail($email_to, $subject, $body, $headers); 
$emailStatus = "success";
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hacé tu pedido - Multiservicios Urbano</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <script src="js/jquery.js"></script>
        <script src="js/jquery.validate.js"></script>
    </head>
    <body>
        <?php 
        if(!$submitted){
            ?>
        <form action="" method="POST" style="margin:10px;"> 
            <label class="textleft" for="nombre_apellido">Nombre y Apellido</label><br/><input type="text" class="textbox" name="nombre_apellido" id="nombre_apellido" required/><br/>
            <label class="textleft" for="email">Email *</label><br/><input type="text" class="textbox" name="email" id="email" required/><br/>
            <label class="textleft" for="telefono">Telefono</label><br/><input type="text" class="textbox" name="telefono" id="telefono"/><br/>
            <label class="textleft" for="codigo">Codigo de abono *</label><br/><input type="text" class="textbox" name="codigo" id="codigo" required/><br/>
            <label class="textleft" for="mensaje">Mensaje *</label><br/><textarea name="mensaje" class="textbox areabox" style="resize: none;" cols="50" rows="10" required></textarea><br/>
            <!--<label class="textleft" for="seleccionar_archivo">Archivo</label><br/><input type="file" class="textbox" name="seleccionar_archivo" id="seleccionar_archivo"/><br/><br/>-->
            <input type="hidden" name="submitted" value="true"/>
            <br/>
            <input type="submit" class="textbox" value="Pedir"/>
        </form>
        <?php
        }else{
            ?>
        <div style="margin:20px;">
            Su pedido fue realizado con éxito!
        </div>
            <?php
        }
        ?>

    </body>
</html>
