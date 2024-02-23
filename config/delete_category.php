<?php
require_once 'connect.php';
$id_category = $_GET['id'];
mysqli_query($connect, query:"DELETE FROM `category` WHERE `category`.`idCategory` = '$id_category'");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>