<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "db_data_pembicara";
$port = 3306;

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");

function e($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}