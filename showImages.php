<html>
<body>
<h2> Говорят, что если нажать на картинку, то она откроется в полном размере</h2>
<h4> Я не шучу</h4>
<a href='formImages.php'>Кнопка возврата</a>
</body>
</html>
<?php
session_start();
$login = $_SESSION['login'];
include("bd.php");

if (isset($_POST['showImages'])) {
    $dir = 'images/';
    $cols = 3;
    $files = scandir($dir);
    if (count($files) !== 0) {
        echo "<table>";
        $k = 0;
        for ($i = 0; $i < count($files); $i++) {
            if (($files[$i] != ".") && ($files[$i] != "..")) {
                if ($k % $cols == 0) echo "<tr>";
                echo "<td>";
                $path = $dir . $files[$i];
                echo "<a href='$path'>";
                echo "<img src='$path' alt='' width='200' />";
                echo "</a>";
                echo "</td>";
                if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";
                $k++;
            } else {
                echo "<br>Картинок нет. :(";
            }
            echo "</table>";
        }
    }
}
