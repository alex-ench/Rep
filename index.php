<form method="post" enctype="multipart/form-data">
    <input name="image[]" type="file" multiple> <br>
    <button type="submit" name="sender">Загрузить</button>
    <br>

    <label for="showImages">Просмотреть все изображения </label>
    <button type="submit" name="showImages">Просмотреть</button>
    <br>
</form>

<?php

$pdo = new PDO('mysql:dbname=Base;host=localhost:3306', 'root', 'root');

if (isset($_POST['sender'])) {
    if (!empty($_FILES['image'])) {
        $total = count($_FILES['image']['name']);
        for ($i = 0; $i < $total; $i++) {
            if (($_FILES['image']['type'][$i] == 'image/gif' or $_FILES['image']['type'][$i] == 'image/jpeg' or $_FILES['image']['type'][$i] == 'image/png') and ($_FILES['image']['size'][$i] != 0 and $_FILES['image']['size'][$i] <= 512000)) {
                $size = getimagesize($_FILES['image']['tmp_name'][$i]);
                if ($size[0] < 501 && $size[1] < 1501) {
                    $tmp = $_FILES['image']['tmp_name'][$i];
                    $name = $_FILES['image']['name'][$i];
                    $newtmp = "images/" . $name;
                    if (!file_exists($newtmp)) {
                        if (move_uploaded_file($tmp, $newtmp)) {
                            echo '<br> Файл "', $name, '" загружен. <br>' . PHP_EOL;
                            echo "<img src='$newtmp' alt='$newtmp' />";
                        }
                    } else
                        echo '<br>Файл "', $name, '" существует<br>';
                } else {
                    echo '<br>Загружаемое изображение "', $_FILES['image']['name'][$i], '" превышает допустимые нормы (ширина не более - 500; высота не более 1500)<br>';
                }
            } else
                echo '<br>Файл "', $_FILES['image']['name'][$i], '" имеет неподдерживаемый формат <br>';
        }
    }
}

if (isset($_POST['showImages'])) {
    $dir = 'images/';
    $cols = 4; // Количество столбцов в будущей таблице с картинками
    $files = scandir($dir);
    echo "<table>";
    $k = 0; // Вспомогательный счётчик для перехода на новые строки
    for ($i = 0; $i < count($files); $i++) {
        if (($files[$i] != ".") && ($files[$i] != "..")) { // Текущий каталог и родительский пропускаем
            if ($k % $cols == 0) echo "<tr>"; // Добавляем новую строку
            echo "<td>"; // Начинаем столбец
            $path = $dir . $files[$i]; // Получаем путь к картинке
            echo "<a href='$path'>"; // Делаем ссылку на картинку
            echo "<img src='$path' alt='' width='200' />"; // Вывод превью картинки
            echo "</a>"; // Закрываем ссылку
            echo "</td>"; // Закрываем столбец
            /* Закрываем строку, если необходимое количество было выведено, либо данная итерация последняя */
            if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";
            $k++; // Увеличиваем вспомогательный счётчик
        }
    }
    echo "</table>"; // Закрываем таблицу
}
