<?php
session_start();
require_once 'connect.php';
$login = $_POST['login'];
$password = $_POST['password'];

$chek_user = mysqli_query($connect, "SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password' AND `Post`  = 'Администратор'");
$chek_admin = mysqli_query($connect, "SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password' AND `Post`  = 'Директор'");
$chek_operator = mysqli_query($connect, "SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password' AND `Post`  = 'Оператор'");

if (mysqli_num_rows($chek_user) > 0) {
    $user = mysqli_fetch_assoc($chek_user);
    $_SESSION['user'] = [
        "id" => $user['idUser'],
        "Name" => $user['Name'],
        "Surname" => $user['Surname'],
        "Patronymic" => $user['Patronymic'],
        "Post" => $user['Post']
    ];
    header('Location:../user/profile.php');
} elseif (mysqli_num_rows($chek_admin) > 0) {
    $admin = mysqli_fetch_assoc($chek_admin);
    $_SESSION['admin'] = [
        "id" => $admin['idUser'],
        "Name" => $admin['Name'],
        "Surname" => $admin['Surname'],
        "Patronymic" => $admin['Patronymic'],
        "Post" => $admin['Post']
    ];
    header('Location:../admin/profile.php');
} elseif (mysqli_num_rows($chek_operator) > 0) {
    $operator = mysqli_fetch_assoc($chek_operator);
    $_SESSION['operator'] = [
        "id" => $operator['idUser'],
        "Name" => $operator['Name'],
        "Surname" => $operator['Surname'],
        "Patronymic" => $operator['Patronymic'],
        "Post" => $operator['Post']
    ];
    header('Location:../operator/zakaz.php');
} else {
    $_SESSION['message'] = 'Неверный логин или пароль';
    header('Location:../admin.php');
}
