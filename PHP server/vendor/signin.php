<?php
session_start();
require_once 'conect.php';
$captcha_token = $_POST['smart-token'];
$captcha_secret = 'ysc1_hKVjpcq9k90o41GtP9oNolJFNbbDSTTs8MNBevMg77bc16e4'; 

$captcha_url = "https://smartcaptcha.yandexcloud.net/validate?secret=$captcha_secret&token=$captcha_token&ip=".$_SERVER['REMOTE_ADDR'];
$captcha_response = file_get_contents($captcha_url);
$captcha_data = json_decode($captcha_response);
if (!$captcha_data->status === 'ok') {
    $_SESSION['message'] = 'Пройдите проверку капчи';
    header('Location: ../index.php');
    exit();
}
$identifier = $_POST['identifier']; 
$password = md5($_POST['password']);
if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
    $check_user = mysqli_query($connect, "SELECT * FROM `usersserver` WHERE `Email` = '$identifier' AND `Password` = '$password'");
} else {
    $phone = preg_replace('/[^0-9]/', '', $identifier);
    $check_user = mysqli_query($connect, "SELECT * FROM `usersserver` WHERE `Telephone` = '$phone' AND `Password` = '$password'");
}
if (mysqli_num_rows($check_user) > 0) {
    $user = mysqli_fetch_assoc($check_user);
    $_SESSION['user'] = [
        "id" => $user['ID'],
        "name" => $user['Name'],
    ];
    header('Location: ../profile.php');
} else {
    $_SESSION['message'] = 'Неверные данные для входа или пароль';
    header('Location: /PHP Server/vendor/signin.php');
}
?>