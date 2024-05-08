
<?php
session_start();
require_once 'connect.php';
$uploaddir = '../image/category/';
$idFile = $_POST['idFile'];
$id_category = $_POST['id_category'];
$Name = $_POST['Name'];

if (!empty($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    $file = $uploaddir . $filename;

    if (move_uploaded_file($filetmp, $file)) {
        // Загрузка изображения в таблицу img
        mysqli_query($connect, "UPDATE `img` SET `File` = '$file' WHERE `id` = '$idFile'");
        
        // Обновление записи акции с новым изображением
        mysqli_query($connect, query:"UPDATE `category` SET `Name_category` = '$Name',Image = '$id_file'  WHERE `category`.`idCategory` = '$id_category'");

    }
} else {
    // Если изображение не загружено, обновляем только данные акции
    mysqli_query($connect, query:"UPDATE `category` SET `Name_category` = '$Name' WHERE `category`.`idCategory` = '$id_category'");}

// После выполнения запроса перенаправляем обратно на предыдущую страницу
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>