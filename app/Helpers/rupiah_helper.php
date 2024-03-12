<?php

use CodeIgniter\I18n\Time;

if (!function_exists('rupiah')) {
    function rupiah($data)
    {
        // Mengecek apakah nilai yang diberikan adalah float
        if (is_float($data)) {
            // Jika ya, format tanpa desimal
            return number_format($data, 0, ',', '.');
        } else {
            // Jika tidak, format seperti biasa
            return number_format($data, 0, ',', '.');
        }
    }
}
if (!function_exists('only_decimal_string')) {
    function only_decimal_string($string)
    {
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
    }
}

if (!function_exists('only_decimal')) {
    function only_decimal($string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }
}

if (!function_exists('only_string')) {
    function only_string($string)
    {
        return preg_replace('/[^a-zA-Z]/', '', $string);
    }
}

if (!function_exists('only_string_charakter')) {
    function only_string_charakter($string)
    {
        return preg_replace('/[^a-zA-Z0-9.-]/', '', $string);
    }
}
if (!function_exists('waktu')) {
    function waktu()
    {
        return Time::now('Asia/Jakarta', 'en_US');
    }
}
