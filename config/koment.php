<?php
session_start();
require_once 'connect.php';

$uploaddir = '../image/';

$Name = $_POST['name'];
$email = $_POST['email'];
$komentariya = $_POST['komentariya'];

// Проверяем наличие загружаемых файлов
if (!empty($_FILES['files']['name'][0])) {
    // Цикл для обработки каждого загружаемого файла
    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        // Проверяем, был ли загружен файл и не произошло ли ошибок в процессе загрузки
        if (isset($_FILES['files']['tmp_name'][$key]) && $_FILES['files']['error'][$key] === UPLOAD_ERR_OK) {
            $file_name = $_FILES['files']['name'][$key];
            $file_path = $uploaddir . $file_name;

            // Перемещаем файл из временной директории в директорию загрузки
            if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $file_path)) {
                // Добавляем информацию о файле в базу данных
                $query = "INSERT INTO `komentariya` (`Name`, `email`, `komentariya`, `File`) VALUES ('$Name', '$email', '$komentariya', '$file_path')";
                mysqli_query($connect, $query);
            } else {
                echo "Ошибка при перемещении файла: $file_name";
            }
        } else {
            echo "Ошибка при загрузке файла: {$_FILES['files']['name'][$key]}";
        }
    }
} else {
    // Если файлы не были загружены, добавляем запись в базу данных без файла
    $query = "INSERT INTO `komentariya` (`Name`, `email`, `komentariya`) VALUES ('$Name', '$email', '$komentariya')";
    mysqli_query($connect, $query);
}

// Перенаправляем пользователя обратно на предыдущую страницу
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
