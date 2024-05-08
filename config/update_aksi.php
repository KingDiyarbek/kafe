<?php
session_start();
require_once 'connect.php';
$uploaddir = '../image/aksii/';
$id_aksiya = $_POST['id_aksiya'];
$idFile = $_POST['idFile'];
$Name = $_POST['Name'];
$Date = $_POST['Data'];
$Description = $_POST['Description'];

if (!empty($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    $file = $uploaddir . $filename;

    if (move_uploaded_file($filetmp, $file)) {
        // Загрузка изображения в таблицу img
        mysqli_query($connect, "UPDATE `img` SET `File` = '$file' WHERE `id` = '$idFile'");
        
        // Обновление записи акции с новым изображением
        mysqli_query($connect, "UPDATE `aksii` SET `Name` = '$Name', `Description` = '$Description', `Image` = '$idFile', `Date` = '$Date' WHERE `idAksiya` = '$id_aksiya'");
    } 
} else {
    // Если изображение не загружено, обновляем только данные акции
    mysqli_query($connect, "UPDATE `aksii` SET `Name` = '$Name', `Description` = '$Description', `Date` = '$Date' WHERE `idAksiya` = '$id_aksiya'");
}

// После выполнения запроса перенаправляем обратно на предыдущую страницу
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
