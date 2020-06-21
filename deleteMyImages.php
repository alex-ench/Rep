<?php
session_start();
if (isset($_POST['deleteImage'])) {
    if (!empty($_POST['deleteImage'])) {
        include("bd.php");
        $dir = 'images/';
        $files = scandir($dir);
        $backup = $_POST['deleteImage'];
        $backup2 = implode(',', $backup);
        $query = $pdo->query("SELECT name FROM images WHERE id IN($backup2)");
        while ($query1 = $query->fetch(PDO::FETCH_BOTH)) {
            $path = $dir . $query1['name'];
            unlink($path);
        }
        $query = $pdo->query("DELETE FROM images WHERE id IN($backup2)");
        echo '<br> Вы всё же удалили картинки... <a href=\'formImages.php\'>Вернуться</a>.';
    }
} else {
    echo '<br>Нечего удалять, Вы ведь ничего не выбрали. <a href=\'formImages.php\'>Вернитесь</a> назад и выберите картинки, которые хотите удалить.';
}
