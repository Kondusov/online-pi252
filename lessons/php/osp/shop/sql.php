<?php
/**
 * Установочный файл для магазина обуви
 * Запустите этот файл один раз для создания базы данных и таблиц
 * 
 * ИСПОЛЬЗОВАНИЕ:
 * 1. Отредактируйте настройки подключения ниже (хост, пользователь, пароль)
 * 2. Запустите файл в браузере: http://localhost/shop/install.php
 * 3. После успешной установки УДАЛИТЕ или ПЕРЕИМЕНУЙТЕ этот файл!
 */

// ========== НАСТРОЙКИ ПОДКЛЮЧЕНИЯ ==========
$host = 'localhost';      // Хост MySQL
$dbname = 'shoe_shop';    // Имя базы данных (будет создана автоматически)
$user = 'root';           // Пользователь MySQL
$pass = '';               // Пароль MySQL (для XAMPP/WAMP обычно пустой)
// ===========================================

// Включаем отображение ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Установка магазина обуви</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; background: #f4f4f4; }
        .container { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        .success { color: green; background: #d4edda; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .error { color: red; background: #f8d7da; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .info { color: blue; background: #d1ecf1; padding: 10px; border-radius: 5px; margin: 10px 0; }
        code { background: #f4f4f4; padding: 2px 5px; border-radius: 3px; }
        hr { margin: 20px 0; }
    </style>
</head>
<body>
<div class='container'>
    <h1>📦 Установка интернет-магазина обуви</h1>
    <hr>";

try {
    // Шаг 1: Подключаемся без базы данных
    echo "<p>🔌 Подключение к MySQL серверу...</p>";
    $pdo = new PDO("mysql:host=$host;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<div class='success'>✓ Подключение к MySQL успешно</div>";
    
    // Шаг 2: Создаем базу данных, если она не существует
    echo "<p>🗄️ Создание базы данных <code>$dbname</code>...</p>";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "<div class='success'>✓ База данных <code>$dbname</code> создана или уже существует</div>";
    
    // Шаг 3: Переключаемся на нашу базу данных
    $pdo->exec("USE `$dbname`");
    echo "<p>📋 Создание таблиц...</p>";
    
    // ========== SQL ЗАПРОСЫ ==========
    
    // Таблица пользователей
    $sql_users = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('user', 'admin') DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $pdo->exec($sql_users);
    echo "<div class='success'>✓ Таблица <code>users</code> создана</div>";
    
    // Таблица товаров
    $sql_products = "
    CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(200) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        size VARCHAR(10),
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $pdo->exec($sql_products);
    echo "<div class='success'>✓ Таблица <code>products</code> создана</div>";
    
    // Таблица заказов
    $sql_orders = "
    CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        user_email VARCHAR(100) NOT NULL,
        products_text TEXT NOT NULL,
        total DECIMAL(10,2) NOT NULL,
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $pdo->exec($sql_orders);
    echo "<div class='success'>✓ Таблица <code>orders</code> создана</div>";
    
    // ========== ЗАПОЛНЕНИЕ НАЧАЛЬНЫМИ ДАННЫМИ ==========
    echo "<p>📝 Заполнение начальными данными...</p>";
    
    // Проверяем, есть ли уже админ
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = 'admin@shop.com'");
    $stmt->execute();
    $adminExists = $stmt->fetchColumn();
    
    if (!$adminExists) {
        // Пароль: admin123
        $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
        $sql_insert_admin = "INSERT INTO users (name, email, password, role) VALUES 
            ('Admin', 'admin@shop.com', '$adminPassword', 'admin')";
        $pdo->exec($sql_insert_admin);
        echo "<div class='success'>✓ Администратор создан (email: admin@shop.com, пароль: admin123)</div>";
    } else {
        echo "<div class='info'>ℹ Администратор уже существует, пропускаем</div>";
    }
    
    // Проверяем, есть ли уже товары
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM products");
    $stmt->execute();
    $productsCount = $stmt->fetchColumn();
    
    if ($productsCount == 0) {
        $sql_insert_products = "
        INSERT INTO products (name, price, size, description) VALUES
        ('Кроссовки Nike Air Max', 4500.00, '40-44', 'Легкие и дышащие, идеальны для бега'),
        ('Ботинки Timberland', 8900.00, '41-45', 'Водоотталкивающие, для активного отдыха'),
        ('Туфли классические', 3200.00, '39-43', 'Натуральная кожа, удобная колодка'),
        ('Кеды Converse', 2800.00, '36-42', 'Классические кеды, хлопок'),
        ('Сандалии Merrell', 3500.00, '37-41', 'Для лета и треккинга'),
        ('Домашние тапочки', 1200.00, '38-43', 'Мягкие и теплые');
        ";
        $pdo->exec($sql_insert_products);
        echo "<div class='success'>✓ Добавлено 6 товаров</div>";
    } else {
        echo "<div class='info'>ℹ Товары уже существуют (найдено $productsCount шт.), пропускаем</div>";
    }
    
    // ========== ВСЕ ГОТОВО ==========
    echo "<hr>";
    echo "<div class='success' style='font-size: 18px; padding: 15px;'>
            <strong>✅ УСТАНОВКА ЗАВЕРШЕНА УСПЕШНО!</strong><br><br>
            📍 База данных: <code>$dbname</code><br>
            👤 Администратор: <code>admin@shop.com</code> / <code>admin123</code><br>
            📂 Таблицы: users, products, orders<br>
            🛍️ Товаров в каталоге: " . ($productsCount > 0 ? $productsCount : 6) . "
          </div>";
    
    echo "<div class='info'>
            <strong>⚠️ ВАЖНО:</strong><br>
            1. <strong>УДАЛИТЕ файл <code>install.php</code></strong> с сервера для безопасности!<br>
            2. Перейдите на <a href='index.php' style='color: blue;'>главную страницу магазина</a><br>
            3. Если файл index.php отсутствует, создайте его из предоставленного кода.
          </div>";
    
} catch(PDOException $e) {
    echo "<div class='error'>
            <strong>❌ ОШИБКА УСТАНОВКИ:</strong><br>
            " . $e->getMessage() . "<br><br>
            <strong>Возможные решения:</strong><br>
            - Проверьте настройки подключения в файле (хост, логин, пароль)<br>
            - Убедитесь, что MySQL сервер запущен<br>
            - Для XAMPP: user=root, pass='' (пустой)<br>
            - Для OpenServer: user=root, pass='' (пустой)<br>
            - Для MAMP: user=root, pass='root'
          </div>";
}

echo "</div></body></html>";
?>