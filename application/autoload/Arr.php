<?php

class Arr
{
    public static function str_to_arr($str)
    {
        $pieces = explode(',', $str);
        foreach ($pieces as $p) {
        }
    }

    public static function arr_to_str($arr)
    {
        $str = '';
        if (is_array($arr)) {
            foreach ($arr as $a) {
                $str .= $a . ',';
            }
            $str = rtrim($str, ',');
        }
        return $str;
    }
}
