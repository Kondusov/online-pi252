<?php
session_start();
require_once 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);
        $_SESSION['message'] = "Регистрация успешна! Войдите.";
        header("Location: login.php");
        exit();
    } catch(PDOException $e) {
        $error = "Email уже существует";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Регистрация</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
    <h2>Регистрация</h2>
    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Имя" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>
    <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
</div>
</body>
</html>