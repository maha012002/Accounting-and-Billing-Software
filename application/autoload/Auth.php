<?php
class Auth
{
    public static function _admin()
    {
        $user = User::_info();
        if ($user['user_type'] == 'Admin') {
            return true;
        }
        r2(U . 'dashboard', 'e', 'Invalid Access');
    }

    public static function _reseller4()
    {
        $user = User::_info();
        if (
            $user['user_type'] == 'Admin' or
            $user['user_type'] == 'Reseller 4'
        ) {
            return true;
        }
        r2(U . 'dashboard', 'e', 'Invalid Access');
    }

    public static function _reseller3()
    {
        $user = User::_info();
        if (
            $user['user_type'] == 'Admin' or
            $user['user_type'] == 'Reseller 4' or
            $user['user_type'] == 'Reseller 3'
        ) {
            return true;
        }
        r2(U . 'dashboard', 'e', 'Invalid Access');
    }

    public static function _reseller2()
    {
        $user = User::_info();
        if (
            $user['user_type'] == 'Admin' or
            $user['user_type'] == 'Reseller 4' or
            $user['user_type'] == 'Reseller 3' or
            $user['user_type'] == 'Reseller 2'
        ) {
            return true;
        }
        r2(U . 'dashboard', 'e', 'Invalid Access');
    }
}
