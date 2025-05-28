<?php
session_start();
require 'db.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE username = :user");
    $stmt->execute([':user' => $_POST['username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($_POST['password'], $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: /2_sem_7/edit.php'); exit;
    } else {
        $msg = 'Неверный логин или пароль.';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доступ к редактированию</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background:#6A1B9A; min-height:100vh; display:flex; align-items:center; justify-content:center; padding:20px; }
        .form-container { background:white; padding:2.5rem; border-radius:15px; box-shadow:0 8px 32px rgba(0,0,0,0.1); width:100%; max-width:400px; }
        h1 { color:#4A148C; text-align:center; margin-bottom:2rem; font-size:2em; font-weight:600; }
        form { display:flex; flex-direction:column; gap:1.2rem; }
        label { color:#4A148C; font-weight:500; font-size:0.95em; }
        input { padding:12px; border:1px solid #D1C4E9; border-radius:8px; font-size:1em; transition:border-color 0.3s ease; }
        input:focus { outline:none; border-color:#6A1B9A; box-shadow:0 0 0 2px rgba(106,27,154,0.1); }
        .error-message { color:red; text-align:center; font-size:0.9em; }
        input[type="submit"] { background:#6A1B9A; color:white; padding:14px; border:none; border-radius:8px; font-size:1.1em; cursor:pointer; transition:background 0.3s ease; }
        input[type="submit"]:hover { background:#4A148C; }
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
        <h1>Вход для редактирования</h1>
        <?php if ($msg): ?>
            <p class="error-message"><?=htmlspecialchars($msg)?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <label for="username">Логин</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Продолжить">
        </form>
        <form style="gap: 0; justify-items: center; margin-top: 10px;" action="/2_sem_7/index.php" method="get"> 
            <label style="margin: 0; text-align:center;">Еще не зарегистрированы?</label>
        <input style="margin:0;"type="submit" value="Зарегистрироваться"/>
        </form>
    </div>
</body>
</html>
