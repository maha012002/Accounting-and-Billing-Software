<?php
_auth();
$ui->assign('_application_menu', 'accounts');
$ui->assign('_title', 'Accounts- ' . $config['CompanyName']);
$ui->assign('_st', 'Accounts');
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
switch ($action) {
    case 'dashboard':
        $ui->display('help-dashboard.tpl');
        break;

    default:
        echo 'action not defined';
}
