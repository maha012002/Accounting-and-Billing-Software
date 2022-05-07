<?php
_auth();
$ui->assign('_application_menu', 'accounts');
$ui->assign('_title', $_L['Accounts'] . '- ' . $config['CompanyName']);
$ui->assign('_st', $_L['Accounts']);
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);

Event::trigger('accounts');

switch ($action) {
    case 'balances':
        //Find all accounts
        $d = ORM::for_table('sys_accounts')->find_many();
        $tbal = ORM::for_table('sys_accounts')->sum('balance');
        $tbal = ib_money_format($tbal, $config);
        $ui->assign('d', $d);
        $ui->assign('tbal', $tbal);
        $ui->display('account-balances.tpl');

        break;

    case 'add':
        $ui->assign('xfooter', Asset::js(['numeric']));
        $ui->assign(
            'xjq',
            '
 $(\'.amount\').autoNumeric(\'init\',{
 
 vMin: \'-9999999999999.99\'
 
 });
 '
        );
        $ui->display('account-add.tpl');
        break;

    case 'add-post':
        $account = _post('account');
        $description = _post('description');
        $balance = _post('balance');
        $balance = Finance::amount_fix($balance);
        $msg = '';
        if (Validator::Length($account, 100, 2) == false) {
            $msg .= $_L['account_title_length_error'] . '<br>';
        }
        //check with same name account is exist
        $d = ORM::for_table('sys_accounts')
            ->where('account', $account)
            ->find_one();
        if ($d) {
            $msg .= $_L['account_already_exist'] . '<br>';
        }

        if (is_numeric($balance) == false) {
            $balance = '0.00';
        }

        // From version 4

        $ex_msg = '';

        $ib_url = _post('ib_url');

        if ($ib_url != '') {
            if (filter_var($ib_url, FILTER_VALIDATE_URL) === false) {
                $ex_msg .= '. Error: Invalid URL. URL Not Updated.';
                $ib_url = '';
            }
        }

        if ($msg == '') {
            if ($_app_stage == 'Demo') {
                r2(
                    U . 'accounts/add',
                    'e',
                    'Sorry! Adding New Account is disabled in the demo mode.'
                );
            }
            if ($balance != '0.00') {
                //Add a Transaction
                $d = ORM::for_table('sys_transactions')->create();
                $d->account = $account;
                $d->type = 'Income';
                $d->payer = $_L['system'];
                $d->amount = $balance;
                $d->date = date('Y-m-d');
                $d->dr = '0.00';
                $d->cr = $balance;
                $d->bal = $balance;
                $d->description = $_L['initial_balance'];

                $d->category = '';
                $d->payer = '';
                $d->payee = '';
                $d->payeeid = '0';
                $d->payerid = '0';
                $d->status = 'Cleared';
                $d->tax = '0.00';
                $d->iid = 0;
                $d->method = '';
                $d->ref = '';
                $d->tags = '';

                $d->aid = 0;
                $d->updated_at = date('Y-m-d H:i:s');

                $d->save();
            }
            // Add Account
            $d = ORM::for_table('sys_accounts')->create();
            $d->account = $account;
            $d->description = $description;
            $d->balance = $balance;

            // From Version 4

            $d->bank_name = '';
            $d->account_number = _post('account_number');
            $d->currency = '';
            $d->branch = '';
            $d->address = '';
            $d->contact_person = _post('contact_person');
            $d->contact_phone = _post('contact_phone');
            $d->website = '';
            $d->ib_url = $ib_url;
            $d->created = date('Y-m-d H:i:s');
            $d->notes = '';
            $d->sorder = 1;
            $d->e = '';
            $d->token = '';
            $d->status = '';

            $d->save();
            r2(
                U . 'accounts/list',
                's',
                $_L['account_created_successfully'] . $ex_msg
            );
        } else {
            r2(U . 'accounts/add', 'e', $msg);
        }
        break;

    case 'list':
        $d = ORM::for_table('sys_accounts')->find_many();
        $ui->assign('d', $d);
        $ui->assign(
            'xfooter',
            '
<script type="text/javascript" src="' .
                $_theme .
                '/lib/accounts.js"></script>
'
        );
        $ui->display('accounts-manage.tpl');
        break;

    case 'edit':
        $id = $routes['2'];
        $d = ORM::for_table('sys_accounts')->find_one($id);
        if ($d) {
            $ui->assign('d', $d);
            $ui->display('account-edit.tpl');
        } else {
            r2(U . 'accounts/list', 'e', $_L['Account_Not_Found']);
        }

        break;
    case 'edit-post':
        $account = _post('account');
        $description = _post('description');
        $id = _post('id');
        $msg = '';
        if (Validator::Length($account, 100, 2) == false) {
            $msg .= $_L['account_title_length_error'] . '<br>';
        }

        $ex_msg = '';

        $ib_url = _post('ib_url');

        if ($ib_url != '') {
            if (filter_var($ib_url, FILTER_VALIDATE_URL) === false) {
                $ex_msg .= '. Error: Invalid URL. URL Not Updated.';
                $ib_url = '';
            }
        }

        if ($msg == '') {
            $d = ORM::for_table('sys_accounts')->find_one($id);
            if ($d) {
                $oaccount = $d['account'];
                $d->account = $account;
                $d->description = $description;

                // From Version 4

                // From Version 4

                $d->bank_name = '';
                $d->account_number = _post('account_number');
                $d->currency = '';
                $d->branch = '';
                $d->address = '';
                $d->contact_person = _post('contact_person');
                $d->contact_phone = _post('contact_phone');
                $d->website = '';
                $d->ib_url = $ib_url;
                $d->created = date('Y-m-d');
                $d->notes = '';
                $d->sorder = 1;
                $d->e = '';
                $d->token = '';
                $d->status = '';

                $d->save();

                //now update all transactions with the new name

                $b = ORM::for_table('sys_transactions')
                    ->where('account', $oaccount)
                    ->find_result_set()
                    ->set('account', $account)
                    ->save();

                r2(
                    U . 'accounts/list',
                    's',
                    $_L['account_updated_successfully'] . $ex_msg
                );
            } else {
                r2(U . 'accounts/list', 'e', $_L['Account_Not_Found']);
            }
        } else {
            r2(U . 'accounts/add', 'e', $msg);
        }

        break;
    case 'delete':
        if (!has_access($user->roleid, 'bank_n_cash', 'delete')) {
            permissionDenied();
        }

        $id = $routes['2'];
        $id = str_replace('did', '', $id);
        if ($_app_stage == 'Demo') {
            r2(
                U . 'accounts/list',
                'e',
                'Sorry! Deleting Account is disabled in the demo mode.'
            );
        }
        $d = ORM::for_table('sys_accounts')->find_one($id);
        if ($d) {
            $d->delete();
            r2(U . 'accounts/list', 's', $_L['account_delete_successful']);
        }

        break;
    case 'post':
        break;

    default:
        echo 'action not defined';
}
