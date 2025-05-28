<?php 
session_start();

require 'db.php';

$msg = ''; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        function getJsonInput(): ?array {
        $ct = $_SERVER['CONTENT_TYPE'] ?? '';
        if (stripos($ct, 'application/json') === 0) {
            $raw = file_get_contents('php://input');
            $data = json_decode($raw, true);    
            return is_array($data) ? $data : null;
        }
        return null;
    }

    $json = getJsonInput();    
     $isAJAX = $json !== null;    
      $input = $json ?? $_POST; 
        $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE username = :user");
    $stmt->execute([':user' => $input['username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($input['password'], $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        setcookie("username", $input['username'], time() + 3600, '/');       
          header('Location: /drupal/edit.php'); 
        exit;
    } else {
        $msg = 'Неверный логин или пароль.';
                if ($isAJAX) {
            echo json_encode([
                'success' => false,
                'error' => $msg
            ]);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel='stylesheet' href='login.css'>
    <script defer src="/drupal/login.js"></script>
</head>
<body>
  <div class="page-container">
    <form class="login-form" action="login.php" method="post">
      <h1 class="form-title">Sigh in</h1>
      <?php if ($msg): ?>
        <div class="error-message"><?= htmlspecialchars($msg) ?></div>
      <?php endif; ?>
      <div class="form-group">
        <label for="username" class="form-label">Login:</label>
        <input type="text" id="username" name="username" required class="form-input">
      </div>
      <div class="form-group">
        <label for="password" class="form-label">Password:</label>
        <input type="password" id="password" name="password" required class="form-input">
      </div>
      <div class="form-actions">
        <input type="submit" value="Войти" class="buttons submit-button">
      </div>
    </form>

    <form class="register-form" style="margin-top: -50px; z-index: -5;" action="/drupal/index.php" method="get">
      <div class="form-actions">
        <input type="submit" value="Регистрация" class="buttons register-button">
      </div>
    </form>
  </div>
</body>

</html>
