<form method="post" enctype="multipart/form-data">
    <label for="input">Введите текст: </label>
    <input type="text" name="input"> <br>

    <label for="filer">Добавьте файл: </label>
    <input type="file" name="filer"> <br>

    <label for="checkbox[values][1]">Текст </label>
    <input type="checkbox" name="checkbox[values][1]" value="1"> <br>

    <label for="checkbox[values][2]">Файл </label>
    <input type="checkbox" name="checkbox[values][2]" value="2"> <br>

    <input type="submit" name="submiter"> <br>
</form>

<?php
if(isset($_POST['submiter']))
{
    touch('text1.txt');
    $input = $_POST['input'];
    $f = fopen('text1.txt', 'w');
    fputs($f, $input);

    $text = file_get_contents('text1.txt');
    echo $text. PHP_EOL;
    $text1 = mb_convert_case($text, MB_CASE_TITLE);
    $count = count(preg_split('/\s+/u', $text, null, PREG_SPLIT_NO_EMPTY)). PHP_EOL;
    echo '<br>Количество слов в тексте: ', $count, '<br>';
    function countAndSort($string)
    {
        preg_match_all("/[a-zа-я]+/ium", $string, $words);

        $counts = array_count_values(array_map('ucwords', $words[0]));
        $words = array_keys($counts);

        array_multisort($counts, SORT_NUMERIC, SORT_DESC, $words, SORT_STRING);
        return array_map(function($a, $b)
        {
            return "'$a' встречается $b раз <br>". PHP_EOL;
        }, $words, $counts);
    }
    print_r(countAndSort($text1));
    fclose($f);
    unlink('text1.txt');
}