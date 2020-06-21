<html>
<title>Ну, привет, дружок-пирожок</title>
</html>

<?php
session_start();
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
    exit ("Вы что-то где-то почему-то недописали, <a href='index.php'>вернитесь</a> назад и заполните все поля.");
}
$login = stripslashes(htmlspecialchars(trim($login)));
$password = stripslashes(htmlspecialchars(trim($password)));
include("bd.php");

$result = $pdo->query("SELECT * FROM users WHERE login='$login'");
$myrow = $result->fetch(PDO::FETCH_ASSOC);

if (!empty($myrow['password'])) {
    if ($myrow['password'] == $password) {
        $_SESSION['id'] = $myrow['id'];
        $_SESSION['login'] = $myrow['login'];
        echo "<h2>Добро пожаловать, " . $_SESSION['login'] . "!</h2> <h4>Давно Вас не было в Уличных Гонках!</h4> <a href='formImages.php'>Ваши картинки</a>";
    } else {
        exit ("Не обманывайте чётко отлаженную систему, <a href='index.php'>Вернитесь</a> назад");
    }
} else {
    exit ("Не обманывайте чётко отлаженную систему, <a href='index.php'>Вернитесь</a> назад");
}
?>