<?php
session_start();
require_once 'connect.php';
$id_category = $_POST['id_category'];
$Name = $_POST['Name'];
mysqli_query($connect, query:"UPDATE `category` SET `Name` = '$Name' WHERE `category`.`idCategory` = '$id_category'");

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>