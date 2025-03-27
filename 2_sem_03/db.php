<?php
$host = 'kubsu-dev.ru'; // Обычно localhost, если база данных на том же сервере
$dbname = 'u68667'; // Имя базы данных (замени на твой логин)
$username = 'u68667'; // Логин (так же, как твой логин для сервера)
$password = '7528186'; // Пароль (тот, который ты используешь для входа в MySQL)

try {
    // Подключение к базе данных
    $pdo = new PDO('mysql:host=kubsu-dev.ru;port=58528;dbname=u68667', 'u68667', '7528186');
    // Устанавливаем атрибуты для обработки ошибок
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
?>