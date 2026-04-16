<?php
session_start();
require_once 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Добавление товара
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $desc = $_POST['description'];
    
    $stmt = $pdo->prepare("INSERT INTO products (name, price, size, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $price, $size, $desc]);
    $success = "Товар добавлен";
}

// Удаление товара
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $success = "Товар удален";
}

// Получаем все товары
$products = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();
// Получаем заказы
$orders = $pdo->query("SELECT * FROM orders ORDER BY order_date DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Админ-панель</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
    <header>
        <h1>Админ-панель</h1>
        <a href="index.php" class="btn">На сайт</a>
        <a href="logout.php" class="btn">Выйти</a>
    </header>
    
    <?php if(isset($success)) echo "<div class='success'>$success</div>"; ?>
    
    <h2>➕ Добавить товар</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Название" required>
        <input type="number" step="0.01" name="price" placeholder="Цена" required>
        <input type="text" name="size" placeholder="Размеры (например, 40-44)" required>
        <textarea name="description" placeholder="Описание"></textarea>
        <button type="submit" name="add_product" class="btn btn-primary">Добавить</button>
    </form>
    
    <h2>📦 Товары</h2>
    <table border="1" cellpadding="10" style="width:100%; margin-top:20px;">
        <tr><th>ID</th><th>Название</th><th>Цена</th><th>Размеры</th><th>Действие</th></tr>
        <?php foreach($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= number_format($p['price'], 2) ?> ₽</td>
            <td><?= htmlspecialchars($p['size']) ?></td>
            <td><a href="?delete=<?= $p['id'] ?>" class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <h2>📋 Заказы пользователей</h2>
    <table border="1" cellpadding="10" style="width:100%; margin-top:20px;">
        <tr><th>ID</th><th>Email</th><th>Товары</th><th>Сумма</th><th>Дата</th></tr>
        <?php foreach($orders as $o): ?>
        <tr>
            <td><?= $o['id'] ?></td>
            <td><?= htmlspecialchars($o['user_email']) ?></td>
            <td><?= htmlspecialchars($o['products_text']) ?></td>
            <td><?= number_format($o['total'], 2) ?> ₽</td>
            <td><?= $o['order_date'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>