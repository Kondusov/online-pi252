<?php
session_start();
require_once 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    // var_dump(password_verify($password, $user['password']));
    // die();
    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Неверный email или пароль";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Вход</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
    <h2>Авторизация</h2>
    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
    <p>Нет аккаунта? <a href="register.php">Регистрация</a></p>
</div>
</body>
</html>