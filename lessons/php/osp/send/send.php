<?php
require_once('config.php');
$user_name = $_POST['user_name'];
$user_age = $_POST['user_age'];
$user_pass = $_POST['user_pass'];
if($user_age < 18){
    echo('Вы не прошли по возрасту: Вам '.$user_age. " лет \n");
    }else{
    // 4. SQL-запрос
    $sql = "INSERT INTO users (name, age, password) VALUES ('$user_name', '$user_age', '$user_pass')";
    $conn->query($sql);
    //echo('Успешно! Поздравляем '.$user_name.' : Вам '.$user_age. " лет \n");
    }
    $conn->close();
    header("Location: /");
?>
<br>
<br>
<a href="/">обратно На форму</a>