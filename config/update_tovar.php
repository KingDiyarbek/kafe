<?php
session_start();
require_once 'connect.php';
$uploaddir = '../image/menu/';
$idMenu = $_POST['id_tovar'];
$Name = $_POST['Name'];
$Price = $_POST['Price'];
$Description = $_POST['Description'];
$id_category = $_POST['id_category'];
$idFile = $_POST['idFile'];
$name_category = $_POST['name_category'];
$Weight = $_POST['Weight'];
$name_category = $_POST['name_category'];
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

    // Перемещение загруженного файла в папку
    move_uploaded_file($filetmp, $file_path);

        // Обновляем только изображение в таблице img

        mysqli_query($connect, "UPDATE `img` SET `File` = '$file_path' WHERE `id` = '$idFile'");
    // Обновление товара в таблице menu_1 с новыми данными и указанием идентификатора файла
    mysqli_query($connect, "UPDATE `menu_1` SET `Name` = '$Name', `Price` = '$Price', `Description` = '$Description', `Sostav` = '$Sostav', `Weight` = '$Weight', `Image` = '$idFile', `Category` = '$id_category' WHERE `idMenu` = '$idMenu'");

} else {
    // Если изображение не загружено, обновляем товар без изменения изображения
    mysqli_query($connect, "UPDATE `menu_1` SET `Name` = '$Name', `Price` = '$Price', `Description` = '$Description', `Sostav` = '$Sostav', `Weight` = '$Weight' WHERE `idMenu` = '$idMenu'");
}

// После выполнения запроса перенаправляем обратно на предыдущую страницу
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
