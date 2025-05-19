<meta name="theme-color" content="#121212">
<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>
<body>
    
<form action="/PHP server/vendor/signin.php" method="post">
    <label>Email или телефон</label>
    <input type="text" name="identifier" placeholder="Введите email или телефон">
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    
    <div id="captcha-container" class="smart-captcha" data-sitekey="ysc1_hKVjpcq9k90o41GtP9oNolJFNbbDSTTs8MNBevMg77bc16e4"></div>
    
    <button type="submit">Войти</button>
    <p>
        У вас нет аккаунта? - <a href="/PHP server/register.php">Зарегистрируйтесь</a>
    </p>
    <?php
    if(isset($_SESSION['message'])) {
        echo '<p class="msg">' . $_SESSION['message']. '</p>';
    }
    unset($_SESSION['message']);
    ?>
</form>
</body>
</html>