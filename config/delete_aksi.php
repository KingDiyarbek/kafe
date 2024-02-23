<?php
require_once 'connect.php';
$id = $_GET['id'];
mysqli_query($connect, query:"DELETE FROM `aksi` WHERE `aksi`.`idAksi` = '$id'");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>