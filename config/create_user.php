<?php
var_dump($_FILES);
$uploaddir = '../image/sotrudnik/';
$file = $uploaddir.$_FILES['file']['name'];
session_start();
require_once 'connect.php';
$Surname = $_POST['Surname'];
$Name = $_POST['Name'];
$Patronymic = $_POST['Patronymic'];
$Post = $_POST['Post'];
$login = $_POST['login'];
$password = $_POST['password'];
mysqli_query($connect, query:"INSERT INTO `user` (`login`, `password`, `Name`, `Surname`, `Patronymic`, `Post`, `Image`) VALUES ('$login','$password','$Name', '$Surname', '$Patronymic', '$Post', '$file')");
if (!empty($_POST)) {
    if ($_FILES['file'] ['name'] !=''){
        $uploadfile = $uploaddir . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>