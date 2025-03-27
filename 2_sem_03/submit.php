<?php
// Подключаем файл с базой данных
require 'db.php'; // Подключаем подключение к базе данных

// Валидация данных формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $bio = $_POST['bio'];
    $contract_accepted = isset($_POST['contract']) ? 1 : 0;

    try {
        // Вставка данных в таблицу application
        $stmt = $pdo->prepare("INSERT INTO application (full_name, phone, email, birth_date, gender, biography, contract_accepted) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $phone, $email, $dob, $gender, $bio, $contract_accepted]);

        // Получение ID последней вставленной записи
        $application_id = $pdo->lastInsertId();

        // Вставка выбранных языков программирования
        if (isset($_POST['languages'])) {
            foreach ($_POST['languages'] as $language_name) {
                // Находим ID языка программирования
                $stmt = $pdo->prepare("SELECT id FROM programming_languages WHERE name = ?");
                $stmt->execute([$language_name]);
                $language = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($language) {
                    // Вставляем связь в таблицу application_languages
                    $stmt = $pdo->prepare("INSERT INTO application_languages (application_id, language_id) VALUES (?, ?)");
                    $stmt->execute([$application_id, $language['id']]);
                }
            }
        }

        echo "Данные успешно сохранены!";

    } catch (PDOException $e) {
        // Если ошибка, выводим сообщение об ошибке
        echo "Ошибка: " . $e->getMessage();
    }
}
?>