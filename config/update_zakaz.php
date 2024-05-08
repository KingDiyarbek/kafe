<?php
session_start();
require_once 'connect.php';
$id_zakaz = $_POST['id_zakaz'];
mysqli_query($connect, query:"UPDATE `zakaz` SET `Status` = 'Готово' WHERE `zakaz`.`idZakaz` = '$id_zakaz'");
header('Location: ../operator/zakaz.php');
?>