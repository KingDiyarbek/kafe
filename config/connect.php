<?php

$hostName = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'dimoa';

$connect = mysqli_connect($hostName,$username,$password,$database);


if ($connect == false)
{
    echo "Ошибка подключения";
}