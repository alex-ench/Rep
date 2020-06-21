<form method="post" enctype="multipart/form-data">
    <label for="input">Введите текст: </label>
    <input type="text" name="input"> <br>

    <label for="docs">Добавьте файл: </label>
    <input type="file" name="docs"> <br>

    <input type="submit" name="submiter"> <br>
</form>

<?php

function nichego($inputfile)
{
    $file_name = uniqid() . '.csv';
    $text = mb_convert_case($inputfile, MB_CASE_TITLE);
    $wordi = countAndSort($text);
    print_r($wordi);
    $fp = fopen("Results/$file_name", 'a+');
    foreach ($wordi as $fields) {
        fputcsv($fp, array($fields));
    }
    fclose($fp);
}

function countAndSort($string)
{
    preg_match_all("/[a-zа-я]+/ium", $string, $words);
    $counts = array_count_values(array_map('ucwords', $words[0]));
    $words = array_keys($counts);
    array_multisort($counts, SORT_NUMERIC, SORT_DESC, $words, SORT_STRING);
    return array_map(function ($a, $b) {
        return "$a, встречается, $b, раз";
    }, $words, $counts);
}

if (isset($_POST)) {
    if (!empty($_POST['input'])) {
        $input = $_POST['input'];
        nichego($input);
    }
    if (!empty($_FILES['docs']['name'])) {
        $docs = $_FILES['docs'];
        $backup = file_get_contents($docs['tmp_name']);
        nichego($backup);
    }
}