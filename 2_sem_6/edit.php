<?php
session_start();
require 'db.php';
if (empty($_SESSION['user_id'])) {
    header('Location: /2_sem_5/login.php'); exit;
}
$get = fn($key) => isset($_COOKIE[$key]) ? htmlspecialchars($_COOKIE[$key]) : '';

$stmt = $pdo->prepare(
    "SELECT u.id AS user_id, a.* FROM users u
     JOIN application a ON u.application_id = a.id
     WHERE u.id = :uid"
);
$stmt->execute([':uid' => $_SESSION['user_id']]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$errorForm = $data;
$errors = [];
$errorFields = [];
$success = $get('success');
if(!empty($success)){
    setcookie('success', '', -1, '/');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errorForm['name'] = $_POST['name'];
    if (empty($_POST['name'])) {
        $errors[] = "Поле ФИО обязательно для заполнения.";
        $errorFields[] = 'name';
    } elseif (!preg_match("/^[a-zA-Zа-яА-ЯёЁ]{2,}\s[a-zA-Zа-яА-ЯёЁ]{2,}\s[a-zA-Zа-яА-ЯёЁ]{2,}$/u", $_POST['name'])) {
        $errors[] = "Поле ФИО должно содержать ровно три слова (например, Иванов Иван Иванович).";
        $errorFields[] = 'name';
    }
    $errorForm['phone'] = $_POST['phone'];
    if (empty($_POST['phone'])) {
        $errors[] = "Поле Телефон обязательно для заполнения.";
        $errorFields[] = 'phone';
    } elseif (!preg_match("/^\+[0-9]{1,15}$/", $_POST['phone'])) {
        $errors[] = "Телефон должен начинаться с '+' и содержать только цифры (максимум 15 цифр).";
        $errorFields[] = 'phone';
    }
    $errorForm['email'] = $_POST['email'];
    if (empty($_POST['email'])) {
        $errors[] = "Поле E-mail обязательно для заполнения.";
        $errorFields[] = 'email';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Некорректный формат E-mail.";
        $errorFields[] = 'email';
    }
    $errorForm['dob'] = $_POST['dob'];
    if (empty($_POST['dob'])) {
        $errors[] = "Поле Дата рождения обязательно для заполнения.";
        $errorFields[] = 'dob';
    } else {
        $dob = DateTime::createFromFormat('Y-m-d', $_POST['dob']);
        if (!$dob || $dob->format('Y-m-d') !== $_POST['dob']) {
            $errors[] = "Некорректный формат даты рождения. Используйте формат ГГГГ-ММ-ДД.";
        } else {
            $today = new DateTime();
            $age = $today->diff($dob)->y;
            if ($age < 18) {
                $errors[] = "Вы должны быть старше 18 лет.";
                $errorFields[] = 'dob';
            }
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
    
    if (!empty($errors)) {
        setcookie('errors', json_encode($errors), time() + 3600, '/');
        setcookie('error_form', json_encode($errorForm), time() + 3600, '/');
        setcookie('error_fields', json_encode($errorFields), time() + 3600, '/');
        setcookie('name', $_POST['name'], time() + 3600, '/');
        setcookie('phone', $_POST['phone'], time() + 3600, '/');
        setcookie('email', $_POST['email'], time() + 3600, '/');
        setcookie('dob', $_POST['dob'], time() + 3600, '/');
        setcookie('gender', $_POST['gender'], time() + 3600, '/');
        setcookie('languages', json_encode($_POST['languages']), time() + 3600, '/');
        setcookie('bio', $_POST['bio'], time() + 3600, '/');
    
        header('Location: edit.php');
        exit();
    } else {
        $pdo->beginTransaction();
        $upd = $pdo->prepare(
            "UPDATE application SET name = :name,
             phone = :phone,
             email = :email,
             dob = :dob,
             gender = :gender,
             bio = :bio
             WHERE id = :aid"
        );
        $upd->execute([
            ':name'   => $_POST['name'],
            ':phone'  => $_POST['phone'],
            ':email'  => $_POST['email'],
            ':dob'    => $_POST['dob'],
            ':gender' => $_POST['gender'],
            ':bio'    => $_POST['bio'],
            ':aid'    => $data['id']
        ]);

        $pdo->prepare("DELETE FROM application_languages WHERE application_id = :aid")
            ->execute([':aid' => $data['id']]);
        $lnk = $pdo->prepare(
            "INSERT INTO application_languages (application_id, language_id)
             VALUES (:aid, (
               SELECT id FROM languages WHERE name = :lang
             ))"
        );
        foreach ($_POST['languages'] as $lang) {
            $lnk->execute([':aid' => $data['id'], ':lang' => $lang]);
        }
        $pdo->commit();
        setcookie('success', 'success', time()+3600, '/');
        header('Location: edit.php?success=1');
        exit;
    }
} else {
    $errors = isset($_COOKIE['errors']) ? json_decode($_COOKIE['errors'], true) : [];
    $errorFields = isset($_COOKIE['error_fields'])
        ? json_decode($_COOKIE['error_fields'], true)
        : [];
    $errorForm = isset($_COOKIE['error_form']) ? json_decode($_COOKIE['error_form'], true) : $data;
    $get = function($key) {
        return isset($_COOKIE[$key])
            ? htmlspecialchars($_COOKIE[$key])
            : '';
    };
    $getArray = function($key) {
        return isset($_COOKIE[$key])
            ? json_decode($_COOKIE[$key], true)
            : [];
    };

    setcookie('errors', '', -1, '/');
    setcookie('error_fields', '', -1, '/');
    setcookie('error_form', '', -1, '/');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать заявку</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: #6A1B9A;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .form-container {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            transition: transform 0.3s ease;
        }
        h1 {
            color: #4A148C;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.2em;
            font-weight: 600;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        label {
            color: #4A148C;
            font-weight: 500;
            font-size: 0.95em;
        }
        input, select, textarea {
            padding: 12px;
            border: 1px solid #D1C4E9;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #6A1B9A;
            box-shadow: 0 0 0 2px rgba(106, 27, 154, 0.1);
        }
        input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: #6A1B9A;
        }
        .radio-group {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        select[multiple] {
            height: 120px;
            padding: 8px;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        button {
            background: #6A1B9A;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 1rem;
        }
        button:hover {
            background: #4A148C;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
        }
        .success-message {
            color: green;
            font-size: 0.9em;
        }
        .error {
            border-color: #E53935 !important;
        }
        @media (max-width: 480px) {
            .form-container {
                padding: 1.5rem;
                width: 95%;
            }
            h1 {
                font-size: 1.8em;
            }
        }
        body {
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
        }
    </style>
    
</head>
<body>
<div class="form-container">
    <h1>Редактирование заявки</h1>
    <?php if (!empty($errors)): ?>
        <?php foreach($errors as $e): ?>
            <p class="error-message"><?=htmlspecialchars($e)?></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        
            <p class='success-message'>Данные успешно обновлены</p>
  
    <?php endif; ?>
    <form action="edit.php" method="post">
    <label>ФИО:</label>
        <input type="text" name="name" value="<?=htmlspecialchars($errorForm['name'])?>" class="<?= in_array('name', $errorFields) ? 'error' : '' ?>">

    <label>Телефон:</label>
        <input type="text" name="phone" value="<?=htmlspecialchars($errorForm['phone']) ?>" class="<?= in_array('phone', $errorFields) ? 'error' : '' ?>">
    

    <label>Email:</label>
        <input type="email" name="email" value="<?=htmlspecialchars($errorForm['email']) ?> " class="<?= in_array('email', $errorFields) ? 'error' : '' ?>">
    

    <label>Дата рождения:</label>
        <input type="date" name="dob" value="<?=htmlspecialchars($errorForm['dob']) ?>" class="<?= in_array('dob', $errorFields) ? 'error' : '' ?>">
    
        <label>Пол:</label>
        <div class="radio-group<?=in_array('gender',$errorFields)?' error':''?>">
        <label><input type="radio" name="gender" value="male" <?= $data['gender'] === 'male' ? 'checked' : '' ?>> Мужской</label>
        <label><input type="radio" name="gender" value="female" <?= $data['gender'] === 'female' ? 'checked' : '' ?>> Женский</label>
      </div>
        <div class="form-group">
            <label for="languages">Языки программирования:</label>
            <select id="languages" name="languages[]" multiple class="<?=in_array('languages',$errorFields)?'error':''?>">
            <?php
            $stmt = $pdo->query("SELECT name FROM languages");
            $userLangs = $pdo->prepare("SELECT l.name FROM application_languages al JOIN languages l ON al.language_id = l.id WHERE al.application_id = :aid");
            $userLangs->execute([':aid' => $data['id']]);
            $selectedLangs = array_column($userLangs->fetchAll(PDO::FETCH_ASSOC), 'name');
        
            foreach ($stmt as $row) {
                $checked = in_array($row['name'], $selectedLangs) ? 'selected' : '';
                echo "<option
                            value='{$row['name']}' {$checked}> {$row['name']}
                        </option>";
            }
        ?>
            </select>
        </div>
        <div class="form-group">
            <label for="bio">Биография:</label>
            <textarea id="bio" name="bio" class="<?=in_array('bio',$errorFields)?'error':''?>"><?=$get('bio')?></textarea>
        </div>
        <button type="submit">Сохранить изменения</button>
        <p style="text-align:center; margin-top:10px;"><a href="logout.php" style="color:white; background: pink; padding: 5px 40px; border-radius: 5px;">Выйти</a></p>
    </form>
</div>
</body>
</html>
