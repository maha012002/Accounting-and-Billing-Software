<?php
class Ib_Str
{
    public static function serial($separator = '-')
    {
        $tokens = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        $serial = '';

        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $serial .= $tokens[rand(0, 35)];
            }

            if ($i < 3) {
                $serial .= $separator;
            }
        }

        return $serial;
    }

    public static function random_string($length)
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    public static function random_alpha($lenght)
    {
        $s = substr(
            str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", $lenght)),
            0,
            $lenght
        );

        return $s;
    }
}
