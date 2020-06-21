<?php
//Готово, вроде бы...
if (isset($_POST['login'])) {
    $login = $_POST['login'];
    if ($login == '') {
        unset($login);
    }
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password == '') {
        unset($password);
    }
}
if (empty($login) or empty($password)) {
    exit ("Вы ввели не всю информацию, <a href='reg.php'>вернитесь</a> назад и заполните все поля.");
}
$login = stripslashes(htmlspecialchars(trim($login)));
$password = stripslashes(htmlspecialchars(trim($password)));
include("bd.php");
$result = $pdo->query("SELECT id FROM users WHERE login='$login'");
$myrow = $result->fetch(PDO::FETCH_BOTH);

if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. <a href='reg.php'>Введите</a> другой логин.");
} else {
    $result2 = $pdo->query("INSERT INTO users (login,password) VALUES('$login','$password')");
    if ($result2 == TRUE)
        echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница.</a>";
    else {
        echo 'Ошибка!';
    }
}
?>