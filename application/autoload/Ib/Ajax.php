<?php

class Ib_Ajax
{
    public static function response($data = [])
    {
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
