<?php


if (!function_exists('searchByValue')) {
    function searchByValue($array, $key, $value)
    {
        foreach ($array ?? [] as $index => $data) {
            if ($data[$key] == $value) {
                return $index;
            }
        }
        return -1;
    }
}
