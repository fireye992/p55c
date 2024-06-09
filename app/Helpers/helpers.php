<?php

if (!function_exists('str_limit')) {
    function str_limit($value, $limit = 100, $end = '...')
    {
        if (mb_strlen($value) <= $limit) {
            return $value;
        }
        return mb_substr($value, 0, $limit) . $end;
    }
}

if (!function_exists('highlight')) {
    function highlight($text, $word) {
        return preg_replace('/(' . preg_quote($word) . ')/i', '<span style="color:red;">$1</span>', $text);
    }
}
