<?php
class Asset
{
    public static function css($path, $v = '')
    {
        if ($v == '') {
            $ver = '';
        } else {
            $ver = '?ver=' . $v;
        }
        $gen = '';
        if (is_array($path)) {
            foreach ($path as $p) {
                $gen .=
                    '<link rel="stylesheet" type="text/css" href="' .
                    APP_URL .
                    '/ui/lib/' .
                    $p .
                    '.css' .
                    $ver .
                    '" />
        ';
            }
        } else {
            $gen =
                '<link rel="stylesheet" type="text/css" href="' .
                APP_URL .
                '/ui/lib/' .
                $path .
                '.css' .
                $ver .
                '" />
        ';
        }
        return $gen;
    }

    public static function js($path, $v = '')
    {
        if ($v == '') {
            $ver = '';
        } else {
            $ver = '?ver=' . $v;
        }
        $gen = '';
        if (is_array($path)) {
            foreach ($path as $p) {
                $gen .=
                    '<script type="text/javascript" src="' .
                    APP_URL .
                    '/ui/lib/' .
                    $p .
                    '.js' .
                    $ver .
                    '"></script>
        ';
            }
        } else {
            $gen =
                '<script type="text/javascript" src="' .
                APP_URL .
                '/ui/lib/' .
                $path .
                '.js' .
                $ver .
                '"></script>
        ';
        }
        return $gen;
    }

    public static function js_external($link)
    {
        return '<script type="text/javascript" src="' . $link . '"></script>';
    }
}
