<?php 
session_start();
require_once 'conect.php';

$name = $_POST['name'];
$login = $_POST['login'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@email\.com$/', $email)) {
    $_SESSION['message'] = 'Email должен быть в формате example@email.com';
    header('Location: ../register.php');
    exit();
}

$check_email = mysqli_query($connect, "SELECT * FROM `usersserver` WHERE `Email` = '$email'");
if (mysqli_num_rows($check_email) > 0) {
    $_SESSION['message'] = 'Этот email уже зарегистрирован';
    header('Location: ../register.php');
    exit();
}
$check_phone = mysqli_query($connect, "SELECT * FROM `usersserver` WHERE `Telephone` = '$telephone'");
if (mysqli_num_rows($check_phone) > 0) {
    $_SESSION['message'] = 'Этот телефон уже зарегистрирован';
    header('Location: ../register.php');
    exit();
}
if ($password === $password_confirm) {
    $password = md5($password);
    $query = "INSERT INTO `usersserver` 
             (`ID`, `Name`, `Login`, `Telephone`, `Email`, `Password`) 
             VALUES (NULL, '$name', '$login', '$telephone', '$email', '$password')";
    
    if (mysqli_query($connect, $query)) {
        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ../index.php');
    } else {
        $_SESSION['message'] = 'Ошибка при регистрации: ' . mysqli_error($connect);
        header('Location: ../register.php');
    }
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../register.php');
}
?>