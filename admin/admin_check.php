<?php

session_start();

$estadoLogin = $_SESSION['estadoLogin'];
if (!isset($estadoLogin) || !$estadoLogin) {
    header("Location: admin_login.php");
    exit;
}
?>
