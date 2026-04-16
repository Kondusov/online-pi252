<?php
session_start();
require_once 'db.php';

// Получаем все товары
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Магазин обуви</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>👟 Магазин обуви</h1>
        <div>
            <?php if(isset($_SESSION['user_id'])): ?>
                Привет, <?= htmlspecialchars($_SESSION['user_name']) ?> 
                (<?= $_SESSION['role'] ?>)
                <a href="logout.php" class="btn">Выйти</a>
                <?php if($_SESSION['role'] == 'admin'): ?>
                    <a href="admin.php" class="btn btn-primary">Админ-панель</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="login.php" class="btn">Вход</a>
                <a href="register.php" class="btn">Регистрация</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="product-list">
        <?php foreach($products as $product): ?>
            <div class="product-card">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p>Цена: <?= number_format($product['price'], 2) ?> ₽</p>
                <p>Размеры: <?= htmlspecialchars($product['size']) ?></p>
                <p><?= htmlspecialchars($product['description']) ?></p>
                
                <?php if(isset($_SESSION['user_id']) && $_SESSION['role'] == 'user'): ?>
                    <form action="order.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                        <input type="hidden" name="price" value="<?= $product['price'] ?>">
                        <button type="submit" class="btn btn-primary">Заказать</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>