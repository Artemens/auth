<?php
session_start();

if(!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit();
}

require_once 'vendor/conect.php';
$user_id = $_SESSION['user']['id'];
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $new_name = mysqli_real_escape_string($connect, $_POST['new_name']);
        $new_email = mysqli_real_escape_string($connect, $_POST['new_email']);
        $new_phone = mysqli_real_escape_string($connect, $_POST['new_phone']);
        
        $update_query = "UPDATE `usersserver` SET 
                        `Name` = '$new_name',
                        `Email` = '$new_email',
                        `Telephone` = '$new_phone'
                        WHERE `ID` = '$user_id'";
        
        if (mysqli_query($connect, $update_query)) {
            $_SESSION['user']['name'] = $new_name;
            $message = '<p class="msg">Данные успешно обновлены!</p>';
        } else {
            $message = '<p class="msg error">Ошибка при обновлении данных: ' . mysqli_error($connect) . '</p>';
        }
    }
    
    if (isset($_POST['change_password'])) {
        $current_password = md5($_POST['current_password']);
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $check_password = mysqli_query($connect, "SELECT * FROM `usersserver` WHERE `ID` = '$user_id' AND `Password` = '$current_password'");
        
        if (mysqli_num_rows($check_password) > 0) {
            if ($new_password === $confirm_password) {
                $hashed_password = md5($new_password);
                $update_pass_query = "UPDATE `usersserver` SET `Password` = '$hashed_password' WHERE `ID` = '$user_id'";
                if (mysqli_query($connect, $update_pass_query)) {
                    $message = '<p class="msg">Пароль успешно изменен!</p>';
                } else {
                    $message = '<p class="msg error">Ошибка при изменении пароля</p>';
                }
            } else {
                $message = '<p class="msg error">Новые пароли не совпадают</p>';
            }
        } else {
            $message = '<p class="msg error">Текущий пароль введен неверно</p>';
        }
    }
}
$user_data = mysqli_query($connect, "SELECT * FROM `usersserver` WHERE `ID` = '$user_id'");
$user = mysqli_fetch_assoc($user_data);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#121212">
    <title>FireAuth - Профиль</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <header class="fire-header">
        <div class="container">
            <a href="/PHP Server/index.php" class="logo">Fire<span>Auth</span></a>
            <nav>
                <span class="user-greeting"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                <a href="/PHP Server/logout.php" class="fire-btn logout-btn">Выйти</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="profile-section">
            <div class="profile-header">
                <h1>Ваш профиль</h1>
                <?= $message ?>
            </div>

            <div class="profile-forms">
                <form method="POST" class="edit-form">
                    <h2>Изменение данных</h2>
                    
                    <div class="form-group">
                        <label>Текущее имя: <?= htmlspecialchars($user['Name']) ?></label>
                        <input type="text" name="new_name" value="<?= htmlspecialchars($user['Name']) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Текущий email: <?= htmlspecialchars($user['Email']) ?></label>
                        <input type="email" name="new_email" value="<?= htmlspecialchars($user['Email']) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Текущий телефон: <?= htmlspecialchars($user['Telephone']) ?></label>
                        <input type="text" name="new_phone" value="<?= htmlspecialchars($user['Telephone']) ?>" required>
                    </div>
                    
                    <button type="submit" name="update_profile" class="fire-btn">Сохранить изменения</button>
                </form>
                <form method="POST" class="edit-form">
                    <h2>Изменение пароля</h2>
                    
                    <div class="form-group">
                        <label>Текущий пароль</label>
                        <input type="password" name="current_password" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Новый пароль</label>
                        <input type="password" name="new_password" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Подтвердите новый пароль</label>
                        <input type="password" name="confirm_password" required>
                    </div>
                    
                    <button type="submit" name="change_password" class="fire-btn">Изменить пароль</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>