<?php

session_start();


$errors = isset($_COOKIE['errors']) ? json_decode($_COOKIE['errors'], true) : [];
$errorFields = isset($_COOKIE['error_fields']) ? json_decode($_COOKIE['error_fields'], true) : [];


$get = fn($key) => isset($_COOKIE[$key]) ? htmlspecialchars($_COOKIE[$key]) : '';
$getArray = fn($key) => isset($_COOKIE[$key]) ? json_decode($_COOKIE[$key], true) : [];


setcookie('errors',     '', time() - 3600, '/');
setcookie('error_fields','', time() - 3600, '/');
setcookie('name',       '', time() - 3600, '/');
setcookie('phone',      '', time() - 3600, '/');
setcookie('email',      '', time() - 3600, '/');
setcookie('dob',        '', time() - 3600, '/');
setcookie('gender',     '', time() - 3600, '/');
setcookie('languages',  '', time() - 3600, '/');
setcookie('bio',        '', time() - 3600, '/');
setcookie('contract',   '', time() - 3600, '/');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web task 5</title>
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
            margin-top: 0;
        }
        button:hover {
            background: #4A148C;
        }
        .error-message {
            color: red;
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
            margin-left: 20px;
            align-items: center;
            flex-direction: row;
            gap: 0;
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
        <h1>Форма регистрации</h1>

        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $err): ?>
                <p class="error-message"><?= htmlspecialchars($err) ?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <form action="form.php" method="post">
            <div class="form-group">
                <label for="name">ФИО:</label>
                <input
                    type="text" id="name" name="name"
                    placeholder="Иванов Иван Иванович"
                    value="<?= $get('name') ?>"
                    class="<?= in_array('name', $errorFields) ? 'error' : '' ?>"
                >
            </div>

            <div class="form-group">
                <label for="phone">Телефон:</label>
                <input
                    type="tel" id="phone" name="phone"
                    placeholder="+79991234567"
                    value="<?= $get('phone') ?>"
                    class="<?= in_array('phone', $errorFields) ? 'error' : '' ?>"
                >
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input
                    type="email" id="email" name="email"
                    placeholder="example@mail.com"
                    value="<?= $get('email') ?>"
                    class="<?= in_array('email', $errorFields) ? 'error' : '' ?>"
                >
            </div>

            <div class="form-group">
                <label for="dob">Дата рождения:</label>
                <input
                    type="date" id="dob" name="dob"
                    value="<?= $get('dob') ?>"
                    class="<?= in_array('dob', $errorFields) ? 'error' : '' ?>"
                >
            </div>

            <div class="form-group">
                <label>Пол:</label>
                <div class="radio-group <?= in_array('gender', $errorFields) ? 'error' : '' ?>">
                    <label><input type="radio" name="gender" value="male" <?= $get('gender')==='male'? 'checked':'' ?>> Мужской</label>
                    <label><input type="radio" name="gender" value="female" <?= $get('gender')==='female'? 'checked':'' ?>> Женский</label>
                </div>
            </div>

            <div class="form-group">
                <label for="languages">Языки программирования:</label>
                <select
                    id="languages" name="languages[]"
                    multiple
                    class="<?= in_array('languages', $errorFields) ? 'error' : '' ?>"
                >
                    <?php
                        $chosen = $getArray('languages');
                        $all = ['Pascal','C','C++','JavaScript','PHP','Python','Java','Haskell','Clojure','Prolog','Scala','Go'];
                        foreach ($all as $lang):
                    ?>
                        <option value="<?= $lang ?>" <?= in_array($lang, $chosen)? 'selected':''?>>
                            <?= $lang ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="bio">Биография:</label>
                <textarea
                    id="bio" name="bio"
                    placeholder="Расскажите о себе..."
                    class="<?= in_array('bio', $errorFields) ? 'error' : '' ?>"
                ><?= $get('bio') ?></textarea>
            </div>

            <div class="checkbox-group">
                <input
                    type="checkbox" id="contract" name="contract"
                    <?= $get('contract')==='on'? 'checked':'' ?>
                >
                <label for="contract">С контрактом ознакомлен(а)</label>
            </div>

            <button type="submit">Зарегистрироваться</button>
        </form>
        <form style="gap: 0; justify-items: center; margin-top: 10px;" action="login.php" method="get"> 
            <label style="margin: 0; text-align:center;">Уже зарегистрированы?</label>
        <button style="background: green; margin:0;"type="submit">Войти</button>
        </form>
        </div>
</body>
</html>
