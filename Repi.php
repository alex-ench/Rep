<?php
$text = 'Жил на свете добрый волшебник. 
Он жил в мире, где магия стояла на первом месте и практически затмила собой науку. 
А этот волшебник очень увлекался астрономией. 
И вот однажды он подумал, а не сделать ли мне собственную звезду? 
И сотворил звезду. 
Назвал ее Солнце. 
А вокруг неё сделал несколько планет. 
А теперь он темными вечерами наблюдает за Солнцем и несколькими планетами. 
Пьет чай и тихонько улыбается. 
Потому что необыкновенно красиво.';
echo $text. PHP_EOL;
$text1 = mb_convert_case($text, MB_CASE_TITLE);
$count = count(preg_split('/\s+/u', $text, null, PREG_SPLIT_NO_EMPTY)). PHP_EOL;
echo 'Количество слов в тексте: ', $count;

function countAndSort($string)
{
    preg_match_all("/[a-zа-я]+/ium", $string, $words);

    $counts = array_count_values(array_map('ucwords', $words[0]));
    $words = array_keys($counts);

    array_multisort($counts, SORT_NUMERIC, SORT_DESC); //, $words, SORT_STRING
    return array_map(function($a, $b)
    {
        return "'$a' встречается $b раз";
    }, $words, $counts);
}
print_r(countAndSort($text1));




//$frequency = count($text);
//arsort($frequency);
//echo $frequency;
