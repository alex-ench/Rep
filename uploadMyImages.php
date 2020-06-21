<?php
session_start();
echo '<br> <a href=\'formImages.php\'>Кнопка возврата</a>';
$login = $_SESSION['login'];
include("bd.php");
var_dump($_FILES);
if (isset($_POST['sender'])) {
    if (!empty($_FILES['image'])) {
        $total = count($_FILES['image']['name']);
        for ($i = 0; $i < $total; $i++) {
            if (($_FILES['image']['type'][$i] == 'image/gif' or $_FILES['image']['type'][$i] == 'image/jpeg' or $_FILES['image']['type'][$i] == 'image/png') and ($_FILES['image']['size'][$i] != 0 and $_FILES['image']['size'][$i] <= 512000)) {
                $size = getimagesize($_FILES['image']['tmp_name'][$i]);
                if ($_FILES['image']['type'][$i] == 'image/gif')
                    $type = 'gif';
                elseif ($_FILES['image']['type'][$i] == 'image/jpeg')
                    $type = 'jpg';
                else
                    $type = 'png';
                if ($size[0] < 501 && $size[1] < 1501) {
                    $tmp = $_FILES['image']['tmp_name'][$i];
                    $randname = md5(microtime());;
                    $name = $randname . "." . $type;
                    $location = "images/" . $name;
                    if (move_uploaded_file($tmp, $location)) {
                        echo '<br> Файл "', $_FILES['image']['name'][$i], '" загружен. <br>';
                        echo "<img src='$location' alt='$location' />";
                        $pdo->query("INSERT INTO images (login, name) VALUES ('$login', '$name')");
                    }
                } else {
                    echo '<br>Загружаемое изображение "', $_FILES['image']['name'][$i], '" превышает допустимые нормы (ширина не более - 500; высота не более 1500)<br>';
                }
            } else
                echo '<br>Файл "', $_FILES['image']['name'][$i], '" имеет неподдерживаемый формат <br>';
        }
    } else
        echo '<br> Вы не закинули свои красивые картинки.';
}
