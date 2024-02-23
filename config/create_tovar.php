<?php
$uploaddir = '../image/menu/';
session_start();
require_once 'connect.php';
$Name = $_POST['Name'];
$Price = $_POST['Price'];
$Description = $_POST['Description'];
$id_category = $_POST['id_category'];

if (!empty($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    $fileext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $newfolder = $uploaddir . $id_category . "/";
    $file = $newfolder . $_FILES['file']['name'] . '.' . $fileext;

    if (!file_exists($newfolder)) {
        mkdir($newfolder, 0777, true);
    }

    mysqli_query($connect, "INSERT INTO menu (Name, Price, Description, Image, Category_idCategory) VALUES ('$Name', '$Price', '$Description', '$file', '$id_category')");
    move_uploaded_file($filetmp, $file);
} else {
    mysqli_query($connect, "INSERT INTO menu (Name, Price, Description, Category_idCategory) VALUES ('$Name', '$Price', '$Description', '$id_category')");
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>