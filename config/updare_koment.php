<?php
session_start();
require_once 'connect.php';
$id_koment = $_POST['id_koment'];
mysqli_query($connect, query:"UPDATE `komentariya` SET `Status` = 'Прочитано' WHERE `komentariya`.`idKomentariya` = '$id_koment'");
header('Location: ../operator/komentariya.php');
?>