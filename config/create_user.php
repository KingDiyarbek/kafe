<?php
session_start();
require_once 'connect.php';
$uploaddir = '../image/sotrudnik/';
$Surname = $_POST['Surname'];
$Name = $_POST['Name'];
$Patronymic = $_POST['Patronymic'];
$Post = $_POST['Post'];
$login = $_POST['login'];
$password = $_POST['password'];

if (!empty($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    $file = $uploaddir . $filename;

    // Перемещение загруженного файла в папку
    if (move_uploaded_file($filetmp, $file)) {
        // Загрузка изображения в таблицу file
        mysqli_query($connect, "INSERT INTO `img` (`id`, `File`) VALUES (NULL, '$file')");
        // Получение идентификатора добавленного файла
        $file_id = mysqli_insert_id($connect);

        // Добавление категории в таблицу category1 с указанием идентификатора файла
        mysqli_query($connect, "INSERT INTO `user` (`idUser`, `login`, `password`, `Name`, `Surname`, `Patronymic`, `Post`, `Image`) VALUES (NULL, '$login', '$password', '$Name', '$Surname', '$Patronymic', '$Post', '$file_id')");

        // Получение идентификатора добавленной записи
        $user_id = mysqli_insert_id($connect);

        // Обновление idUser в таблице img
        mysqli_query($connect, "UPDATE `img` SET `idUser` = '$user_id' WHERE `id` = '$file_id'");

    } 
} else {
    // Если изображение не загружено, добавляем запись без изображения
    mysqli_query($connect, "INSERT INTO `user` (`login`, `password`, `Name`, `Surname`, `Patronymic`, `Post`) VALUES ('$login', '$password', '$Name', '$Surname', '$Patronymic', '$Post')");
}

?>
