<?php
session_start();
require 'db.php';

$errors = [];
$errorFields = [];

// Валидация полей
if (empty($_POST['name'])) {
    $errors[] = "Поле ФИО обязательно для заполнения.";
    $errorFields[] = 'name';
} elseif (!preg_match("/^[\p{L}]{2,}\s[\p{L}]{2,}\s[\p{L}]{2,}$/u", $_POST['name'])) {
    $errors[] = "Поле ФИО должно содержать ровно три слова (Иванов Иван Иванович).";
    $errorFields[] = 'name';
}

if (empty($_POST['phone'])) {
    $errors[] = "Поле Телефон обязательно для заполнения.";
    $errorFields[] = 'phone';
} elseif (!preg_match("/^\+[0-9]{1,15}$/", $_POST['phone'])) {
    $errors[] = "Телефон должен начинаться с '+' и содержать только цифры.";
    $errorFields[] = 'phone';
}

if (empty($_POST['email'])) {
    $errors[] = "Поле E-mail обязательно для заполнения.";
    $errorFields[] = 'email';
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Некорректный формат E-mail.";
    $errorFields[] = 'email';
}

if (empty($_POST['dob'])) {
    $errors[] = "Поле Дата рождения обязательно для заполнения.";
    $errorFields[] = 'dob';
} else {
    $dob = DateTime::createFromFormat('Y-m-d', $_POST['dob']);
    if (!$dob || $dob->format('Y-m-d') !== $_POST['dob']) {
        $errors[] = "Некорректный формат даты.";
        $errorFields[] = 'dob';
    } elseif ((new DateTime())->diff($dob)->y < 18) {
        $errors[] = "Вы должны быть старше 18 лет.";
        $errorFields[] = 'dob';
    }
}

if (empty($_POST['gender'])) {
    $errors[] = "Поле Пол обязательно для заполнения.";
    $errorFields[] = 'gender';
}

if (empty($_POST['languages'])) {
    $errors[] = "Выберите хотя бы один язык программирования.";
    $errorFields[] = 'languages';
}

if (!isset($_POST['contract'])) {
    $errors[] = "Необходимо ознакомиться с контрактом.";
    $errorFields[] = 'contract';
}


if ($errors) {
    setcookie('errors', json_encode($errors), time()+3600, '/');
    setcookie('error_fields', json_encode($errorFields), time()+3600, '/');

    foreach (['name','phone','email','dob','gender','bio'] as $field) {
        setcookie($field, $_POST[$field] ?? '', time()+3600, '/');
    }
    setcookie('languages', json_encode($_POST['languages'] ?? []), time()+3600, '/');
    setcookie('contract', $_POST['contract'] ?? '', time()+3600, '/');
    header('Location: index.php'); exit;
}


try {
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("INSERT INTO application (name, phone, email, dob, gender, bio)
        VALUES (:name,:phone,:email,:dob,:gender,:bio)");
    $stmt->execute([
        ':name'   => $_POST['name'],
        ':phone'  => $_POST['phone'],
        ':email'  => $_POST['email'],
        ':dob'    => $_POST['dob'],
        ':gender' => $_POST['gender'],
        ':bio'    => $_POST['bio'] ?? ''
    ]);
    $appId = $pdo->lastInsertId();
   
    $link = $pdo->prepare("INSERT INTO application_languages (application_id, language_id)
        VALUES (:aid,(SELECT id FROM languages WHERE name=:lang))");
    foreach ($_POST['languages'] as $lang) {
        $link->execute([':aid'=>$appId, ':lang'=>$lang]);
    }
    
    $username = 'user_' . bin2hex(random_bytes(4));
    $password = bin2hex(random_bytes(4));
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $u = $pdo->prepare("INSERT INTO users (username, password_hash, application_id)
        VALUES (:u,:h,:aid)");
    $u->execute([':u'=>$username, ':h'=>$hash, ':aid'=>$appId]);
    $pdo->commit();


} catch (Exception $e) {
    $pdo->rollBack(); die("Ошибка: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ru">
    
    <head><meta charset="utf-8"><title>Сохранение заявки</title>
    <style>body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        label {
            display: block;
            margin-bottom: 10px;
        }
        
        input[type="text"], input[type="tel"], input[type="email"], input[type="date"], select, textarea {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        input[type="radio"] {
            
            margin-right: 10px;
        }
        
        input[type="checkbox"] {
            margin-right: 10px;
        }
        
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        
        .radio-group  {
            margin-bottom: 20px;
        }
        .radio-group label {
          display: inline;}
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .checkbox-group label {
            margin-left: 10px;
            padding-top: 10px;
        }</style>
</head>
    <body style="">
    <h2 style='text-align:center;'>Заявка успешно отправленна!</h2>
        <p style='text-align:center;'>
            Ваш логин: <strong><?=$username?></strong><br>
           Ваш пароль: <strong><?=$password?></strong></p>
       <p style='text-align:center;'><a href="login.php\" style='color:black'>Войти для редактирования</a></p>
    </body>
</html>