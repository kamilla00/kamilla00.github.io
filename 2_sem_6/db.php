<?php
$host = 'localhost';
$dbname = 'u68667'; 
$user = 'u68667';
$pass = '7528186'; 
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
?>