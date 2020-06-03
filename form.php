<form method="post" enctype="multipart/form-data">
    <label for="input">Введите текст: </label>
    <input type="text" name="input"> <br>

    <label for="filer">Добавьте файл: </label>
    <input type="file" name="filer"> <br>

    <input type="submit" name="submiter"> <br>
</form>

<?php
if (isset($_POST)) {
    $file_name = uniqid(rand()) . '.csv';
    $input = $_POST['input'];
    $filer = $_POST['filer'];
    if (!empty($input)) {
        echo $input . PHP_EOL;
        $text = mb_convert_case($input, MB_CASE_TITLE);
        $count = count(preg_split('/\s+/u', $input, null, PREG_SPLIT_NO_EMPTY)) . PHP_EOL;
        echo '<br>Количество слов в тексте: ', $count, '<br>';
        function countAndSort($string)
        {
            preg_match_all("/[a-zа-я]+/ium", $string, $words);
            $counts = array_count_values(array_map('ucwords', $words[0]));
            $words = array_keys($counts);
            array_multisort($counts, SORT_NUMERIC, SORT_DESC, $words, SORT_STRING);
            return array_map(function ($a, $b) {
                return "'$a' встречается $b раз";
            }, $words, $counts);
        }

        $wordi = countAndSort($text);
        print_r($wordi);

        $fp = fopen("Results/$file_name", 'w');
        foreach ($wordi as $fields) {
            fputcsv($fp, array($fields));
        }
        fclose($fp);
    } elseif (!empty($filer)) {
        echo $filer . PHP_EOL;
        $text1 = mb_convert_case($filer, MB_CASE_TITLE);
        $count1 = count(preg_split('/\s+/u', $filer, null, PREG_SPLIT_NO_EMPTY)) . PHP_EOL;
        echo '<br>Количество слов в тексте: ', $count1, '<br>';
        function countAndSort($string)
        {
            preg_match_all("/[a-zа-я]+/ium", $string, $words);
            $counts = array_count_values(array_map('ucwords', $words[0]));
            $words = array_keys($counts);
            array_multisort($counts, SORT_NUMERIC, SORT_DESC, $words, SORT_STRING);
            return array_map(function ($a, $b) {
                return "'$a' встречается $b раз";
            }, $words, $counts);
        }

        $wordi = countAndSort($text1);
        print_r($wordi);

        $fp = fopen("Results/$file_name", 'w');
        foreach ($wordi as $fields) {
            fputcsv($fp, array($fields));
        }
        fclose($fp);
    } else {
        echo 'Вы ничего не ввели';
    }
}