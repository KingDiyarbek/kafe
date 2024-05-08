<?php
session_start();
require_once 'connect.php';
$uploaddir = '../image/';
$Name = $_POST['Name'];
$Date = $_POST['Date'];
$Description = $_POST['Description'];

if (!empty($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    $file = $uploaddir . $filename;

    // Перемещение загруженного файла в папку
    if (move_uploaded_file($filetmp, $file)) {
        // Загрузка изображения в таблицу img
        mysqli_query($connect, "INSERT INTO `img` (`id`, `File`) VALUES (NULL, '$file')");
        // Получение идентификатора добавленного файла
        $file_id = mysqli_insert_id($connect);

        // Добавление акции в таблицу aksii с указанием идентификатора файла
        mysqli_query($connect, "INSERT INTO `aksii` (`Name`, `Date`, `Description`, `Image`) VALUES ('$Name', '$Date', '$Description', '$file_id')");

        // Получение идентификатора добавленной акции
        $aksii_id = mysqli_insert_id($connect);

        // Обновление idAksii в таблице img
        mysqli_query($connect, "UPDATE `img` SET `idAksii` = '$aksii_id' WHERE `id` = '$file_id'");
        $message = 'Файл успешно загружен.';
    }
} else {
    // Если изображение не загружено, добавляем запись без изображения
    mysqli_query($connect, "INSERT INTO `aksii` (`Name`, `Date`, `Description`) VALUES ('$Name', '$Date', '$Description')");
}
?>
