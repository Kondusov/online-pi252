<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Получение данных из формы</title>
</head>
<body>
    <form action="send.php" method="POST">
        <input name="user_name" type="text" id="user_name" required placeholder="Введите имя">
        <input value='18' min='1' max='125' name="user_age" type="number" id="user_age" placeholder="Введите ваш возраст">
        <input name="user_pass" type="password" id="user_pass" required placeholder="Задайте пароль">
        <input type="submit">
    </form>
    <div id="result_block"></div>

<?php
require_once('config.php');
// 2. Выполнение запроса
$result = $conn->query("SELECT id, name, age FROM users");

// 3. Вывод данных
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . ". Имя: " . $row["name"] . " - Возраст: " . $row["age"] . "<br>";
    }
} else {
    echo "0 результатов";
}
$conn->close();
?>
<!-- <script>
    let user_form = document.querySelector('form');
    let result_block = document.getElementById('result_block');
    user_form.addEventListener('submit', (event)=>{
        event.preventDefault();
        let user_name = document.getElementById('user_name').value;
        let user_age = document.getElementById('user_age').value;
        console.log(user_age, user_name);
        // result_block.innerHTML += '<p>'+ user_name+' '+user_age + '</p>';
        if(user_name&&user_age){
            result_block.innerHTML += `<p>Имя: ${user_name} / Возраст: ${user_age}</p>`;
        }else{
            result_block.innerHTML += `<p>Введите данные</p>`;
        }
        user_form.reset();
    });
</script> -->
</body>
</html>