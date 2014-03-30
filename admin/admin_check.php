<?php

session_start();

$estadoLogin = $_SESSION['estado'];
if (!isset($estadoLogin) || !$estadoLogin) {
    header("Location: admin_login.php");
    exit;
}
?>
