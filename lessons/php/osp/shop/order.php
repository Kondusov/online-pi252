<?php
session_start();
require_once 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_name'])) {
    // Сохраняем данные заказа в сессию для подтверждения
    $_SESSION['pending_order'] = [
        'product_name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'product_id' => $_POST['product_id']
    ];
    header("Location: order.php?confirm=1");
    exit();
}

// Подтверждение заказа
if(isset($_GET['confirm']) && isset($_SESSION['pending_order'])) {
    $order = $_SESSION['pending_order'];
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];
    $products_text = $order['product_name'] . " - " . number_format($order['price'], 2) . " ₽";
    $total = $order['price'];
    
    // Сохраняем в БД
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, user_email, products_text, total) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $user_email, $products_text, $total]);
    
    // Отправляем email
    $to = $user_email;
    $subject = "Подтверждение заказа в магазине обуви";
    $message = "Здравствуйте, {$_SESSION['user_name']}!\n\nВаш заказ подтвержден:\n";
    $message .= "Товар: {$order['product_name']}\n";
    $message .= "Цена: {$order['price']} ₽\n";
    $message .= "Спасибо за покупку!";
    $headers = "From: no-reply@shoe-shop.com";
    
    mail($to, $subject, $message, $headers);
    
    // Показываем поздравление
    $success = true;
    $order_details = $order;
    unset($_SESSION['pending_order']);
}
?>
<!DOCTYPE html>
<html>
<head><title>Оформление заказа</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
    <?php if(isset($success) && $success): ?>
        <div class="success">
            <h2>🎉 Поздравляем! Заказ оформлен 🎉</h2>
            <p>Ваш заказ:</p>
            <ul>
                <li><strong>Товар:</strong> <?= htmlspecialchars($order_details['product_name']) ?></li>
                <li><strong>Цена:</strong> <?= number_format($order_details['price'], 2) ?> ₽</li>
            </ul>
            <p>Подтверждение отправлено на email: <?= htmlspecialchars($_SESSION['user_email']) ?></p>
            <a href="index.php" class="btn btn-primary">Вернуться в магазин</a>
        </div>
    <?php elseif(isset($_GET['confirm']) && isset($_SESSION['pending_order'])): ?>
        <h2>Подтверждение заказа</h2>
        <p>Вы заказываете:</p>
        <ul>
            <li><?= htmlspecialchars($_SESSION['pending_order']['product_name']) ?></li>
            <li>Цена: <?= number_format($_SESSION['pending_order']['price'], 2) ?> ₽</li>
        </ul>
        <form method="POST" action="order.php">
            <input type="hidden" name="final_confirm" value="1">
            <button type="submit" class="btn btn-success">Подтвердить заказ</button>
            <a href="index.php" class="btn">Отмена</a>
        </form>
        
        <?php 
        // Финальное подтверждение
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['final_confirm'])):
            header("Location: order.php?final=1");
            exit();
        endif;
        ?>
    <?php elseif(isset($_GET['final'])): 
        // Эмуляция финального шага
        header("Location: order.php?confirm=1");
        exit();
    else: ?>
        <div class="error">Нет выбранного товара</div>
        <a href="index.php" class="btn">В каталог</a>
    <?php endif; ?>
</div>
</body>
</html>