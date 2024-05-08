<?php
$uploaddir = '../image/menu/';
session_start();
require_once 'connect.php';
$Name = $_POST['Name'];
$Price = $_POST['Price'];
$Description = $_POST['Description'];
$id_category = $_POST['id_category'];
$name_category = $_POST['name_category'];
$Weight = $_POST['Weight'];
$Sostav = $_POST['Sostav'];

if (!empty($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    $fileext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $newfolder = $uploaddir . $name_category . "/"; // Используем название категории в качестве имени папки
    $file_path = $newfolder . $filename . '.' . $fileext; // Имя файла будет таким же, как оригинальное имя загружаемого файла

    if (!file_exists($newfolder)) {
        mkdir($newfolder, 0777, true);
    }

    // Загрузка изображения в таблицу Image1
    mysqli_query($connect, "INSERT INTO `img` (`id`, `File`) VALUES (NULL, '$file_path')");
    // Получение идентификатора добавленного файла
    $file_id = mysqli_insert_id($connect);

    // Добавление товара в таблицу menu1 с указанием идентификатора файла
    mysqli_query($connect, "INSERT INTO `menu` (`idMenu`, `Name`, `Price`, `Description`, `Sostav`, `Weight`, `Image`, `Category`) VALUES (NULL, '$Name', '$Price', '$Description', '$Sostav', '$Weight', '$file_id', '$id_category') ");

    // Обновление idMenu в таблице Image
    $menu_id = mysqli_insert_id($connect);
    mysqli_query($connect, "UPDATE `img` SET `idMenu` = '$menu_id' WHERE `id` = '$file_id'");

    // Перемещение загруженного файла в папку
    move_uploaded_file($filetmp, $file_path);
} else {
    // Если изображение не загружено, добавляем товар без изображения
    mysqli_query($connect, "INSERT INTO menu (Name, Price, Description, Sostav, Category) VALUES ('$Name', '$Price', '$Description', '$Sostav', '$Weight', '$id_category')");
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
