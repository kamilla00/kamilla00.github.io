<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма</title>
    <style>
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
        <h2>Форма</h2>
        <?php
        // Отображение ошибок, если они есть
        if (isset($_COOKIE['errors'])) {
            $errors = json_decode($_COOKIE['errors'], true);
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
            // Удаляем Cookie с ошибками после отображения
            setcookie('errors', '', -1, '/');
            setcookie('fio', '',-1, '/');
            setcookie('phone', '', -1, '/');
            setcookie('email', '', -1, '/');
            setcookie('dob','', -1, '/');
            setcookie('gender','', -1, '/');
            setcookie('languages', '', -1, '/');
            setcookie('bio', '', -1, '/');
        }
        else {
            if (isset($_COOKIE['fio']))echo '<p style="color:green;">Форма заполнена корректно!</p>';
        }
        ?>
        <form action="form.php" method="POST">
        <!-- Поле ФИО -->
            <label for="fio">ФИО:</label>
            <input type="text" name="fio" id="fio" value="<?php echo isset($_COOKIE['fio']) ? htmlspecialchars($_COOKIE['fio']) : ''; ?>">

            <!-- Поле Телефон -->
            <label for="phone">Телефон:</label>
            <input type="tel" name="phone" id="phone" value="<?php echo isset($_COOKIE['phone']) ? htmlspecialchars($_COOKIE['phone']) : ''; ?>">

            <!-- Поле Email -->
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : ''; ?>">

            <!-- Поле Дата рождения -->
            <label for="dob">Дата рождения:</label>
            <input type="date" name="dob" id="dob" value="<?php echo isset($_COOKIE['dob']) ? htmlspecialchars($_COOKIE['dob']) : ''; ?>">

            <!-- Поле Пол -->
            <label>Пол:</label>
            <div class="radio-group">
                <input type="radio" id="male" name="gender" value="male" <?php echo (isset($_COOKIE['gender']) && $_COOKIE['gender'] === 'male') ? 'checked' : ''; ?>  >
                <label for="male">Мужской</label>
                <input type="radio" id="female" name="gender" value="female" <?php echo (isset($_COOKIE['gender']) && $_COOKIE['gender'] === 'female') ? 'checked' : ''; ?> >
                <label for="female">Женский</label>
            </div>


            <!-- Поле Любимый язык программирования -->
            <label for="languages">Любимый язык программирования:</label>
            <select id="languages" name="languages[]" multiple="multiple" >
                <?php
                $selectedLanguages = isset($_COOKIE['languages']) ? json_decode($_COOKIE['languages'], true) : [];
                $languages = ['Pascal', 'C', 'C++', 'JavaScript', 'PHP', 'Python', 'Java', 'Haskell', 'Clojure', 'Prolog', 'Scala', 'Go'];
                foreach ($languages as $language) {
                    $selected = in_array($language, $selectedLanguages) ? 'selected' : '';
                    echo "<option value='$language' $selected>$language</option>";
                }
                ?>
            </select>

            <!-- Поле Биография -->
            <label for="bio">Биография:</label>
            <textarea name="bio" id="bio" rows="5" cols="40"><?php echo isset($_COOKIE['bio']) ? htmlspecialchars($_COOKIE['bio']) : ''; ?></textarea>

            <!-- Чекбокс "С контрактом ознакомлен" -->
            <div class="checkbox-group">
            <label for="contract">С контрактом ознакомлен:</label>

                <input type="checkbox" name="contract" id="contract" required>
            </div>

            <!-- Кнопка отправки формы -->
            <input type="submit" value="Сохранить">
        </form>
    </div>
</body>
</html> 