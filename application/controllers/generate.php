<?php
_auth();
$ui->assign('_title', $_L['Transactions'] . '- ' . $config['CompanyName']);
$ui->assign('_st', 'Transactions');
$ui->assign('_application_menu', 'transactions');
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
$mdate = date('Y-m-d');
switch ($action) {
    case 'balance-sheet':
        $d = ORM::for_table('sys_accounts')
            ->where_not_equal('balance', '0.00')
            ->order_by_desc('balance')
            ->find_many();
        $tbal = ORM::for_table('sys_accounts')
            ->where_not_equal('balance', '0.00')
            ->sum('balance');
        $ui->assign('d', $d);
        $ui->assign('tbal', $tbal);

        $ui->assign('xfooter', Asset::js(['numeric']));

        $ui->assign(
            'xjq',
            '

 $(\'.amount\').autoNumeric(\'init\', {

    aSign: \'' .
                $config['currency_code'] .
                ' \',
    dGroup: ' .
                $config['thousand_separator_placement'] .
                ',
    aPad: ' .
                $config['currency_decimal_digits'] .
                ',
    pSign: \'' .
                $config['currency_symbol_position'] .
                '\',
    aDec: \'' .
                $config['dec_point'] .
                '\',
    aSep: \'' .
                $config['thousands_sep'] .
                '\'

    });

 '
        );

        $ui->display('balance-sheet.tpl');
        break;

    default:
        echo 'action not defined';
}
