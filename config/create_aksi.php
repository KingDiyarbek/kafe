<?php
$uploaddir = '../image/';
$file = $uploaddir.$_FILES['file']['name'];
session_start();
require_once 'connect.php';
$Name = $_POST['Name'];
$Date = $_POST['Date'];
$Description = $_POST['Description'];
mysqli_query($connect, query:"INSERT INTO `aksi` (`Name`, `Data`, `Description`, `Image`) VALUES ('$Name', '$Date', '$Description', '$file')");
if (!empty($_POST)) {
    if ($_FILES['file'] ['name'] !=''){
        $uploadfile = $uploaddir . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>