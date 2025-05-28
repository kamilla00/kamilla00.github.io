<?php
session_start();
session_unset();
session_destroy();
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
header('Location: /2_sem_7/login.php');
exit;
?>
