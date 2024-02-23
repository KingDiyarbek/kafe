<?
session_start();
unset ($_SESSION['user']);
header('Location: ../admin.php');
unset ($_SESSION['admin']);
header('Location: ../admin.php');
unset ($_SESSION['operator']);
header('Location: ../admin.php');
?>