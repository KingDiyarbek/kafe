<?php
session_start();
require_once '../config/connect.php';
$NameProduct = $_POST['productName'];
$Kolichestvo = $_POST['productQuantity'];
$Itogo = $_POST['finalPrice'];
$Name = $_POST['userName'];
$Adres = $_POST['userTel'];
mysqli_query($connect, query:"INSERT INTO `zakaz` (`Name`, `Adres`, `NameProduct`, `Kolichestvo`, `Itogo`) VALUES ('$Name', '$Adres', '$NameProduct', '$Kolichestvo', '$Itogo')");
?>