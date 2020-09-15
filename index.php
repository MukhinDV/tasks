<?php
mb_internal_encoding("UTF-8");
// Задание 1
$array = [10, 11, 3, 8, 7];

print_r(secondMax($array));

function secondMax($array)
{
    $length = count($array);

    if ($length == 2) {
        ($array[0] > $array[1]) ? $prevMax = $array[1] : $prevMax = $array[0];
        return $prevMax;
    } else if ($length < 2) {
        throw new Exception('Массив должен быть >= 2');
    }

    if ($array[0] > $array[1]) {
        $prevMax = $array[1];
        $max = $array[0];
    } else if ($array[0] < $array[1]) {
        $prevMax = $array[0];
        $max = $array[1];
    } else {
        $prevMax = $array[0];
        $max = $array[0];
    }

    for ($i = 2; $i < $length; $i++) {
        if ($array[$i] > $max) {
            $prevMax = $max;
            $max = $array[$i];
        } else if ($prevMax < $array[$i]) {
            $prevMax = $array[$i];

        }


    }

    if ($prevMax == $max) {
        throw new Exception('В массиве все одинаковые значения');
    }

    return $prevMax;
}

echo '<br>';

//Задание 5
$input = 'hello, world! Ky, qwer мауф';

print_r(formatString($input));

function formatString($input)
{
    $length = iconv_strlen($input);
    if ($length > 101) {
        throw new Exception('Длина строки должна быть меньше или равна 100 символам');
    } else if ($length == 0) {
        throw new Exception('Длина строки должна быть больше 0');
    }

    $clearInput = preg_replace("#[[:punct:]]#", "", $input);
    $clearInput = mb_strtolower($clearInput);
    $length = iconv_strlen($clearInput);

    $englishVowels = ['a', 'e', 'i', 'o', 'u'];
    $russianVowels = ['а', 'у', 'о', 'ы', 'и', 'э', 'я', 'ю', 'ё', 'е'];

    $result = '';
    for ($i = -1; $i >= -$length; $i--) {
        $current = mb_substr($clearInput, $i, 1);

        if (array_search($current, $englishVowels) !== false || array_search($current, $russianVowels) !== false) {
            $currentUp = mb_strtoupper($current);
            $result .= $currentUp;
            continue;
        }
        $result .= $current;
    }

    return $result;
}

echo '<br>';

//Задание 4

$arr = [1, 5, 10, 3, 4, 2, 7, 8,];
$k = 6;

print_r(pairs($arr, $k));

function pairs($arr, $k)
{
    $length = count($arr) - 1;
    $result = [];

    for ($i = 0; $i < $length; $i++) {
        for ($j = $i + 1; $j <= $length; $j++) {

            $current = abs($arr[$i] - $arr[$j]);
            if (array_key_exists($current, $result)) {
                $result[$current] += 1;
            } else {
                $result += [$current => 1];
            }
        }
    }

    return $result[$k];
}

echo '<br>';

//Задание 3

//$arr = [-59, -36, -13, -53, -92, 1, -2, -96, -54, 75];
//$arr = [-2, 2, 4];
//$arr = [1, -3, 71, 68, 17];
$arr = [-53, -230, 110, -20, 32, 12];

print_r(minAbsDiff($arr));

function minAbsDiff($arr)
{
    $length = count($arr) - 1;
    $result = [];

    for ($i = 0; $i < $length; $i++) {
        for ($j = $i + 1; $j <= $length; $j++) {

            $current = abs($arr[$i] - $arr[$j]);
            if (!in_array($current, $result)) {
                array_push($result, $current);
            }
        }
    }

    return min($result);
}

echo '<br>';

//Задание 2

$a = [7, 1, 2, 4, 9];
$k = 3;
$q = [2, 3, 1, 0, 4];

print_r(ivanAnswersQuestions($a, $k, $q));

function ivanAnswersQuestions(array $a, int $k, array $q)
{
    $length = count($a);

    for ($i = 0; $i < $k; $i++) {
        $lastElement = $a[$length - 1];
        unset($a[$length - 1]);
        array_unshift($a, $lastElement);
    }

    $result = [];

    $length = count($q);
    for ($i = 0; $i < $length; $i++) {
        $result[$i] = $a[$q[$i]];
    }

    return $result;
}