<?php

function number_to_text($number) {
    // Define arrays for the textual representation of numbers
    $ones = ['', 'бир', 'икки', 'уч', 'тўрт', 'беш', 'олти', 'етти', 'саккиз', 'тўққиз'];
    $tens = ['', '', 'йигирма', 'ўттиз', 'қирқ', 'эллик', 'олтмиш', 'етмиш', 'саксон', 'тўқсон'];
    $hundred = 'юз';
    $thousand = 'милион';
    $million = 'миллиард';
    $trillion = 'триллион';
    $quadrillion = 'квадриллион';

    function convert_below_1000($num, $ones, $tens, $hundred) {
        if ($num < 10) {
            return $ones[$num];
        } elseif ($num < 20) {
            return $ones[$num % 10] . ' ўн';
        } elseif ($num < 100) {
            return $tens[$num / 10] . ' ' . $ones[$num % 10];
        } else {
            return $ones[$num / 100] . ' ' . $hundred . ' ' . convert_below_1000($num % 100, $ones, $tens, $hundred);
        }
    }

    function convert($number, $ones, $tens, $hundred, $thousand, $million, $trillion, $quadrillion) {
        if ($number == 0) {
            return 'нол';
        } elseif ($number < 1000) {
            return convert_below_1000($number, $ones, $tens, $hundred);
        } elseif ($number < 1000000) {
            return convert($number / 1000, $ones, $tens, $hundred, $thousand, $million, $trillion, $quadrillion) . ' ' . $thousand . ' ' . convert($number % 1000, $ones, $tens, $hundred, $thousand, $million, $trillion, $quadrillion);
        } elseif ($number < 1000000000) {
            return convert($number / 1000000, $ones, $tens, $hundred, $thousand, $million, $trillion, $quadrillion) . ' ' . $million . ' ' . convert($number % 1000000, $ones, $tens, $hundred, $thousand, $million, $trillion, $quadrillion);
        } elseif ($number < 1000000000000) {
            return convert($number / 1000000000, $ones, $tens, $hundred, $thousand, $million, $trillion, $quadrillion) . ' ' . $trillion . ' ' . convert($number % 1000000000, $ones, $tens, $hundred, $thousand, $million, $trillion, $quadrillion);
        } elseif ($number < 1000000000000000) {
            return convert($number / 1000000000000, $ones, $tens, $hundred, $thousand, $million, $trillion, $quadrillion) . ' ' . $quadrillion . ' ' . convert($number % 1000000000000, $ones, $tens, $hundred, $thousand, $million, $trillion, $quadrillion);
        }
    }

    // Main conversion
    $result = convert($number, $ones, $tens, $hundred, $thousand, $million, $trillion, $quadrillion);
    return trim($result);
}

// Example usage
$number = 971040001;
$text_representation = number_to_text($number);
echo $text_representation;

?>
