<html>
<head>
    <title>Тут картинки</title>
</head>
<body>
<h2>Здесь Вы найдёте любые пикчи, которые сами же и закинете!</h2>
<form action="uploadMyImages.php" method="post" enctype="multipart/form-data">
    <p>
        <label>Погрузка приколов:<br></label>
        <input name="image[]" type="file" multiple> <br>
        <button type="submit" name="sender">Загрузить</button>
    </p>
</form>
<form action="showImages.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="showImages">Просмотреть все приколы </label>
        <button type="submit" name="showImages">Глянуть</button>
    </p>
</form>
<form action="showMyImages.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="showMyImages">Просмотреть Ваши приколы </label>
        <button type="submit" name="showMyImages">Глянуть</button>
    </p>
    <p>
        <a href="exit.php">Выйти из аккаунта</a>
    </p>
</form>
</body>
</html>