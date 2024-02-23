<?php
session_start();
require_once 'connect.php';
$uploaddir = '../image/aksii/';
$id_aksiya = $_POST['id_aksiya'];
$Name = $_POST['Name'];
$Data = $_POST['Data'];
$Description = $_POST['Description'];

if (!empty($_FILES['file']['name'])) {
    $file = $uploaddir . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $file);
    mysqli_query($connect, "UPDATE aksi SET Name = '$Name', Data = '$Data', Description = '$Description', Image = '$file' WHERE idAksi = '$id_aksiya'");
} else {
    mysqli_query($connect, "UPDATE aksi SET Name = '$Name', Data = '$Data', Description = '$Description' WHERE idAksi = '$id_aksiya'");
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
