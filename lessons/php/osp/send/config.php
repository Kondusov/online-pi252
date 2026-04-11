<?php
// 1. Параметры подключения
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "age18";
// 2. Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}