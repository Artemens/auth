<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#121212">
    <title>FireAuth - Главная</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>
<body>
    <header class="fire-header">
        <div class="container">
            <a href="/PHP Server/index.php" class="logo">Fire<span>Auth</span></a>
            <nav>
                <?php if(isset($_SESSION['user'])): ?>
                    <span class="user-greeting"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                    <a href="/PHP Server/logout.php" class="fire-btn logout-btn">Выйти</a>
                <?php else: ?>
                    <a href="/PHP Server/login.php" class="fire-btn login-btn">Войти</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="hero-section">
            <div class="hero-content">
                <h1>Добро пожаловать в <span>FireAuth</span></h1>
                <p class="hero-text">Современная система c мечом огня и щитом безопасности</p>
                
                <?php if(!isset($_SESSION['user'])): ?>
                    <div class="hero-buttons">
                        <a href="/PHP Server/login.php" class="fire-btn">Войти в систему</a>
                        <a href="/PHP Server/register.php" class="fire-btn outline">Зарегистрироваться</a>
                    </div>
                <?php else: ?>
                    <div class="hero-buttons">
                        <a href="/PHP Server/profile.php" class="fire-btn">Личный кабинет</a>
                        <a href="/PHP Server/logout.php" class="fire-btn outline">Выйти</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="features-section">
            <h2>Наши преимущества</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🔥</div>
                    <h3>Безопасность</h3>
                    <p>Защита вашего золота с помощью современных технологий</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Скорость</h3>
                    <p>Мгновенный доступ к вашему замку</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎨</div>
                    <h3>Дизайн</h3>
                    <p>Стильный стиль с темной темой</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>