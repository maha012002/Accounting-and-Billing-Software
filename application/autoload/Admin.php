<?php
class Admin
{
    public static function isLogged()
    {
        if (isset($_COOKIE['ib_at'])) {
            $ib_at = $_COOKIE['ib_at'];

            if ($ib_at == '') {
                return;
            }

            $d = ORM::for_table('sys_users')
                ->where('autologin', $ib_at)
                ->find_one();

            if ($d) {
                global $_L, $file_build, $config;

                $after = route(2);
                $rd = U . $config['redirect_url'] . '/';

                if ($after != '') {
                    $after = str_replace('*', '/', $after);

                    $rd = U . $after . '/';
                }

                $_SESSION['uid'] = $d['id'];
                $d->last_login = date('Y-m-d H:i:s');
                $d->save();
                _log(
                    $_L['Login Successful'] . ' ' . $d->username,
                    'Admin',
                    $d->id
                );

                if (
                    !isset($config['build']) or
                    $config['build'] < $file_build
                ) {
                    r2(U . 'update/');
                }

                r2($rd);
            }
        }
    }

    public static function logout()
    {
        if (isset($_COOKIE['ib_at'])) {
            $ib_at = $_COOKIE['ib_at'];

            $d = ORM::for_table('sys_users')
                ->where('autologin', $ib_at)
                ->find_one();

            if ($d) {
                setcookie('ib_at', 'expired', 1, "/");

                $d->autologin = '';
                $d->save();
            }
        }
    }
}
