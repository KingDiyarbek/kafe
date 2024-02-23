<?php
require_once 'connect.php';
$id_tovar = $_GET['id'];
mysqli_query($connect, query:"DELETE FROM `menu` WHERE `menu`.`idMenu` = '$id_tovar'");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>