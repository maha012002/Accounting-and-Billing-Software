<?php
class IBilling_Viewer
{
    public static function transaction_attachment($path)
    {
        global $_L;

        $pathinfo = pathinfo($path);

        $ext = $pathinfo['extension'];

        if ($ext == 'pdf') {
            return '<a class="btn btn-primary" href="' .
                APP_URL .
                '/application/storage/transactions/' .
                $path .
                '">' .
                $_L['Download PDF'] .
                '</a>';
        } else {
            return '<img class="img-responsive" src="' .
                APP_URL .
                '/application/storage/transactions/' .
                $path .
                '" alt="">';
        }
    }
}
