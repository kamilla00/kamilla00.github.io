<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL); // Можно оставить для логов

$host = 'localhost';
$dbname = 'u68667'; 
$user = 'u68667';
$pass = '7528186'; 
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
?>