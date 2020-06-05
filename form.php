<form method="post" enctype="multipart/form-data">
    <label for="input">Введите текст: </label>
    <input type="text" name="input"> <br>

    <label for="docs">Добавьте файл: </label>
    <input type="file" name="docs" multiple> <br>

    <input type="submit" name="submiter"> <br>
</form>

<?php

function countAndSort($string)
{
    preg_match_all("/[a-zа-я]+/ium", $string, $words);
    $counts = array_count_values(array_map('ucwords', $words[0]));
    $words = array_keys($counts);
    array_multisort($counts, SORT_NUMERIC, SORT_DESC, $words, SORT_STRING);
    return array_map(function ($a, $b) {
        return "'$a' встречается $b раз<br>";
    }, $words, $counts);
}

if (isset($_POST)) {
    if (!empty($_POST['input'])) {
        $file_name = uniqid() . '.csv';
        $input = $_POST['input'];
        echo "Введённый текст: \"", $input, "\"" . PHP_EOL;
        $text = mb_convert_case($input, MB_CASE_TITLE);
        $count = count(preg_split('/\s+/u', $input, null, PREG_SPLIT_NO_EMPTY)) . PHP_EOL;
        echo '<br>Количество слов в тексте: ', $count, '<br>';
        $wordi = countAndSort($text);
        print_r($wordi);

        $fp = fopen("Results/$file_name", 'a+');
        foreach ($wordi as $fields) {
            fputcsv($fp, array($fields));
        }
        fclose($fp);

    }
    if (!empty($_FILES['docs']['name'])) {
        $file_name = uniqid() . '.csv';
        $docs = $_FILES['docs'];
        $backup = file_get_contents($docs['tmp_name']);
        echo "Загруженный текст из файла: \"", $backup, "\"";
        $text1 = mb_convert_case($backup, MB_CASE_TITLE);
        $count1 = count(preg_split('/\s+/u', $backup, null, PREG_SPLIT_NO_EMPTY)) . PHP_EOL;
        echo '<br>Количество слов в тексте: ', $count1, '<br>';
        $wordi = countAndSort($text1);
        print_r($wordi);
        $fp = fopen("Results/$file_name", 'a+');
        foreach ($wordi as $fields) {
            fputcsv($fp, array($fields));
        }
        fclose($fp);
    }
    if ((empty($_FILES['docs']['name'])) & (empty($_POST['input']))) {
        echo 'Вы ничего не ввели';
    }
}