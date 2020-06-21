<?php
session_start();
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Лучший хостинг картинок</title>
</head>
<body>
<h2>Вас приветствует лучший хостинг картинок за последнюю тысячу лет</h2>
<h3>Тут авторизация</h3>
<form action="testreg.php" method="post">
    <p>
        <label>Ваш имя на интернетовском языке:<br></label>
        <input type="text" name="login" size="15" maxlength="15">
    </p>
    <p>
        <label>Ваше секретное сочетание:<br></label>
        <input type="password" name="password" size="15" maxlength="15">
    </p>
    <p>
        <input type="submit" name="submit" value="Войти">
        <br>
        <a href="reg.php">Зарегистрироривавоваться</a>
    </p>
</form>
<br>
<?php
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    echo "Вы зашли на сайт без уважения, как гость. Зайдите, как подобает.<br>";
}
?>
</body>
</html>