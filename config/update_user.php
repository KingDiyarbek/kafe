<?php
session_start();
require_once 'connect.php';
$uploaddir = '../image/sotrudnik/';
$idUser = $_POST['idUser'];
$Surname = $_POST['Surname'];
$Name = $_POST['Name'];
$Patronymic = $_POST['Patronymic'];
$Post = $_POST['Post'];
$login = $_POST['login'];
$password = $_POST['password'];
$idFile = $_POST['idFile'];

if (!empty($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    $file = $uploaddir . $filename;

    if (move_uploaded_file($filetmp, $file)) {
        // Обновляем только изображение в таблице img
        mysqli_query($connect, "UPDATE `img` SET `File` = '$file' WHERE `id` = '$idFile'");
        // Обновляем данные пользователя в таблице user
        mysqli_query($connect, "UPDATE `user` SET `login` = '$login', `password` = '$password', `Name` = '$Name', `Surname` = '$Surname', `Patronymic` = '$Patronymic', `Post` = '$Post', `Image` = '$idFile' WHERE `idUser` = '$idUser'");
        $message = 'Файл успешно загружен.';
    } else {
        $message = 'Ошибка при загрузке файла.';
    }
} else {
    // Если изображение не загружено, обновляем только данные пользователя
    mysqli_query($connect, "UPDATE `user` SET `login` = '$login', `password` = '$password', `Name` = '$Name', `Surname` = '$Surname', `Patronymic` = '$Patronymic', `Post` = '$Post' WHERE `idUser` = '$idUser'");
}

// После выполнения запроса перенаправляем обратно на предыдущую страницу
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
