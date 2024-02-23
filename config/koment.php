<?php
$uploaddir = '../image/';
$file = $uploaddir.$_FILES['file']['name'];
session_start();
require_once 'connect.php';
$Name = $_POST['name'];
$email = $_POST['email'];
$komentariya = $_POST['komentariya'];
mysqli_query($connect, query:"INSERT INTO `komentariya` (`Name`, `email`, `komentariya`,`File`) VALUES ('$Name', '$email', '$komentariya', '$file')");
if (!empty($_POST)) {
    if ($_FILES['file'] ['name'] !=''){
        $uploadfile = $uploaddir . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>