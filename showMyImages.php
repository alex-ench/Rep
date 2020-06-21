<html>
<head>
    <title>Тут все Ваши картинки</title>
</head>
<body>
<h2>Все Ваши картонки на сайте</h2>
<h3> Говорят, что если нажать на картинку, то она откроется в полном размере</h3>
<h4> Я не шучу</h4>
<form action="deleteMyImages.php" method="post" enctype="multipart/form-data">
    <p>
        <label>Будьте осторожны, Вы можете удалить картинки навсегда! Если, конечно, не загрузите их заново.<br></label>
        <button type="submit" name="deleter">Удалить</button>
    </p>
    <p>
        <a href='formImages.php'>Кнопка возврата</a>
    </p>
</body>
</html>

<?php
session_start();
echo '<br> ';
$login = $_SESSION['login'];
include("bd.php");
if (isset($_POST['showMyImages'])) {
    $dir = 'images/';
    $files = scandir($dir);
    $cols = 4;
    echo "<table>";
    $k = 0;
    $i = 0;
    $result = $pdo->query("SELECT name FROM images WHERE login='$login'");
    while ($result2 = $result->fetch(PDO::FETCH_BOTH)) {
        if ($k % $cols == 0) echo "<tr>";
        echo "<td>";
        $path = $dir . $result2['name'];
        $backup = $result2['name'];
        $deletingImages = $pdo->query("SELECT id FROM images WHERE name='$backup'");
        $deletingImages2 = $deletingImages->fetch(PDO::FETCH_BOTH);
        $deletingImages3 = $deletingImages2['id'];
        echo "<a href='$path'>";
        echo "<img src='$path' alt='' width='150' />";
        echo "</a>";
        ?>
        <html>
        <input type="checkbox" name="deleteImage[]" value='<?php echo $deletingImages3; ?>'>
        </html>
        <?php
        echo "</td>";
        if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";
        $k++;
        $i++;
    }
    echo "</table>";
}
