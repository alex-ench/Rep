<html>
<title>Вне зоны действия сайта</title>
<body>
<h2>Вы вышли из аккаунта, нам Вас уже не хватает...
</h2>
<p>
    <a href='index.php'>Вернуться</a> в главное меню.
</p>
</body>
</html>

<?php
session_start();
session_destroy();
exit();