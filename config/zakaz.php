<?php
session_start();
require_once 'connect.php';

// Получаем данные из POST-запроса
$NameProduct = json_encode($_POST['products']); // Преобразуем массив в строку JSON
$Itogo = $_POST['total']; // Получаем общую сумму заказа из скрытого поля
$Name = $_POST['fullName'];
$Adres = $_POST['address'];

// Выполняем запрос к базе данных для добавления заказа
$query = "INSERT INTO `zakaz` (`idZakaz`, `Name`, `Adres`, `NameProduct`, `Itogo`) VALUES (NULL, '$Name', '$Adres', '$NameProduct', '$Itogo')";

// Выполняем запрос
$result = mysqli_query($connect, $query);
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>