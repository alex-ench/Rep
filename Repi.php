<?php
$text = 'Жил на свете добрый волшебник. Он жил в мире, где магия стояла на первом месте и практически затмила собой науку. А этот волшебник очень увлекался астрономией. И вот однажды он подумал, а не сделать ли мне собственную звезду? И сотворил звезду. Назвал её Солнце. А вокруг неё сделал несколько планет. А теперь он тёмными вечерами наблюдает за Солнцем и несколькими планетами. Пьёт чай и тихонько улыбается. Потому что необыкновенно красиво.';
echo $text. PHP_EOL;
$text1 = $text;
echo 'Количество слов в тексте: ', count(preg_split('/\s+/u', $text1, null, PREG_SPLIT_NO_EMPTY)), PHP_EOL;

$search_words = preg_split("/[\s,.]/", $text);
foreach ($search_words as $word)
{
    preg_match_all ('/'.$word.'/', $text, $matches);

    $result[$word] = count ($matches[0]). PHP_EOL;
}
foreach ($result as $index => $val)
{
    echo("$index - $val");
}

//$frequency = count($text);
//arsort($frequency);
//echo $frequency;
