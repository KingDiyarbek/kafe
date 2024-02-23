<?php
session_start();
require_once 'connect.php';
$uploaddir = '../image/menu/';
$id_tovar = $_POST['id_tovar'];
$id_category = $_POST['id_category'];
$Name = $_POST['Name'];
$Price = $_POST['Price'];
$Description = $_POST['Description'];

if (!empty($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    $fileext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $newfolder = $uploaddir . $id_category . "/";
    $file = $newfolder . $_FILES['file']['name'] . '.' . $fileext;

    if (!file_exists($newfolder)) {
        mkdir($newfolder, 0777, true);
    }

    mysqli_query($connect, "UPDATE menu SET Name = '$Name', Price = '$Price', Description = '$Description', Image = '$file' WHERE menu.idMenu = '$id_tovar'");
    move_uploaded_file($filetmp, $file);
} else {
    mysqli_query($connect, "UPDATE menu SET Name = '$Name', Price = '$Price', Description = '$Description' WHERE menu.idMenu = '$id_tovar'");
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
