<?php

include_once '../init.php';
include_once ROOT_DIR . '/servicios/servicios.php';
include_once ROOT_DIR . '/entidades/usuario.php';

$usuario = $_POST['nombre_usuario'];
$password = $_POST['password_usuario'];

$servicios = new Servicios();
$oUsuario = $servicios->getUsuarios($usuario);

if (isset($oUsuario) && $oUsuario->getUser() == $usuario && $oUsuario->getPass() == md5($password)) {
    echo "Todo bien";
    $_SESSION['estadoLogin'] == TRUE;
    $_SESSION['id_usuario'] == $oUsuario->getId();
    $_SESSION['nombre_usuario'] == $oUsuario->getUser();
} elseif ($usuario == NULL || $password == NULL) {
    header("Location: admin_login.php");
} else {
    header("Location: admin_login.php?msg=error");
}
?>
