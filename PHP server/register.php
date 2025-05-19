<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    
<form action="/PHP server/vendor/signup.php" method="post" enctype="multipart/form-data">
    <label>Имя</label>
    <input type="text" name = "name" placeholder="Введите свое имя">
    <label>Телефон</label>
    <input type="text" name = "telephone" placeholder="Введите свой телефон">
    <label>Логин</label>
    <input type="text" name = "login" placeholder="Введите логин">
    <label>Email</label>
    <input type="text" name = "email" placeholder="Введите адрес своей почты">
    <label>Пароль</label>
    <input type="password" name = "password" placeholder="Введите пароль">
    <label>Подтверждение пароля</label>
    <input type="text" name = "password_confirm" placeholder="Подтвердите пароль">
    <button type ="submit">Зарегестрировать</button>
    <p>
        У вас уже есть аккаунт? - <a href="/PHP server/index.php">Авторизируйтесь</a>
    </p>
          <?php
        if(isset($_SESSION['message'])) {
            echo '  <p class="msg">' . $_SESSION['message'].  '</p>';
        }
        unset($_SESSION['message']);
        ?>
</form>
</body>
</html>