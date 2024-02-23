<?php
session_start();
require_once 'connect.php';
$uploaddir = '../image';
$file = $uploaddir.$_FILES['file']['name'];
$idUser = $_POST['idUser'];
$Surname = $_POST ['Surname'];
$Name = $_POST['Name'];
$Patronymic = $_POST['Patronymic'];
$login = $_POST['login'];
$password = $_POST['password'];
mysqli_query($connect, query:"UPDATE `user` SET `login` = '$login', `password` = '$password', `Name` = '$Name', `Surname` = '$Surname', `Patronymic` = '$Patronymic',`Image` = '$file' WHERE `user`.`idUser` = '$idUser'");
if (!empty($_POST)) {
    if ($_FILES['file'] ['name'] !=''){
        $uploadfile = $uploaddir . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>