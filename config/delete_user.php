<?php
require_once 'connect.php';
$idUser = $_GET['idUser'];
mysqli_query($connect, query:"DELETE FROM `user` WHERE `user`.`idUser` = '$idUser'");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>