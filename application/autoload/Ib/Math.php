<?php
class Ib_Math
{
    public static function array_avg($array, $round = 1)
    {
        $num = count($array);
        return array_map(function ($val) use ($num, $round) {
            return [
                'count' => $val,
                'avg' => round(($val / $num) * 100, $round),
            ];
        }, array_count_values($array));
    }

    public static function array_percentage($arr, $round = 1)
    {
        $total = array_sum($arr);

        $ret = [];

        foreach ($arr as $key => $value) {
            if ($value == 0) {
                $ret[$key]['percentage'] = 0;
            } else {
                $ret[$key]['percentage'] = round(
                    ($value / $total) * 100,
                    $round
                );
            }
        }

        return $ret;
    }
}
