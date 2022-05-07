<?php

$ui->assign('_application_menu', 'plugins');
$dir = $routes['1'];
$cont = $routes['2'];
$path = 'application/plugins/' . $dir . '/' . $cont . '.php';
$pl_path = 'application/plugins/' . $dir . '/';
if (file_exists($path)) {
    $_pd = 'application/plugins/' . $dir . '/';
    $ui->assign('_pd', 'application/plugins/' . $dir . '/');
    require $path;
} else {
    r2(U . 'dashboard/', 'e', $_L['Plugin Not Found']);
}
