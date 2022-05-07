<?php

_auth();
$ui->assign('_title', $_L['Settings'] . '- ' . $config['CompanyName']);
$ui->assign('_st', $_L['Settings']);
$ui->assign('_application_menu', 'settings');

$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
$ui->assign('_user', $user);

$update_server = 'http://www.cloudonex.com/';

switch ($action) {
    case 'expense-categories':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        $d = ORM::for_table('sys_cats')
            ->where('type', 'Expense')
            ->order_by_asc('sorder')
            ->find_many();
        $ui->assign('d', $d);
        $ui->assign(
            'xheader',
            '
<link rel="stylesheet" type="text/css" href="' .
                $_theme .
                '/css/liststyle.css"/>
'
        );
        $ui->assign('xjq', Reorder::js('sys_cats'));
        $ui->display('expense-categories.tpl');

        break;

    case 'expense-categories-post':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        $name = _post('name');
        if ($name == '') {
            r2(U . "settings/expense-categories", 'e', $_L['name_error']);
        }
        //check categories already exist
        $c = ORM::for_table('sys_cats')
            ->where('name', $name)
            ->where('type', 'Expense')
            ->find_one();
        if ($c) {
            r2(U . "settings/expense-categories", 'e', $_L['name_exist_error']);
        }
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/expense-categories',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        $d = ORM::for_table('sys_cats')->create();

        $d->name = $name;
        $d->type = 'Expense';
        $d->save();
        r2(U . "settings/expense-categories", 's', $_L['added_successful']);
        break;

    case 'income-categories':
        $ui->assign('content_inner', inner_contents($config['c_cache']));

        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        $d = ORM::for_table('sys_cats')
            ->where('type', 'Income')
            ->order_by_asc('sorder')
            ->find_many();
        $ui->assign('d', $d);
        $ui->assign(
            'xheader',
            '
<link rel="stylesheet" type="text/css" href="' .
                $_theme .
                '/css/liststyle.css"/>
'
        );

        $ui->assign('xjq', Reorder::js('sys_cats'));
        $ui->display('income-categories.tpl');

        break;

    case 'income-categories-post':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        $name = _post('name');
        if ($name == '') {
            r2(U . "settings/income-categories", 'e', $_L['name_error']);
        }
        $c = ORM::for_table('sys_cats')
            ->where('name', $name)
            ->where('type', 'Income')
            ->find_one();
        if ($c) {
            r2(U . "settings/income-categories", 'e', $_L['name_exist_error']);
        }
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/income-categories',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        $d = ORM::for_table('sys_cats')->create();

        $d->name = $name;
        $d->type = 'Income';
        $d->save();
        r2(U . "settings/income-categories", 's', $_L['added_successful']);
        break;

    case 'categories-manage':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        $id = $routes[2];
        $d = ORM::for_table('sys_cats')->find_one($id);
        if ($d) {
            $ui->assign('c', $d);
            $ui->display('categories-edit.tpl');
        }

        break;

    case 'categories-edit-post':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        $id = _post('id');
        $d = ORM::for_table('sys_cats')->find_one($id);
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/expense-categories',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        if ($d) {
            $otype = $d['type'];
            $rd = strtolower($otype);
            $name = _post('name');
            $c = ORM::for_table('sys_cats')
                ->where('name', $name)
                ->where('type', $otype)
                ->find_one();
            if ($c) {
                r2(U . "settings/$rd-categories", 'e', $_L['name_exist_error']);
            }
            $oname = $d['name'];
            $type = $d['type'];
            if ($name == '') {
                r2(
                    U . "settings/categories-manage/$id",
                    'e',
                    $_L['name_error']
                );
            } else {
                $d->name = $name;
                $d->save();
                //update payee in transactions
                ORM::for_table('sys_transactions')->raw_execute(
                    "update sys_transactions set category='$name' where (category='$oname' AND type='$type')"
                );
                r2(
                    U . "settings/categories-manage/$id",
                    's',
                    $_L['edit_successful']
                );
            }
        }
        break;

    case 'categories-delete':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        $id = $routes[2];
        $d = ORM::for_table('sys_cats')->find_one($id);
        if ($d) {
            if ($_app_stage == 'Demo') {
                r2(
                    U . 'settings/expense-categories',
                    'e',
                    'Sorry! This option is disabled in the demo mode.'
                );
            }
            //find all transaction in this category
            $name = $d['name'];
            $type = $d['type'];

            ORM::for_table(
                'sys_transactions'
            )->raw_query(
                "update sys_transactions set category=:cat where category='$name' AND type='$type'",
                ['cat' => 'Uncategorized']
            );
            $d->delete();
            if ($type == 'Income') {
                r2(
                    U . "settings/income-categories",
                    's',
                    $_L['delete_successful']
                );
            } else {
                r2(
                    U . "settings/expense-categories",
                    's',
                    $_L['delete_successful']
                );
            }
        }
        break;

    case 'payee':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        $d = ORM::for_table('sys_payee')
            ->order_by_asc('sorder')
            ->find_many();
        $ui->assign('d', $d);
        $ui->assign(
            'xheader',
            '
<link rel="stylesheet" type="text/css" href="' .
                $_theme .
                '/css/liststyle.css"/>
'
        );
        $ui->assign(
            'xfooter',
            '
<script type="text/javascript" src="' .
                $_theme .
                '/js/jquery-ui-1.10.2.custom.min.js"></script>
'
        );
        $ui->assign('xjq', Reorder::js('sys_payee'));
        $ui->display('payee.tpl');

        break;

    case 'payee-manage':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        $id = $routes[2];
        $d = ORM::for_table('sys_payee')->find_one($id);
        if ($d) {
            $ui->assign('c', $d);
            $ui->display('payee-manage.tpl');
        }

        break;

    case 'payee-edit-post':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/payee',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        $id = _post('id');
        $d = ORM::for_table('sys_payee')->find_one($id);
        if ($d) {
            $name = _post('name');
            $c = ORM::for_table('sys_payee')
                ->where('name', $name)
                ->find_one();
            if ($c) {
                r2(U . "settings/payee", 'e', $_L['name_exist_error']);
            }

            $oname = $d['name'];

            if ($name == '') {
                r2(U . "settings/payee-manage/$id", 'e', $_L['name_error']);
            } else {
                $d->name = $name;
                $d->save();
                //update payee in transactions
                ORM::for_table(
                    'sys_transactions'
                )->raw_query(
                    "update sys_transactions set payee=:payee where payee='$oname'",
                    ['payee' => $name]
                );
                r2(
                    U . "settings/payee-manage/$id",
                    's',
                    $_L['edit_successful']
                );
            }
        }

        break;

    case 'payee-post':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        $name = _post('name');
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/payee',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        if ($name == '') {
            r2(U . "settings/payee", 'e', $_L['name_error']);
        }

        $c = ORM::for_table('sys_payee')
            ->where('name', $name)
            ->find_one();
        if ($c) {
            r2(U . "settings/payee", 'e', $_L['name_exist_error']);
        }

        $d = ORM::for_table('sys_payee')->create();

        $d->name = $name;

        $d->save();
        r2(U . "settings/payee", 's', $_L['added_successful']);
        break;

    case 'payee-delete':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/payee',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        $id = $routes[2];
        $d = ORM::for_table('sys_payee')->find_one($id);
        if ($d) {
            $d->delete();

            r2(U . "settings/payee", 's', $_L['delete_successful']);
        }
        break;

    case 'payer':
        $ui->assign('content_inner', inner_contents($config['c_cache']));

        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        $d = ORM::for_table('sys_payers')
            ->order_by_asc('sorder')
            ->find_many();
        $ui->assign('d', $d);
        $ui->assign(
            'xheader',
            '
<link rel="stylesheet" type="text/css" href="' .
                $_theme .
                '/css/liststyle.css"/>
'
        );
        $ui->assign(
            'xfooter',
            '
<script type="text/javascript" src="' .
                $_theme .
                '/js/jquery-ui-1.10.2.custom.min.js"></script>
'
        );
        $ui->assign('xjq', Reorder::js('sys_payers'));
        $ui->display('payer.tpl');

        break;

    case 'payer-manage':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        $id = $routes[2];
        $d = ORM::for_table('sys_payers')->find_one($id);
        if ($d) {
            $ui->assign('c', $d);
            $ui->display('payer-manage.tpl');
        }

        break;

    case 'payer-edit-post':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/payer',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        $id = _post('id');
        $d = ORM::for_table('sys_payers')->find_one($id);
        if ($d) {
            $name = _post('name');
            $c = ORM::for_table('sys_payers')
                ->where('name', $name)
                ->find_one();
            if ($c) {
                r2(U . "settings/payer", 'e', $_L['name_exist_error']);
            }

            $oname = $d['name'];

            if ($name == '') {
                r2(U . "settings/payer-manage/$id", 'e', $_L['name_error']);
            } else {
                $d->name = $name;
                $d->save();

                ORM::for_table(
                    'sys_transactions'
                )->raw_query(
                    "update sys_transactions set payer=:payer where payer='$oname'",
                    ['payer' => $name]
                );
                r2(
                    U . "settings/payer-manage/$id",
                    's',
                    $_L['edit_successful']
                );
            }
        }

        break;

    case 'payer-post':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/payer',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        $name = _post('name');
        if ($name == '') {
            r2(U . "settings/payer", 'e', $_L['name_error']);
        }

        $c = ORM::for_table('sys_payers')
            ->where('name', $name)
            ->find_one();
        if ($c) {
            r2(U . "settings/payer", 'e', $_L['name_exist_error']);
        }

        $d = ORM::for_table('sys_payers')->create();

        $d->name = $name;

        $d->save();
        r2(U . "settings/payer", 's', $_L['added_successful']);
        break;

    case 'payer-delete':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/payer',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        $id = $routes[2];
        $d = ORM::for_table('sys_payers')->find_one($id);
        if ($d) {
            $d->delete();

            r2(U . "settings/payer", 's', $_L['delete_successful']);
        }
        break;
    case 'pmethods':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        $d = ORM::for_table('sys_pmethods')
            ->order_by_asc('sorder')
            ->find_many();
        $ui->assign('d', $d);
        $ui->assign(
            'xheader',
            '
<link rel="stylesheet" type="text/css" href="' .
                $_theme .
                '/css/liststyle.css"/>
'
        );

        $ui->assign('xjq', Reorder::js('sys_pmethods'));
        $ui->display('pmethods.tpl');

        break;

    case 'pmethods-manage':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        $id = $routes[2];
        $d = ORM::for_table('sys_pmethods')->find_one($id);
        if ($d) {
            $ui->assign('c', $d);
            $ui->display('pmethods-manage.tpl');
        }

        break;

    case 'pmethods-edit-post':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/pmethods',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        $id = _post('id');
        $d = ORM::for_table('sys_pmethods')->find_one($id);
        if ($d) {
            $name = _post('name');
            $c = ORM::for_table('sys_pmethods')
                ->where('name', $name)
                ->find_one();
            if ($c) {
                r2(U . "settings/pmethods", 'e', $_L['name_exist_error']);
            }

            $oname = $d['name'];

            if ($name == '') {
                r2(U . "settings/pmethods-manage/$id", 'e', $_L['name_error']);
            } else {
                $d->name = $name;
                $d->save();

                ORM::for_table(
                    'sys_transactions'
                )->raw_query(
                    "update sys_transactions set pmethod=:pmethod where pmethod='$oname'",
                    ['pmethod' => $name]
                );
                r2(
                    U . "settings/pmethods-manage/$id",
                    's',
                    $_L['edit_successful']
                );
            }
        }

        break;

    case 'pmethods-post':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/pmethods',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        $name = _post('name');
        if ($name == '') {
            r2(U . "settings/pmethods", 'e', $_L['name_error']);
        }

        $c = ORM::for_table('sys_pmethods')
            ->where('name', $name)
            ->find_one();
        if ($c) {
            r2(U . "settings/pmethods", 'e', $_L['name_exist_error']);
        }

        $d = ORM::for_table('sys_pmethods')->create();

        $d->name = $name;

        $d->save();
        r2(U . "settings/pmethods", 's', $_L['added_successful']);
        break;

    case 'pmethods-delete':
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/pmethods',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        $id = $routes[2];
        $d = ORM::for_table('sys_pmethods')->find_one($id);
        if ($d) {
            $d->delete();

            r2(U . "settings/pmethods", 's', $_L['delete_successful']);
        }
        break;

    case 'app':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        //find current invoice increment
        $tblsts = ORM::for_table('sys_invoices')
            ->raw_query("show table status like 'sys_invoices'")
            ->find_one();
        $ai = $tblsts['Auto_increment'];
        $ui->assign('ai', $ai);

        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        $timezonelist = Timezone::timezoneList();
        $ui->assign('tlist', $timezonelist);

        //find email settings

        $e = ORM::for_table('sys_emailconfig')->find_one('1');
        $ui->assign('e', $e);

        // find all animations

        $ui->assign(
            'xheader',
            Asset::css(['s2/css/select2.min', 'redactor/redactor'])
        );
        $ui->assign(
            'xfooter',
            Asset::js([
                'redactor/redactor.min',
                's2/js/select2.min',
                's2/js/i18n/' . lan(),
                'settings/general',
            ])
        );

        $ui->assign(
            'xjq',
            '

$(\'#invoice_terms\').redactor(
{
minHeight: 150 // pixels
}
);


 '
        );

        $ui->display('app-settings.tpl');

        break;

    case 'features':
        $ui->assign('content_inner', inner_contents($config['c_cache']));

        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        $ui->assign(
            'xfooter',
            '
<script type="text/javascript" src="' .
                $_theme .
                '/lib/feature-settings.js"></script>
'
        );

        $ui->assign(
            'xjq',
            '



 '
        );

        $ui->display('feature-settings.tpl');

        break;

    case 'users':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        //        $ui->assign('xfooter', '
        //<script type="text/javascript" src="ui/lib/c/users.js"></script>
        //');
        $d = ORM::for_table('sys_users')->find_many();
        $ui->assign('d', $d);
        $ui->display('users.tpl');

        break;

    case 'users-add':
        $ui->assign('xfooter', Asset::js('settings/staff'));
        $ui->assign('content_inner', inner_contents($config['c_cache']));

        $roles = Model::factory('Models_Role')->find_array();
        $ui->assign('roles', $roles);

        $ui->display('users-add.tpl');

        break;

    case 'users-edit':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        $ui->assign('_application_menu', 'dashboard');

        $id = $routes['2'];
        $d = ORM::for_table('sys_users')->find_one($id);
        if ($d) {
            $ui->assign('xheader', Asset::css(['imgcrop/assets/css/croppic']));

            $ui->assign(
                'xfooter',
                Asset::js(['imgcrop/croppic', 'jslib/admin_profile'])
            );

            $ui->assign('d', $d);

            $roles = Model::factory('Models_Role')->find_array();
            $ui->assign('roles', $roles);

            $ui->display('users-edit.tpl');
        } else {
            r2(U . 'settings/users', 'e', $_L['Account_Not_Found']);
        }

        break;

    case 'users-delete':
        $id = $routes['2'];
        //prevent self delete
        if ($user['id'] == $id) {
            r2(U . 'settings/users', 'e', 'Sorry You can\'t delete yourself');
        }
        $d = ORM::for_table('sys_users')->find_one($id);
        if ($d) {
            $d->delete();
            r2(U . 'settings/users', 's', 'User deleted Successfully');
        } else {
            r2(U . 'settings/users', 'e', $_L['Account_Not_Found']);
        }

        break;

    case 'users-post':
        $username = _post('username');
        $fullname = _post('fullname');
        $password = _post('password');
        $cpassword = _post('cpassword');
        $user_type = _post('user_type');

        $r = Model::factory('Models_Role')->find_one($user_type);

        if ($r) {
            $role = $r->rname;
            $roleid = $user_type;
            $user_type = $r->rname;
        } else {
            $role = '';
            $roleid = 0;
            $user_type = 'Admin';
        }

        $msg = '';
        if (Validator::Email($username) == false) {
            $msg .= $_L['notice_email_as_username'] . '<br>';
        }
        if (Validator::Length($fullname, 26, 2) == false) {
            $msg .= 'Full Name should be between 3 to 25 characters' . '<br>';
        }
        if (!Validator::Length($password, 15, 5)) {
            $msg .= 'Password should be between 6 to 15 characters' . '<br>';
        }
        if ($password != $cpassword) {
            $msg .= 'Passwords does not match' . '<br>';
        }
        //check with same name account is exist
        $d = ORM::for_table('sys_users')
            ->where('username', $username)
            ->find_one();
        if ($d) {
            $msg .= $_L['account_already_exist'] . '<br>';
        }

        // create Roles

        if ($msg == '') {
            $password = Password::_crypt($password);
            // Add Account
            $d = ORM::for_table('sys_users')->create();
            $d->username = $username;
            $d->password = $password;
            $d->fullname = $fullname;
            $d->user_type = $user_type;

            //others
            $d->phonenumber = '';
            $d->last_login = date('Y-m-d H:i:s');
            $d->email = '';
            $d->creationdate = date('Y-m-d H:i:s');
            $d->pin = '';
            $d->img = '';
            $d->otp = 'No';
            $d->pin_enabled = 'No';
            $d->api = 'No';
            $d->pwresetkey = '';
            $d->keyexpire = '';
            $d->status = 'Active';
            $d->role = $role;
            $d->roleid = $roleid;

            //

            $d->save();
            r2(U . 'settings/users', 's', $_L['account_created_successfully']);
        } else {
            r2(U . 'settings/users-add', 'e', $msg);
        }

        break;

    case 'users-edit-post':
        $username = _post('username');
        $fullname = _post('fullname');
        $img = _post('picture');
        $password = _post('password');
        $cpassword = _post('cpassword');

        $msg = '';

        if (Validator::Email($username) == false) {
            $msg .= 'Please use a valid Email address as Username' . '<br>';
        }
        if (Validator::Length($fullname, 26, 2) == false) {
            $msg .= 'Full Name should be between 3 to 25 characters' . '<br>';
        }
        if ($password != '') {
            if (!Validator::Length($password, 15, 5)) {
                $msg .=
                    'Password should be between 6 to 15 characters' . '<br>';
            }
            if ($password != $cpassword) {
                $msg .= 'Passwords does not match' . '<br>';
            }
        }
        //find this user
        $id = _post('id');
        $d = ORM::for_table('sys_users')->find_one($id);
        if ($d) {
        } else {
            $msg .= 'Username Not Found' . '<br>';
        }
        //check with same name account is exist
        if ($d['username'] != $username) {
            $c = ORM::for_table('sys_users')
                ->where('username', $username)
                ->find_one();
            if ($c) {
                $msg .= $_L['account_already_exist'] . '<br>';
            }
        }

        if ($_app_stage == 'Demo') {
            $msg .= 'Editing User is disabled in the Demo Mode!' . '<br>';
        }

        $user_type = _post('user_type');

        $r = Model::factory('Models_Role')->find_one($user_type);

        if ($r) {
            $role = $r->rname;
            $roleid = $user_type;
            $user_type = $r->rname;
        } else {
            $role = '';
            $roleid = 0;
            $user_type = 'Admin';
        }

        if ($msg == '') {
            // Add Account

            $d->username = $username;
            if ($password != '') {
                $password = Password::_crypt($password);
                $d->password = $password;
            }

            $d->fullname = $fullname;
            if ($user['id'] != $id) {
                $d->user_type = $user_type;
            }

            $d->img = $img;

            $d->role = $role;
            $d->roleid = $roleid;

            $d->save();
            r2(
                U . 'settings/users-edit/' . $id,
                's',
                'User Updated Successfully'
            );
        } else {
            r2(U . 'settings/users-edit/' . $id, 'e', $msg);
        }

        break;

    case 'app-post':
        if ($_app_stage == 'xDemo') {
            r2(
                U . 'settings/app',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }
        $company = _post('company');

        $pdf_font = _post('pdf_font');
        if ($company == '') {
            r2(U . 'settings/app', 'e', $_L['All Fields are Required']);
        }

        //check if email is posted as smtp

        if ($_app_stage == 'Demo') {
            r2(U . 'settings/app', 'e', $_L['disabled_in_demo']);
        } else {
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'CompanyName')
                ->find_one();
            $d->value = $company;
            $d->save();

            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'pdf_font')
                ->find_one();
            $d->value = $pdf_font;
            $d->save();

            $caddress = $_POST['caddress'];
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'caddress')
                ->find_one();
            $d->value = $caddress;
            $d->save();

            $invoice_terms = $_POST['invoice_terms'];
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'invoice_terms')
                ->find_one();
            $d->value = $invoice_terms;
            $d->save();

            $i_driver = $_POST['i_driver'];
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'i_driver')
                ->find_one();
            $d->value = $i_driver;
            $d->save();

            // default_landing_page v 4.1

            $default_landing_page = $_POST['default_landing_page'];
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'default_landing_page')
                ->find_one();
            $d->value = $default_landing_page;
            $d->save();

            $dashboard = $_POST['dashboard'];
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'dashboard')
                ->find_one();
            $d->value = $dashboard;
            $d->save();

            //            $contentAnimation = $_POST['contentAnimation'];
            //
            //            update_option('contentAnimation',$contentAnimation);

            //set invoice numbering

            $iai = _post('iai');

            if ($iai != '' and is_numeric($iai)) {
                //check it's bigger then current
                $tblsts = ORM::for_table('sys_invoices')
                    ->raw_query("show table status like 'sys_invoices'")
                    ->find_one();
                $ai = $tblsts['Auto_increment'];
                if ($ai < $iai) {
                    $set_ai = ORM::for_table('sys_invoices')->raw_execute(
                        "ALTER TABLE sys_invoices auto_increment = $iai"
                    );
                }
            }

            r2(U . 'settings/app', 's', $_L['Settings Saved Successfully']);
        }

        break;

    case 'eml-post':
        if ($_app_stage == 'Demo') {
            r2(U . 'settings/emls/', 'e', $_L['disabled_in_demo']);
        }

        $sysemail = _post('sysemail');
        if (Validator::Email($sysemail) == false) {
            r2(U . 'settings/emls/', 'e', $_L['Invalid System Email']);
        }

        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'sysEmail')
            ->find_one();
        $d->value = $sysemail;
        $d->save();
        $email_method = _post('email_method');
        $e = ORM::for_table('sys_emailconfig')->find_one('1');
        if ($email_method == 'smtp') {
            $smtp_user = _post('smtp_user');
            $smtp_host = _post('smtp_host');
            $smtp_password = _post('smtp_password');
            $smtp_port = _post('smtp_port');
            $smtp_secure = _post('smtp_secure');
            if (
                $smtp_user == '' or
                $smtp_password == '' or
                $smtp_port == '' or
                $smtp_host == ''
            ) {
                r2(U . 'settings/emls/', 'e', $_L['smtp_fields_error']);
            } else {
                $e->method = 'smtp';
                $e->host = $smtp_host;
                $e->username = $smtp_user;
                $e->password = $smtp_password;
                $e->apikey = '';
                $e->port = $smtp_port;
                $e->secure = $smtp_secure;
            }
        } else {
            //  $e->method = 'phpmail';
            // From v 4.5
            $e->method = $email_method;
        }
        $e->save();
        r2(U . 'settings/emls/', 's', $_L['Settings Saved Successfully']);

        break;

    case 'lc-post':
        if ($_app_stage == 'Demo') {
            r2(
                U . 'settings/localisation/',
                'e',
                'Sorry! This option is disabled in the demo mode!'
            );
        }

        $tzone = _post('tzone');
        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'timezone')
            ->find_one();
        $d->value = $tzone;
        $d->save();

        $country = _post('country');
        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'country')
            ->find_one();
        $d->value = $country;
        $d->save();

        $cformat = _post('cformat');

        if ($cformat == '1') {
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'dec_point')
                ->find_one();
            $d->value = '.';
            $d->save();
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'thousands_sep')
                ->find_one();
            $d->value = '';
            $d->save();
        } elseif ($cformat == '2') {
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'dec_point')
                ->find_one();
            $d->value = '.';
            $d->save();
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'thousands_sep')
                ->find_one();
            $d->value = ',';
            $d->save();
        } elseif ($cformat == '3') {
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'dec_point')
                ->find_one();
            $d->value = ',';
            $d->save();
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'thousands_sep')
                ->find_one();
            $d->value = '';
            $d->save();
        } elseif ($cformat == '4') {
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'dec_point')
                ->find_one();
            $d->value = ',';
            $d->save();
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'thousands_sep')
                ->find_one();
            $d->value = '.';
            $d->save();
        } else {
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'dec_point')
                ->find_one();
            $d->value = '.';
            $d->save();
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'thousands_sep')
                ->find_one();
            $d->value = ',';
            $d->save();
        }

        $currency_code = $_POST['currency_code'];

        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'currency_code')
            ->find_one();
        $d->value = $currency_code;
        $d->save();

        //        $d = ORM::for_table('sys_appconfig')->where('setting','rtl')->find_one();
        //        $d->value = $rtl;
        //        $d->save();

        $lan = _post('lan');
        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'language')
            ->find_one();
        $d->value = $lan;
        $d->save();

        update_option('momentLocale', Ib_I18n::momentLocale($lan));

        $df = _post('df');

        update_option('df', $df);

        $home_currency = _post('home_currency');
        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'home_currency')
            ->find_one();
        $d->value = $home_currency;
        $d->save();

        $currency_decimal_digits = _post('currency_decimal_digits');
        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'currency_decimal_digits')
            ->find_one();
        $d->value = $currency_decimal_digits;
        $d->save();

        $currency_symbol_position = _post('currency_symbol_position');
        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'currency_symbol_position')
            ->find_one();
        $d->value = $currency_symbol_position;
        $d->save();

        $thousand_separator_placement = _post('thousand_separator_placement');
        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'thousand_separator_placement')
            ->find_one();
        $d->value = $thousand_separator_placement;
        $d->save();

        // reload lagnuage file

        r2(U . 'settings/localisation/');

        break;

    case 'lc-charset-post':
        $coll = _post('coll');
        $chars = explode('_', $coll);
        $chars_name = $chars[0];
        //echo $chars_name;
        //
        //exit;

        $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_name);

        if (!$mysqli->error) {
            $sql = "SHOW TABLES";
            $show = $mysqli->query($sql);
            while ($r = $show->fetch_array()) {
                $tables[] = $r[0];
            }

            if (!empty($tables)) {
                foreach ($tables as $table) {
                    // $result     = $mysqli->query('SELECT * FROM '.$table);
                    $result = $mysqli->query(
                        'ALTER TABLE ' .
                            $table .
                            " CONVERT TO CHARACTER SET $chars_name COLLATE $coll"
                    );
                    //   echo $table;
                }
            } else {
                //     $result = '<p>Error when executing database query to export.</p>'.$mysqli->error;
            }
        }

        r2(
            U . 'settings/localisation/',
            's',
            $_L['Charset Saved Successfully']
        );
        break;

    case 'change-password':
        $ui->assign('_application_menu', 'dashboard');
        $ui->display('change-password.tpl');

        break;

    case 'change-password-post':
        $password = _post('password');
        if ($password != '') {
            $d = ORM::for_table('sys_users')
                ->where('username', $user['username'])
                ->find_one();
            if ($d) {
                $d_pass = $d['password'];
                if (Password::_verify($password, $d_pass) == true) {
                    $npass = _post('npass');
                    $cnpass = _post('cnpass');
                    if (!Validator::Length($npass, 15, 5)) {
                        r2(
                            U . 'settings/change-password',
                            'e',
                            $_L['password_length_error']
                        );
                    }
                    if ($npass != $cnpass) {
                        r2(
                            U . 'settings/change-password',
                            'e',
                            $_L['Both Password should be same']
                        );
                    }

                    if ($_app_stage == 'Demo') {
                        r2(
                            U . 'settings/change-password',
                            'e',
                            $_L['disabled_in_demo']
                        );
                    }
                    $npass = Password::_crypt($npass);
                    $d->password = $npass;
                    $d->save();
                    _msglog('s', $_L['Password changed successfully']);

                    r2(U . 'login');
                } else {
                    r2(
                        U . 'settings/change-password',
                        'e',
                        $_L['Incorrect Current Password']
                    );
                }
            } else {
                r2(
                    U . 'settings/change-password',
                    'e',
                    $_L['Incorrect Current Password']
                );
            }
        } else {
            r2(
                U . 'settings/change-password',
                'e',
                $_L['Incorrect Current Password']
            );
        }

        break;

    case 'networth_goal':
        $goal = _post('goal');

        $goal = Finance::amount_fix($goal);

        if (is_numeric($goal) and $goal != '') {
            $d = ORM::for_table('sys_appconfig')
                ->where('setting', 'networth_goal')
                ->find_one();
            $d->value = $goal;
            $d->save();
            _msglog('s', $_L['New Goal has been set']);
        } else {
            _msglog('e', $_L['Invalid Number']);
        }

        break;

    case 'email-templates':
        $d = ORM::for_table('sys_email_templates')->find_many();
        $ui->assign('d', $d);
        $ui->assign(
            'xheader',
            '
<link rel="stylesheet" type="text/css" href="' .
                APP_URL .
                '/ui/lib/sn/summernote.css"/>
<link rel="stylesheet" type="text/css" href="' .
                APP_URL .
                '/ui/lib/sn/summernote-bs3.css"/>
<link rel="stylesheet" type="text/css" href="' .
                $_theme .
                '/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="' .
                APP_URL .
                '/ui/lib/sn/summernote-application.css"/>
'
        );
        $ui->assign(
            'xfooter',
            '
 <script type="text/javascript" src="' .
                $_theme .
                '/lib/modal.js"></script>
  <script type="text/javascript" src="' .
                APP_URL .
                '/ui/lib/sn/summernote.min.js"></script>
 <script type="text/javascript" src="' .
                APP_URL .
                '/ui/lib/jslib/email-templates.js"></script>
'
        );
        $ui->display('email-templates.tpl');
        break;

    case 'email-templates-view':
        $sid = $routes['2'];
        $d = ORM::for_table('sys_email_templates')->find_one($sid);
        if ($d) {
            $ui->assign('d', $d);

            $s_yes = '';
            $s_no = '';
            if ($d['send'] == 'No') {
                $s_no = 'selected="selected"';
            }

            if ($d['send'] == 'Yes') {
                $s_yes = 'selected="selected"';
            }

            echo '
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3>' .
                ib_lan_get_line($d['tplname']) .
                '</h3>
</div>
<div class="modal-body">

<form class="form-horizontal" role="form" id="edit_form" method="post">

<div class="form-group">
    <label for="subject" class="col-sm-2 control-label">' .
                $_L['Subject'] .
                '</label>
    <div class="col-sm-10">
      <input type="text" id="subject" name="subject" class="form-control" value="' .
                $d['subject'] .
                '">
    </div>
  </div>


   <div class="form-group">
    <label for="message" class="col-sm-2 control-label">' .
                $_L['Message Body'] .
                '</label>
    <div class="col-sm-10">
      <textarea id="message" name="message" class="form-control sysedit" rows="10">' .
                $d['message'] .
                '</textarea>
      <input type="hidden" id="sid" name="id" value="' .
                $d['id'] .
                '">
    </div>
  </div>
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">' .
                $_L['Send'] .
                '</label>
    <div class="col-sm-10">
      <select name="send" id="send" class="form-control">
                              <option value="Yes" ' .
                $s_yes .
                '>' .
                $_L['Yes'] .
                '</option>
                              <option value="No" ' .
                $s_no .
                '>' .
                $_L['No'] .
                '</option>

                          </select>
    </div>
  </div>
</form>

</div>
<div class="modal-footer">
	<button id="update" class="btn btn-primary">' .
                $_L['Save'] .
                '</button>

		<button type="button" data-dismiss="modal" class="btn">' .
                $_L['Close'] .
                '</button>
</div>';
        } else {
            exit('Template Not Found');
        }

        break;

    case 'update-email-template':
        $id = _post('id');
        $d = ORM::for_table('sys_email_templates')->find_one($id);
        if ($_app_stage == 'Demo') {
            echo 'Sorry! This option is disabled in the demo mode!';
            exit();
        }
        if ($d) {
            $message = $_POST['message'];
            $subject = $_POST['subject'];
            $send = _post('send');
            if ($message == '' or $subject == '') {
                echo 'Invalid Data';
            } else {
                $d->subject = $subject;
                $d->send = $send;
                $d->message = $message;

                $d->save();
                echo 'Data Updated';
            }
        } else {
            echo 'Sorry Data not Found';
        }

        break;

    case 'tags':
        $ui->assign('content_inner', inner_contents($config['c_cache']));

        $d = ORM::for_table('sys_tags')->find_many();
        $ui->assign('d', $d);

        $ui->assign(
            'xjq',
            '
$(".cdelete").click(function (e) {
        e.preventDefault();
        var id = this.id;
        bootbox.confirm("' .
                $_L['are_you_sure'] .
                '", function(result) {
           if(result){
               var _url = $("#_url").val();
               window.location.href = _url + "delete/tags/" + id;
           }
        });
    });

 '
        );

        $ui->display('tags.tpl');

        break;

    case 'logo-post':
        if ($_app_stage == 'Demo') {
            r2(U . 'appearance/customize/', 'e', $_L['disabled_in_demo']);
        }
        $validextentions = ["jpeg", "jpg", "png"];
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        $file_name = '';
        if ($_FILES["file"]["type"] == "image/png") {
            $file_name = 'logo-tmp.png';
        } elseif ($_FILES["file"]["type"] == "image/jpg") {
            $file_name = 'logo-tmp.jpg';
        } elseif ($_FILES["file"]["type"] == "image/jpeg") {
            $file_name = 'logo-tmp.jpeg';
        } elseif ($_FILES["file"]["type"] == "image/gif") {
            $file_name = 'logo-tmp.gif';
        } else {
        }
        if (
            ($_FILES["file"]["type"] == "image/png" ||
                $_FILES["file"]["type"] == "image/jpg" ||
                $_FILES["file"]["type"] == "image/jpeg") &&
            $_FILES["file"]["size"] < 1000000 && //approx. 100kb files can be uploaded
            in_array($file_extension, $validextentions)
        ) {
            move_uploaded_file(
                $_FILES["file"]["tmp_name"],
                'application/storage/system/' . $file_name
            );
            $image = new Image();
            $image->source_path = 'application/storage/system/' . $file_name;
            $image->target_path = 'application/storage/system/logo.png';
            // $image->resize('0','40',ZEBRA_IMAGE_BOXED,'-1');
            $image->resize(0, 0, ZEBRA_IMAGE_BOXED, '-1');

            //now delete the tmp image

            unlink('application/storage/system/' . $file_name);

            //            r2(U.'settings/app','s',$_L['Settings Saved Successfully']);

            r2(
                U . 'appearance/customize/',
                's',
                $_L['Settings Saved Successfully']
            );
        } else {
            r2(U . 'appearance/customize/', 'e', $_L['Invalid Logo File']);
        }

        break;

    case 'localisation':
        $ui->assign('content_inner', inner_contents($config['c_cache']));

        $tblsts = ORM::for_table('crm_accounts')
            ->raw_query("show table status like 'crm_accounts'")
            ->find_one();
        $col = $tblsts['Collation'];
        $ui->assign('col', $col);

        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }
        $ui->assign('countries', Countries::all($config['country'])); // may add this $config['country_code']
        $timezonelist = Timezone::timezoneList();
        $ui->assign('tlist', $timezonelist);

        $ui->assign('currencies', Currency::list_all('array'));

        $ui->assign('languages', IBilling_I18n::get_languages());

        $ui->assign('xheader', Asset::css(['s2/css/select2.min']));
        $ui->assign(
            'xfooter',
            Asset::js(['s2/js/select2.min', 's2/js/i18n/' . lan(), 'locale'])
        );

        $ui->assign('xjq', '');

        $ui->display('localisation.tpl');

        break;

    case 'emls':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        //find email settings

        $e = ORM::for_table('sys_emailconfig')->find_one('1');
        $ui->assign('e', $e);

        $ui->assign(
            'xjq',
            '

        function _check_e_method(){
        var emethod = $( "#email_method" ).val();
        if(emethod == "smtp"){
         
          $("#a_hide").show();
        }
        else{
        $("#a_hide").hide();
        }
        }
_check_e_method();
$( "#email_method" ).change(function() {
 _check_e_method();
});
 '
        );

        $ui->display('emls.tpl');

        break;

    case 'automation':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        $cs = ORM::for_table('sys_schedule')->find_many();
        foreach ($cs as $rcs) {
            $arcs[$rcs['cname']] = $rcs['val'];
        }
        $ui->assign('arcs', $arcs);

        //        $ui->assign('xheader', '
        //<link rel="stylesheet" type="text/css" href="ui/lib/bootstrap-switch/bootstrap-switch.css"/>
        //');
        //        $ui->assign('xfooter', '
        //<script type="text/javascript" src="ui/lib/bootstrap-switch/bootstrap-switch.min.js"></script>
        //');
        //
        //        $ui->assign('xjq', '
        //            $(".sys_csw").bootstrapSwitch();
        // ');

        $ui->display('automation.tpl');

        break;

    case 'pg':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        if ($user['user_type'] != 'Admin') {
            r2(U . "dashboard", 'e', $_L['You do not have permission']);
        }

        $d = ORM::for_table('sys_pg')
            ->order_by_asc('sorder')
            ->find_many();
        $ui->assign('d', $d);

        //        $ui->assign('xheader', Asset::css(array('s2/css/select2.min')));
        //        $ui->assign('xfooter', Asset::js(array('s2/js/select2.min','s2/js/i18n/'.lan())));

        $ui->display('pg.tpl');

        break;

    case 'pg-conf':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        $pg = $routes['2'];
        $d = ORM::for_table('sys_pg')->find_one($pg);
        if ($d) {
            $label = [];

            $label['value'] = 'Value';
            $label['c1'] = '';
            $label['c2'] = '';
            $label['c3'] = '';
            $label['c4'] = '';
            $label['c5'] = '';
            $label['mode'] = false;

            $input = [];

            $input['value'] =
                '<input type="text" class="form-control" id="value" name="value" value="' .
                $d['value'] .
                '">';
            $input['c1'] =
                '<input type="text" class="form-control" id="c1" name="c1" value="' .
                $d['c1'] .
                '">';
            $input['c2'] =
                '<input type="text" class="form-control" id="c2" name="c2" value="' .
                $d['c2'] .
                '">';
            $input['c3'] =
                '<input type="text" class="form-control" id="c3" name="c3" value="' .
                $d['c3'] .
                '">';
            $input['c4'] =
                '<input type="text" class="form-control" id="c4" name="c4" value="' .
                $d['c4'] .
                '">';
            $input['c5'] =
                '<input type="text" class="form-control" id="c5" name="c5" value="' .
                $d['c5'] .
                '">';

            $help_txt = [];

            $help_txt['value'] = '';
            $help_txt['c1'] = '';
            $help_txt['c2'] = '';
            $help_txt['c3'] = '';
            $help_txt['c4'] = '';
            $help_txt['c5'] = '';
            $help_txt['mode'] = '';

            $extra_panel = '';

            $processor = $d->processor;

            switch ($processor) {
                case 'paypal':
                    $label['value'] = 'Paypal Email';
                    $label['c1'] = $_L['Currency Code'];
                    $label['c2'] = 'Conversion Rate';

                    break;

                case 'stripe':
                    $label['value'] = 'Publishable key';
                    $label['c1'] = 'Secret key';
                    $label['c2'] = $_L['Currency Code'];

                    break;

                case 'authorize_net':
                    $label['value'] = 'API Login ID';
                    $label['c1'] = 'Transaction Key';

                    break;

                case 'manualpayment':
                    $input['value'] =
                        '<textarea id="value" class="form-control" rows="3">' .
                        $d['value'] .
                        '</textarea>';

                    $label['value'] = 'Payment Instructions';

                    break;

                case 'braintree':
                    $label['value'] = 'Your Merchant ID';
                    $label['c1'] = $_L['Public Key'];
                    $label['c2'] = $_L['Private Key'];
                    $label['c3'] = $_L['Default Account'];
                    $label['c4'] = $_L['live or sandbox'];

                    break;

                case 'ccavenue':
                    $label['value'] = 'Merchant ID';
                    $label['c1'] = 'Working Key';
                    $label['c2'] = 'Currency ISO Code';
                    $label['c3'] = 'Access Code';

                    break;

                default:
                    $label['value'] = 'Value';
            }

            $ui->assign('label', $label);
            $ui->assign('input', $input);
            $ui->assign('help_txt', $help_txt);
            $ui->assign('extra_panel', $extra_panel);

            Event::trigger('settings/pg_conf/label', [$processor]);

            $ui->assign(
                'xfooter',
                '
<script type="text/javascript" src="' .
                    $_theme .
                    '/lib/pg.js"></script>
'
            );
            $ui->assign('d', $d);
            $ui->display('pg-conf.tpl');
        } else {
            echo 'PG Not Found';
        }

        break;

    case 'pg-post':
        if ($_app_stage == 'Demo') {
            r2(U . 'settings/app', 'e', $_L['disabled_in_demo']);
        }
        $pg = _post('pgid');

        $d = ORM::for_table('sys_pg')->find_one($pg);
        if ($d) {
            $name = _post('name');
            if ($name == '') {
                _msglog('e', $_L['name_error']);
                echo $pg;
                exit();
            }
            $d->name = $name;
            //  $d->settings = _post('settings');
            $d->value = _post('value');
            $d->status = _post('status');
            $d->c1 = _post('c1');
            $d->c2 = _post('c2');
            $d->c3 = _post('c3');
            $d->c4 = _post('c4');
            $d->c5 = _post('c5');
            $d->mode = _post('mode');
            $d->save();
            _msglog('s', $_L['Data Updated']);
            echo $pg;
        } else {
            echo 'PG Not Found';
        }

        break;

    case 'add-tax':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        $ui->display('add-tax.tpl');
        break;

    case 'add-tax-post':
        if ($_app_stage == 'Demo') {
            r2(U . 'settings/app', 'e', $_L['disabled_in_demo']);
        }
        $taxname = _post('taxname');
        $taxrate = _post('taxrate');
        $taxrate = Finance::amount_fix($taxrate);
        if ($taxname == '' or $taxrate == '') {
            r2(U . 'settings/add-tax/', 'e', $_L['All Fields are Required']);
        }
        if (!is_numeric($taxrate)) {
            r2(U . 'settings/add-tax/', 'e', $_L['Invalid TAX Rate']);
        }

        $d = ORM::for_table('sys_tax')->create();
        $d->name = $taxname;
        $d->rate = $taxrate;
        $d->state = '';
        $d->country = '';
        $d->aid = '1';

        $d->save();
        r2(U . 'tax/list/', 's', $_L['New TAX Added']);
        break;

    case 'edit-tax':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        $tid = $routes['2'];
        $d = ORM::for_table('sys_tax')->find_one($tid);
        if ($d) {
            $ui->assign(
                'xfooter',
                '
<script type="text/javascript" src="' .
                    $_theme .
                    '/lib/numeric.js"></script>
'
            );

            $ui->assign('d', $d);

            $ui->assign('ib_money_format_apply', true);

            Event::trigger('settings/edit-tax/');

            $ui->display('edit-tax.tpl');
        } else {
            r2(U . 'tax/list/', 'e', $_L['TAX Not Found']);
        }

        break;

    case 'edit-tax-post':
        if ($_app_stage == 'Demo') {
            r2(U . 'settings/app', 'e', $_L['disabled_in_demo']);
        }
        $tid = _post('tid');
        $d = ORM::for_table('sys_tax')->find_one($tid);
        if ($d) {
            $taxname = _post('taxname');
            $taxrate = _post('taxrate');
            $taxrate = Finance::amount_fix($taxrate);
            if ($taxname == '' or $taxrate == '') {
                r2(
                    U . 'settings/edit-tax/' . $tid . '/',
                    'e',
                    'All Fields is Required.'
                );
            }
            if (!is_numeric($taxrate)) {
                r2(
                    U . 'settings/edit-tax/' . $tid . '/',
                    'e',
                    'Invalid TAX Rate.'
                );
            }

            $d->name = $taxname;
            $d->rate = $taxrate;
            $d->save();
            r2(U . 'settings/edit-tax/' . $tid . '/', 's', 'TAX Saved.');
        } else {
            r2(U . 'tax/list/', 'e', $_L['TAX Not Found']);
        }

        break;

    case 'consolekey_regen':
        $nkey = _raid('10');

        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'ckey')
            ->find_one();
        $d->value = $nkey;
        $d->save();
        r2(U . 'settings/automation/', 's', $_L['cron_new_key']);
        break;

    case 'automation-post':
        $accounting_snapshot = _post('accounting_snapshot');
        $d = ORM::for_table('sys_schedule')
            ->where('cname', 'accounting_snapshot')
            ->find_one();
        if ($accounting_snapshot == 'on') {
            $d->val = 'Active';
        } else {
            $d->val = 'Inactive';
        }
        $d->save();

        $recurring_invoice = _post('recurring_invoice');
        $d = ORM::for_table('sys_schedule')
            ->where('cname', 'recurring_invoice')
            ->find_one();
        if ($recurring_invoice == 'on') {
            $d->val = 'Active';
        } else {
            $d->val = 'Inactive';
        }
        $d->save();

        $notify = _post('notify');
        $notifyemail = _post('notifyemail');
        if ($notify == 'on') {
            //need valid notify email
            if (Validator::Email($notifyemail) == false) {
                r2(U . 'settings/automation/', 'e', $_L['cron_notification']);
            }
        }
        $d = ORM::for_table('sys_schedule')
            ->where('cname', 'notify')
            ->find_one();
        if ($notify == 'on') {
            $d->val = 'Active';
        } else {
            $d->val = 'Inactive';
        }
        $d->save();

        $d = ORM::for_table('sys_schedule')
            ->where('cname', 'notifyemail')
            ->find_one();
        $d->val = $notifyemail;
        $d->save();

        r2(U . 'settings/automation/', 's', $_L['Settings Saved Successfully']);
        break;

    case 'plugins':
        $Parsedown = new Parsedown();

        $core_plugins = require 'system/data/core_plugins.php';

        $ui->assign('_application_menu', 'plugins');

        $ui->assign('content_inner', inner_contents($config['c_cache']));
        $ui->assign(
            'xheader',
            '
<link rel="stylesheet" type="text/css" href="' .
                APP_URL .
                '/ui/lib/dropzone/dropzone.css"/>
'
        );
        $ui->assign(
            'xfooter',
            '
<script type="text/javascript" src="' .
                APP_URL .
                '/ui/lib/dropzone/dropzone.js"></script>
'
        );

        $pls = array_diff(scandir('apps'), ['..', '.', 'index.html']);
        $pl_html = '';
        foreach ($pls as $pl) {
            $pl_path = 'apps/' . $pl . '/';
            $i = 0;
            if (file_exists($pl_path . '/manifest.php')) {
                $i++;
                //

                $plugin = null;

                require $pl_path . '/manifest.php';

                $d = ORM::for_table('sys_pl')
                    ->where('c', $pl)
                    ->find_one();
                $btn = '';
                if ($d) {
                    //plugin was installed & active
                    $status = $d['status'];
                    if ($status == '1') {
                        $btn .=
                            ' <a href="' .
                            U .
                            'settings/plugin_deactivate/' .
                            $pl .
                            '/" class="btn btn-danger btn-sm cdelete"><i class="fa fa-minus-square-o"></i> Deactivate </a>';
                    } else {
                        $btn .=
                            ' <a href="' .
                            U .
                            'settings/plugin_activate/' .
                            $pl .
                            '/" class="btn btn-info btn-sm"><i class="fa fa-check"></i> Activate </a>';
                        $btn .=
                            ' <a href="' .
                            U .
                            'settings/plugin_uninstall/' .
                            $pl .
                            '/" class="btn btn-danger btn-sm c_uninstall"><i class="fa fa-remove"></i> Uninstall </a>';
                    }

                    // check for update

                    $db_build = $d->build;

                    if (
                        isset($plugin['build']) &&
                        $plugin['build'] > $db_build
                    ) {
                        // add update button

                        $btn .=
                            ' <a href="' .
                            U .
                            'settings/plugin_update/' .
                            $pl .
                            '/" class="btn btn-info btn-sm"><i class="fa fa-tasks"></i> Update </a>';
                    }
                } else {
                    //plugin need to be installed
                    $btn .=
                        ' <a href="' .
                        U .
                        'settings/plugin_install/' .
                        $pl .
                        '/" class="btn btn-primary btn-sm cedit"><i class="fa fa-hdd-o"></i> Install </a>';
                    $btn .=
                        ' <a href="' .
                        U .
                        'settings/plugin_delete/' .
                        $pl .
                        '/" class="btn btn-danger btn-sm cdelete"><i class="fa fa-trash"></i> Delete </a>';
                }

                $icon_url = APP_URL . '/storage/system/plug.png';

                if (file_exists($pl_path . '/views/img/icon.png')) {
                    $icon_url =
                        APP_URL . '/' . $pl_path . '/views/img/icon.png';
                }

                // check for update

                $pl_html .=
                    ' <tr>
 <td>
 <img class="img-thumbnail" style="max-height: 64px;" src="' .
                    $icon_url .
                    '">
</td>

                <td class="project-title">
                    <a href="' .
                    $plugin['url'] .
                    '" class="cedit" target="_blank">' .
                    $plugin['name'] .
                    '</a>
                    <br>
                    <small>' .
                    $plugin['version'] .
                    '</small>
                </td>
                <td>

                   ' .
                    $Parsedown->text($plugin['description']) .
                    '

                </td>

                <td class="project-actions">

                  <span class="pull-right">' .
                    $btn .
                    '</span>

                </td>
            </tr>';
            }
        }

        if ($pl_html == '') {
            $pl_html =
                '<h4 class="text-center">' .
                $_L['No Plugins Available'] .
                '</h4>';
        }

        $ui->assign('pl_html', $pl_html);

        view('pl-list', [
            'core_plugins' => $core_plugins,
        ]);

        break;

    case 'plugin_upload':
        $uploader = new Uploader();
        $uploader->setDir('apps/');
        $uploader->sameName(true);
        $uploader->setExtensions(['zip']); //allowed extensions list//
        if ($uploader->uploadFile('file')) {
            //txtFile is the filebrowse element name //
            $uploaded = $uploader->getUploadName(); //get uploaded file name, renames on upload//
        } else {
            //upload failed
            _msglog('e', $uploader->getMessage()); //get upload error message
        }
        break;

    case 'plugin_unzip':
        $msg = '';
        $name = _post('name');
        if (class_exists('ZipArchive')) {
            $zip = new ZipArchive();

            $res = $zip->open('apps/' . $name);
            if ($res === true) {
                if ($_app_stage == 'Demo') {
                    $msg .=
                        $name .
                        ' - Plugin Unzipping is Disabled in the Demo Mode! <br>';
                } else {
                    $zip->extractTo('apps/');
                }

                if ($zip->close()) {
                    unlink('apps/' . $name);
                }
                //
            } else {
                $msg .=
                    $name .
                    ' - Invalid Plugin Package Or An error occured while unzipping the file! <br>';
            }
        } else {
            $msg .= 'PHP ZipArchive Class is not Available! <br>';
        }

        if ($msg != '') {
            _msglog('e', $msg);
        } else {
            _msglog('s', $_L['Plugin Added']);
        }

        break;

    case 'plugin_activate':
        define('IB_INTERNAL', true);

        if (isset($routes['2']) and $routes['2'] != '') {
            $pl = $routes['2'];
            $pl_path = 'apps/' . $pl . '/';

            $msg = '';
            $msg .= 'Activating Plugin...
';

            require $pl_path . '/manifest.php';

            if ($_app_stage == 'Demo') {
                $msg .= 'Sorry, Activating Plugin is disabled in the demo mode...
';
            } else {
                if (file_exists($pl_path . '/activate.php')) {
                    require $pl_path . '/activate.php';
                }

                $d = ORM::for_table('sys_pl')
                    ->where('c', $pl)
                    ->find_one();
                if ($d) {
                    $d->status = '1';

                    if (isset($plugin['build'])) {
                        $d->build = $plugin['build'];
                    }

                    $d->save();
                    $msg .= 'Plugin Activated...
';
                }
            }

            $ui->assign('plugin', $plugin);
            $ui->assign('plugin_activity', $_L['Activating Plugin']);
            $ui->assign('msg', $msg);

            $ui->display('plugin-activity.tpl');
        } else {
            echo 'Plugin not Found';
        }

        break;

    case 'plugin_deactivate':
        define('IB_INTERNAL', true);

        if (isset($routes['2']) and $routes['2'] != '') {
            $pl = $routes['2'];
            $pl_path = 'apps/' . $pl . '/';

            $msg = '';
            $msg .= 'Deactivating Plugin...
';

            require $pl_path . '/manifest.php';

            if ($_app_stage == 'Demo') {
                $msg .= 'Sorry, Deactivating Plugin is disabled in the demo mode...
';
            } else {
                if (file_exists($pl_path . '/deactivate.php')) {
                    require $pl_path . '/deactivate.php';
                }

                $d = ORM::for_table('sys_pl')
                    ->where('c', $pl)
                    ->find_one();
                if ($d) {
                    $d->status = '0';
                    $d->save();
                    $msg .= 'Plugin Deactivated...
';
                }
            }

            $ui->assign('plugin', $plugin);
            $ui->assign('plugin_activity', $_L['Deactivating Plugin']);
            $ui->assign('msg', $msg);
            $ui->display('plugin-activity.tpl');
        } else {
            echo 'Plugin not Found';
        }

        break;

    case 'plugin_install':
        define('IB_INTERNAL', true);

        if (isset($routes['2']) and $routes['2'] != '') {
            $pl = $routes['2'];

            $pl_path = 'apps/' . $pl . '/';
            $msg = '';
            $msg .= 'Installing Plugin...
';
            require $pl_path . '/manifest.php';

            if ($_app_stage == 'Demo') {
                $msg .= 'Sorry, Installing Plugin is disabled in the demo mode...
';
            } else {
                if (file_exists($pl_path . '/install.php')) {
                    require $pl_path . '/install.php';
                }

                $msg .= 'Adding Plugin to the Plugin Database
';

                $c = ORM::for_table('sys_pl')->create();
                $c->c = $pl;
                $c->status = 1;

                if (isset($plugin['priority'])) {
                    $c->sorder = $plugin['priority'];
                }

                // check build is exist

                if (isset($plugin['build'])) {
                    $c->build = $plugin['build'];
                } else {
                    $c->build = 1;
                }

                //

                $c->c1 = '';
                $c->c2 = '';

                $c->save();

                $msg .= 'Plugin Added
';
            }

            $ui->assign('plugin', $plugin);
            $ui->assign('plugin_activity', $_L['Installing Plugin']);
            $ui->assign('msg', $msg);
            $ui->display('plugin-activity.tpl');
        } else {
            echo 'Install Script not Found';
        }

        break;

    case 'plugin_uninstall':
        define('IB_INTERNAL', true);

        if (isset($routes['2']) and $routes['2'] != '') {
            $pl = $routes['2'];
            $pl_path = 'apps/' . $pl . '/';

            $msg = '';
            $msg .= 'Uninstalling Plugin...
';

            require $pl_path . '/manifest.php';

            if ($_app_stage == 'Demo') {
                $msg .= 'Sorry, Uninstalling Plugin is disabled in the demo mode...
';
            } else {
                if (file_exists($pl_path . '/uninstall.php')) {
                    require $pl_path . '/uninstall.php';
                }

                $msg .= 'Removing Plugin from Plugin Database...
';

                $d = ORM::for_table('sys_pl')
                    ->where('c', $pl)
                    ->find_one();
                if ($d) {
                    $d->delete();
                    $msg .= 'Plugin Uninstalled...
';
                }
            }

            $ui->assign('plugin', $plugin);
            $ui->assign('plugin_activity', $_L['Uninstalling Plugin']);
            $ui->assign('msg', $msg);
            $ui->display('plugin-activity.tpl');
        } else {
            echo 'Uninstall script not found';
        }

        break;

    case 'plugin_delete':
        define('IB_INTERNAL', true);

        if (isset($routes['2']) and $routes['2'] != '') {
            $pl = $routes['2'];
            $pl_path = 'apps/' . $pl . '/';

            $msg = '';
            $msg .= 'Deleting Plugin...
';

            require $pl_path . '/manifest.php';

            if ($_app_stage == 'Demo') {
                $msg .= 'Sorry, Deleting Plugin is disabled in the demo mode...
';
            } else {
                if (Sysfile::deleteDir($pl_path)) {
                    $msg .= 'Plugin Directory Deleted Successfully
';
                } else {
                    $msg .=
                        'An Error Occurred while Deleting Plugin Directory. You may Delete this Plugin Manually - ' .
                        $pl_path .
                        '
';
                }
            }

            $ui->assign('plugin', $plugin);
            $ui->assign('plugin_activity', 'Delete Plugin');
            $ui->assign('msg', $msg);
            $ui->display('plugin-activity.tpl');
        } else {
            echo 'Plugin not found';
        }

        break;

    case 'plugin_update':
        define('IB_INTERNAL', true);

        if (isset($routes[2]) and $routes[2] != '') {
            $pl = $routes['2'];

            $pl_path = 'apps/' . $pl . '/';
            $msg = '';
            $msg .= 'Updating Plugin...
';
            require $pl_path . '/manifest.php';

            if ($_app_stage == 'Demo') {
                $msg .= 'Sorry, Updating Plugin is disabled in the demo mode...
';
            } else {
                if (file_exists($pl_path . '/update.php')) {
                    require $pl_path . '/update.php';
                }

                $msg .= 'Checking Build...
';

                $d = ORM::for_table('sys_pl')
                    ->where('c', $pl)
                    ->find_one();
                if ($d) {
                    if (isset($plugin['build'])) {
                        $d->build = $plugin['build'];
                        $d->save();
                        $msg .=
                            'Build Updated to ' .
                            $plugin['build'] .
                            '
';
                    }
                }

                $msg .= 'done...
';
            }

            $ui->assign('plugin', $plugin);
            $ui->assign('plugin_activity', $_L['Installing Plugin']);
            $ui->assign('msg', $msg);
            $ui->display('plugin-activity.tpl');
        } else {
            echo 'Install Script not Found';
        }

        break;

    case 'customfields':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        $ui->assign(
            'xheader',
            '
<link rel="stylesheet" type="text/css" href="' .
                $_theme .
                '/css/modal.css"/>

'
        );
        $ui->assign(
            'xfooter',
            '
        <script type="text/javascript" src="' .
                $_theme .
                '/lib/modal.js"></script>
<script type="text/javascript" src="' .
                $_theme .
                '/lib/custom-fields.js"></script>

'
        );
        $cf = ORM::for_table('crm_customfields')
            ->where('ctype', 'crm')
            ->order_by_asc('id')
            ->find_many();

        $ui->assign('cf', $cf);

        $ui->display('customfields.tpl');

        break;

    case 'customfields-post':
        $fieldname = _post('fieldname');
        $fieldtype = _post('fieldtype');
        $description = _post('description');
        $validation = _post('validation');
        $options = _post('options');
        $showinvoice = _post('showinvoice');
        if ($showinvoice != 'Yes') {
            $showinvoice = 'No';
        }
        if ($fieldname != '') {
            $d = ORM::for_table('crm_customfields')->create();
            $d->fieldname = $fieldname;
            $d->fieldtype = $fieldtype;
            $d->description = $description;
            $d->regexpr = $validation;
            $d->fieldoptions = $options;
            $d->ctype = 'crm';
            $d->relid = 0;
            $d->adminonly = '';
            $d->required = '';
            $d->showorder = '';
            $d->showinvoice = $showinvoice;
            $d->sorder = '0';
            $d->save();

            echo $d->id();
        } else {
            echo 'Name is Required';
        }

        break;

    case 'customfields-ajax-add':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        $ui->display('ajax-add-custom-field.tpl');

        break;

    case 'customfields-ajax-edit':
        $id = $routes[2];
        $id = str_replace('f', '', $id);

        $d = ORM::for_table('crm_customfields')->find_one($id);
        if ($d) {
            $ui->assign('d', $d);
            $ui->display('ajax-edit-custom-field.tpl');
        } else {
            echo 'Not Found';
        }

        break;

    case 'customfield-edit-post':
        $id = _post('id');

        $fieldname = _post('fieldname');

        if ($fieldname == '') {
            ib_die('Name is Required');
        }

        $d = ORM::for_table('crm_customfields')->find_one($id);
        if ($d) {
            $fieldtype = _post('fieldtype');
            $description = _post('description');
            $validation = _post('validation');
            $options = _post('options');
            $showinvoice = _post('showinvoice');
            if ($showinvoice != 'Yes') {
                $showinvoice = 'No';
            }
            $d->fieldname = $fieldname;
            $d->fieldtype = $fieldtype;
            $d->description = $description;
            $d->regexpr = $validation;
            $d->fieldoptions = $options;
            $d->ctype = 'crm';
            $d->relid = 0;
            $d->adminonly = '';
            $d->required = '';
            $d->showorder = '';
            $d->showinvoice = $showinvoice;
            $d->sorder = '0';
            $d->save();
            echo $id;
        } else {
            echo 'Not Found';
        }

        break;

    case 'update_option':
        if ($_app_stage == 'Demo') {
            _msglog('e', 'Sorry, this option is disabled in the demo mode.');
            ib_close();
        }

        $opt = _post('opt');
        $val = _post('val');

        $m = route(2);

        if ($m != 'silent') {
            _msglog('s', $_L['Settings Saved Successfully']);
        }

        if (update_option($opt, $val)) {
            echo 'ok';
        } else {
            echo 'failed';
        }

        break;

    //    API Support from Version 3

    case 'api':
        $ui->assign('content_inner', inner_contents($config['c_cache']));
        $d = ORM::for_table('sys_api')->find_many();

        $ui->assign('d', $d);
        $ui->assign('api_url', APP_URL);

        $ui->display('api.tpl');

        break;

    case 'api_post':
        $label = _post('label');
        if ($label == '') {
            r2(U . 'settings/api/', 'e', 'Label is Required');
        } else {
            $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $string = '';
            $random_string_length = '40';
            for ($i = 0; $i < $random_string_length; $i++) {
                $string .= $characters[rand(0, strlen($characters) - 1)];
            }

            $d = ORM::for_table('sys_api')->create();
            $d->label = $label;
            $d->ip = '';
            $d->apikey = $string;
            $d->save();
            r2(U . 'settings/api/', 's', $_L['API Access Added']);
        }

        break;

    case 'api_delete':
        $id = $routes[2];
        $d = ORM::for_table('sys_api')->find_one($id);
        if ($d) {
            $d->delete();

            r2(U . "settings/api/", 's', $_L['delete_successful']);
        }

        break;

    case 'api_regen':
        $id = $routes[2];
        $d = ORM::for_table('sys_api')->find_one($id);
        if ($d) {
            $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $string = '';
            $random_string_length = '40';
            for ($i = 0; $i < $random_string_length; $i++) {
                $string .= $characters[rand(0, strlen($characters) - 1)];
            }

            $d->apikey = $string;
            $d->save();

            r2(U . "settings/api/", 's', 'API Key Updated');
        }

        break;

    case 'plugin_force_remove':
        $pl = $routes[3];

        $d = ORM::for_table('sys_pl')
            ->where('c', $pl)
            ->find_one();
        if ($d) {
            $d->delete();
            r2(U . "dashboard/", 's', 'Plugin Successfully Removed.');
        }

        r2(U . "dashboard/", 's', 'Plugin Not Found.');

        break;

    case 'activate_license':
        $ui->display('settings_activate_license.tpl');

        break;

    case 'activate_license_post':
        $fullname = _post('fullname');
        $email = _post('email');
        $purchase_code = _post('purchase_code');

        if ($fullname == '' || $email == '' || $purchase_code == '') {
            r2(
                U . 'settings/activate_license/',
                'e',
                'All Fields are Required.'
            );
        }

        if (Validator::Email($email) == false) {
            r2(U . 'settings/activate_license/', 'e', 'Invalid Email Address');
        }

        $arr = [
            'app_url' => APP_URL,
            'itemid' => 11021678,
            'fullname' => $fullname,
            'email' => $email,
            'purchase_code' => $purchase_code,
        ];

        $output = Syscurl::_post(
            'https://activate.cloudonex.com/ibilling.php',
            $arr
        );

        $data = json_decode($output);

        if (isset($data->{'status'})) {
            $status = $data->{'status'};

            $msg = $data->{'msg'};

            if ($status == 'Active') {
                $license_key = $data->{'license_key'};

                update_option('purchase_code', $purchase_code);

                // Force Cache to regenerate

                update_option('c_cache', $license_key);

                r2(U . 'dashboard/', 's', $msg);
            } else {
                r2(U . 'settings/activate_license/', 'e', $msg);
            }
        } else {
            r2(
                U . 'settings/activate_license/',
                'e',
                'An Error Occured, Please try again later.'
            );
        }

        break;

    case 'about':
        $ui->assign('app_stage', $_app_stage);
        $ui->assign('_st', $_L['About']);

        $ui->assign('xfooter', Asset::js(['progress', 'settings/about']));

        $ui->display('about.tpl');

        break;

    case 'add_purchase_code':
        $purchase_code = $_POST['purchase_code'];

        update_option('purchase_code', $purchase_code);

        echo 'Purchase Code Saved.' . PHP_EOL;

        break;

    case 'check_update_post':
        $purchase_code = $_POST['purchase_code'];

        //        if($purchase_code == ''){
        //
        //            ib_die('Please Add and Save a Purchase Code to Check Update');
        //
        //        }

        update_option('purchase_code', $purchase_code);

        $arr = [
            'app_url' => APP_URL,
            'item_id' => 11021678,
            'fullname' => $user->fullname,
            'email' => $user->username,
            'build' => $config['build'],
            'purchase_code' => $purchase_code,
        ];

        $remote_build = '';
        $changelog = '';
        $update_available = 'No';
        $msg = '';

        $raw = '';

        try {
            $raw = ib_http_request(
                $update_server . 'envato/jsonapi/version_check/',
                'POST',
                $arr
            );
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }

        $resp = json_decode($raw);

        if (json_last_error() === JSON_ERROR_NONE) {
            if (isset($resp->build)) {
                $remote_build = $resp->build;
                $changelog = $resp->changelog;

                if ($config['build'] < $remote_build) {
                    $update_available = 'Yes';
                }
            }
        } else {
            $msg = 'Unable to Connect Update Server';
        }

        $a = [
            'remote_build' => $remote_build,
            'changelog' => $changelog,
            'update_available' => $update_available,
            'msg' => $msg,
        ];

        header('Content-Type: application/json');

        echo json_encode($a);

        ib_close();

        break;

    case 'backup_logo':
        header('Content-Type: application/json');

        if ($_app_stage == 'Demo') {
            $a = [
                'continue' => 'No',
                'message' => 'This option is disabled in the demo mode.',
            ];

            echo json_encode($a);

            ib_close();
        }

        $file = 'application/storage/system/logo.png';
        $newfile = './logo.png';

        $message = '';
        $continue = 'No';

        if (!copy($file, $newfile)) {
            $message = "failed to copy $file";
        } else {
            $message = "File Copied: $file ...";
            $continue = 'Yes';
        }

        $a = [
            'continue' => $continue,
            'message' => $message,
        ];

        echo json_encode($a);

        ib_close();

        break;

    case 'get_latest':
        header('Content-Type: application/json');

        $message = '';
        $continue = 'No';

        $purchase_code = $config['purchase_code'];

        if ($purchase_code == '') {
            $a = [
                'continue' => 'No',
                'message' =>
                    'Purchase Code Not Found. Please save Purchase code before update...',
            ];

            echo json_encode($a);

            ib_close();
        }

        // create download link

        $arr = [
            'app_url' => APP_URL,
            'item_id' => 11021678,
            'author_username' => 'SadiaSharmin',
            'purchase_code' => $purchase_code,
        ];

        $raw = ib_http_request(
            $update_server . 'envato/jsonapi/create_download_link/',
            'POST',
            $arr
        );

        $resp = json_decode($raw);

        if (json_last_error() === JSON_ERROR_NONE) {
            if (isset($resp->success)) {
                $success = $resp->success;
                if ($success == 'Yes') {
                    $a = [
                        'continue' => 'Yes',
                        'message' => $resp->message,
                        'dl' => $resp->dl,
                    ];

                    echo json_encode($a);

                    ib_close();
                } else {
                    $a = [
                        'continue' => 'No',
                        'message' => $resp->message,
                    ];

                    echo json_encode($a);

                    ib_close();
                }
            } else {
                $a = [
                    'continue' => 'No',
                    'message' => 'Unable to communicate download server.',
                ];

                echo json_encode($a);

                ib_close();
            }
        } else {
            $a = [
                'continue' => 'No',
                'message' => $raw,
            ];

            echo json_encode($a);

            ib_close();
        }

        break;

    case 'dl_latest':
        if (function_exists('ini_set')) {
            ini_set('memory_limit', '512M');
            ini_set('max_execution_time', 300);
        }

        header('Content-Type: application/json');
        $link = $_POST['link'];

        $a = [
            'continue' => 'No',
            'message' => "Unable to Receive File from: " . $link,
        ];

        $h = new IBilling_Http();

        try {
            $r = $h
                ->open($link)
                ->setFileName('./ibilling.zip')
                ->then('download');

            $a = [
                'continue' => 'Yes',
                'message' => 'File copied from remote!',
            ];

            echo json_encode($a);

            ib_close();
        } catch (Exception $e) {
            $a = [
                'continue' => 'No',
                'message' => $e->getMessage(),
            ];

            echo json_encode($a);

            ib_close();
        }

        echo json_encode($a);

        ib_close();

        break;

    case 'dl_unzip':
        header('Content-Type: application/json');
        $msg = '';

        $file = './ibilling.zip';

        $path = './';

        if (!file_exists($file)) {
            $a = [
                'continue' => 'No',
                'message' => 'File Not Found!',
            ];

            echo json_encode($a);
            ib_close();
        }

        if (class_exists('ZipArchive')) {
            $zip = new ZipArchive();

            $res = $zip->open($file);
            if ($res === true) {
                $zip->extractTo($path);

                if ($zip->close()) {
                    if (file_exists('./ibilling.zip')) {
                        unlink('./ibilling.zip');
                    }
                }
            } else {
                $msg .= 'An error occured while unzipping the file' . PHP_EOL;
            }
        } else {
            $msg .= 'PHP ZipArchive Class is not Available!' . PHP_EOL;
        }

        if ($msg != '') {
            if (file_exists('./ibilling.zip')) {
                unlink('./ibilling.zip');
            }

            $a = [
                'continue' => 'No',
                'message' => $msg,
            ];
        } else {
            $a = [
                'continue' => 'Yes',
                'message' => 'File Extracted!',
            ];
        }

        echo json_encode($a);

        break;

    case 'update_complete':
        $directory = 'ui/compiled';
        $files = array_diff(scandir($directory), ['..', '.', 'index.html']);

        foreach ($files as $file) {
            echo 'Removing Cache File: ' . $file . PHP_EOL;

            unlink('ui/compiled/' . $file);

            // removing install directory

            $fs = new IBilling_FileSystem();

            try {
                $fs->deleteDir('application/install/');
            } catch (Exception $e) {
                echo '=============================' . PHP_EOL;

                echo 'Deleting installer directory is ignored.' . PHP_EOL;
            }
        }

        if (file_exists('./logo.png')) {
            rename('./logo.png', 'application/storage/system/logo.png');

            echo '=============================' . PHP_EOL;

            echo 'Logo Restored.' . PHP_EOL;

            echo '=============================' . PHP_EOL;
        }

        echo ib_http_request(U . 'update/ajax/') . PHP_EOL;

        echo '=============================' . PHP_EOL;

        echo 'Update Completed. You can save this log message for debug.' .
            PHP_EOL;

        update_option('ib_u_a', '0');

        break;

    case 'get_plugin':
        $msg = '';

        $pl_url = _post('pl_url');

        // check URL is correct

        if (filter_var($pl_url, FILTER_VALIDATE_URL) === false) {
            $msg .= 'Invalid URL.';
        }

        if ($msg == '') {
            r2(U . 'settings/plugins', 's', 'No valid plugin header found.');
        } else {
            r2(U . 'settings/plugins', 'e', $msg);
        }

        break;

    case 'url_rewrite':
        if ($_app_stage == 'Demo') {
            r2(U . 'dashboard/', 'e', $_L['disabled_in_demo']);
        }

        $set = route(2);

        if ($set == 'yes') {
            $ui->assign('xfooter', Asset::js(['settings/url_rewrite']));

            //            $ui->assign('_st', $_L['Settings']);

            $ui->assign('msg', 'Please wait...');

            $ui->display('activity.tpl');
        } else {
            $fs = new IBilling_FileSystem();

            try {
                $fs->select('.htaccess')->delete();
                update_option('url_rewrite', 0);
                r2(
                    APP_URL . '/?ng=settings/app/',
                    's',
                    $_L['Settings Saved Successfully']
                );
            } catch (Exception $e) {
                update_option('url_rewrite', 0);
                r2(
                    APP_URL . '/?ng=settings/app/',
                    's',
                    'An Error Occurred while removing .htaccess file. Error: ' .
                        $e->getMessage()
                );
            }
        }

        break;

    case 'url_rewrite_enable':
        update_option('url_rewrite', 1);

        echo 'URL rewrite enabled... <br> ';

        break;

    case 'url_rewrite_check':
        $resp = ib_http_request(U . 'settings/url_rewrite_is_ok/');

        if ($resp == 'ok') {
            // it's working

            echo 'ok';
        } else {
            // remove

            echo 'failed ' . U . 'settings/url_rewrite_is_ok/';
        }

        break;

    case 'url_rewrite_is_ok':
        echo 'ok';

        break;

    case 'set_color':
        $available_color = ['dark', 'blue', 'light'];

        $color = route(2);

        if (in_array($color, $available_color)) {
            update_option('nstyle', $color);
        }

        r2(U . 'dashboard/');

        break;

    case 'recaptcha_post':
        if ($_app_stage == 'Demo') {
            r2(U . 'settings/app/', 'e', "This option is disabled in Demo.");
        }
        $data = ib_get_posted_data();

        update_option('recaptcha', $data['recaptcha']);
        update_option('recaptcha_sitekey', $data['recaptcha_sitekey']);
        update_option('recaptcha_secretkey', $data['recaptcha_secretkey']);

        r2(U . 'settings/app', 's', $_L['Settings Saved Successfully']);

        break;

    case 'custom_scripts':
        if ($_app_stage == 'Demo') {
            r2(
                U . 'appearance/customize/',
                'e',
                "This option is disabled in Demo."
            );
        }

        update_option('header_scripts', $_POST['header_scripts']);
        update_option('footer_scripts', $_POST['footer_scripts']);

        //        r2(U.'settings/app','s',$_L['Settings Saved Successfully']);

        r2(
            U . 'appearance/customize/',
            's',
            $_L['Settings Saved Successfully']
        );

        break;

    case 'update_admin_note':
        $notes = $_POST['notes'];

        $user->notes = $notes;
        $user->save();

        echo $_L['Data Updated'];

        break;

    case 'roles':
        $roles = Model::factory('Models_Role')->find_array();

        $ui->assign('roles', $roles);

        $ui->display('settings_roles.tpl');

        break;

    case 'add_role':
        $ui->assign('xfooter', Asset::js('settings/add_role'));

        $permissions = Model::factory('Models_Permission')->find_array();
        $roles = Model::factory('Models_Role')->find_array();

        $ui->assign('permissions', $permissions);
        $ui->assign('roles', $roles);

        $ui->display('settings_add_role.tpl');

        break;

    case 'add_role_post':
        $msg = '';

        $data = ib_posted_data();

        $rname = _post('rname');

        if ($rname == 'Admin') {
            $msg .= 'Role name "Admin" is not allowed. <br>';
        }

        if ($rname == '') {
            $msg .= 'Role name is required. <br>';
        }

        // check Role exist with the same name

        if (Models_Role::isExist($rname)) {
            $msg .= 'Role already exist. Use Different Role Name. <br>';
        }

        if ($msg == '') {
            $role = Model::factory('Models_Role')->create();
            $role->rname = $rname;
            $role->save();

            $rid = $role->id();

            //

            $permissions = Model::factory('Models_Permission')->find_array();

            foreach ($permissions as $p) {
                $d = ORM::for_table('sys_staffpermissions')->create();

                $shortname = $p['shortname'];

                $d->rid = $rid;
                $d->pid = $p['id'];
                $d->shortname = $shortname;

                $view = $shortname . '_view';
                $edit = $shortname . '_edit';
                $create = $shortname . '_create';
                $delete = $shortname . '_delete';

                if (isset($data[$view])) {
                    $d->can_view = 1;
                } else {
                    $d->can_view = 0;
                }

                if (isset($data[$edit])) {
                    $d->can_edit = 1;
                } else {
                    $d->can_edit = 0;
                }

                if (isset($data[$create])) {
                    $d->can_create = 1;
                } else {
                    $d->can_create = 0;
                }

                if (isset($data[$delete])) {
                    $d->can_delete = 1;
                } else {
                    $d->can_delete = 0;
                }

                $d->save();
            }

            r2(U . 'settings/roles/', 's', $_L['added_successful']);
        } else {
            r2(U . 'settings/add_role/', 'e', $msg);
        }

        break;

    case 'edit_role':
        $id = route(2);

        $role = Model::factory('Models_Role')->find_one($id);

        if ($role) {
            $permissions = Model::factory('Models_Permission')->find_array();
            $ui->assign('permissions', $permissions);
            $ui->assign('role', $role);

            $sp = ORM::for_table('sys_staffpermissions')
                ->where('rid', $id)
                ->find_array();

            $ui->assign('xfooter', Asset::js('settings/add_role'));
            $ui->display('settings_edit_role.tpl');
        } else {
            echo 'Role Not Found.';
        }

        break;

    case 'edit_role_post':
        $id = _post('rid');

        $msg = '';

        $data = ib_posted_data();

        $role = Model::factory('Models_Role')->find_one($id);

        $c_rname = $role->rname;

        if ($role) {
            $rid = $id;

            $rname = _post('rname');

            if ($rname == 'Admin') {
                $msg .= 'Role name "Admin" is not allowed. <br>';
            }

            if ($rname == '') {
                $msg .= 'Role name is required. <br>';
            }

            // check Role exist with the same name

            if ($c_rname != $rname) {
                if (Models_Role::isExist($rname)) {
                    $msg .= 'Role already exist. Use Different Role Name. <br>';
                }
            }

            if ($msg == '') {
                $role->rname = $rname;

                $role->save();

                $p = ORM::for_table('sys_staffpermissions')
                    ->where('rid', $id)
                    ->delete_many();

                $permissions = Model::factory(
                    'Models_Permission'
                )->find_array();

                foreach ($permissions as $p) {
                    $d = ORM::for_table('sys_staffpermissions')->create();

                    $shortname = $p['shortname'];

                    $d->rid = $rid;
                    $d->pid = $p['id'];
                    $d->shortname = $shortname;

                    $view = $shortname . '_view';
                    $edit = $shortname . '_edit';
                    $create = $shortname . '_create';
                    $delete = $shortname . '_delete';

                    if (isset($data[$view])) {
                        $d->can_view = 1;
                    } else {
                        $d->can_view = 0;
                    }

                    if (isset($data[$edit])) {
                        $d->can_edit = 1;
                    } else {
                        $d->can_edit = 0;
                    }

                    if (isset($data[$create])) {
                        $d->can_create = 1;
                    } else {
                        $d->can_create = 0;
                    }

                    if (isset($data[$delete])) {
                        $d->can_delete = 1;
                    } else {
                        $d->can_delete = 0;
                    }

                    $d->save();
                }

                r2(
                    U . 'settings/edit_role/' . $id,
                    's',
                    $_L['edit_successful']
                );
            } else {
                r2(U . 'settings/edit_role/' . $id, 'e', $msg);
            }
        } else {
            echo 'Role Not Found.';
        }

        break;

    case 'currencies':
        $ui->assign(
            'jsvar',
            '
_L[\'are_you_sure\'] = \'' .
                $_L['are_you_sure'] .
                '\';
 '
        );

        $ui->assign('_st', $_L['Currencies']);

        // Check Currency is available

        $currency = Model::factory('Models_Currency');
        $currencies = $currency->find_array();

        if (!$currency->find_one()) {
            // sync with home currency

            $n = $currency->create();

            $n->iso_code = $config['home_currency'];
            $n->cname = $config['home_currency'];
            $n->symbol = $config['currency_code'];
            $n->save();
        }

        $css_arr = ['modal'];
        $js_arr = ['modal', 'settings/add_currency'];

        $ui->assign('xheader', Asset::css($css_arr));
        $ui->assign('xfooter', Asset::js($js_arr));

        $ui->assign('currencies', $currencies);

        $ui->display('settings_currencies.tpl');

        break;

    case 'modal_add_currency':
        $id = route(2);

        $currency = false;

        if ($id != '') {
            $id = str_replace('ae', '', $id);
            $id = str_replace('be', '', $id);

            $currency = Model::factory('Models_Currency')->find_one($id);
        }

        $val = [];

        if ($currency) {
            $f_type = 'edit';
            $val['code'] = $currency->cname;
            $val['symbol'] = $currency->symbol;
            $val['rate'] = $currency->rate;
            $val['cid'] = $currency->id;
        } else {
            $f_type = 'create';
            $val['code'] = '';
            $val['symbol'] = '';
            $val['rate'] = '1.0000';
            $val['cid'] = '0';
        }

        $ui->assign('f_type', $f_type);
        $ui->assign('val', $val);

        $ui->display('modal_add_currency.tpl');

        break;

    case 'add_currency_post':
        $msg = '';

        $iso_code = _post('iso_code');
        $cname = _post('iso_code');

        $symbol = _post('symbol');

        $rate = _post('rate');

        if (strlen($iso_code) != 3) {
            $msg .= 'Invalid Currency Code <br>';
        }

        if ($symbol == '') {
            $msg .= 'Currency Symbol is required <br>';
        }

        if (!is_numeric($rate)) {
            $msg .= 'Invalid Rate';
        }

        $f_type = _post('f_type');

        if ($f_type == 'edit') {
            $cid = _post('cid');
            $currency = Model::factory('Models_Currency')->find_one($cid);

            if ($currency) {
                $currency->cname = $iso_code;
                $currency->iso_code = $iso_code;
                $currency->symbol = $symbol;
                $currency->rate = $rate;

                $currency->save();

                $id = $currency->id();

                echo $id;
            } else {
                echo 'An Error Occurred';
            }
        } else {
            $check = Model::factory('Models_Currency')
                ->where('cname', $cname)
                ->find_one();

            if ($check) {
                $msg .= 'Currency already exist <br>';
            }

            if ($msg == '') {
                $currency = Model::factory('Models_Currency')->create();

                $currency->cname = $iso_code;
                $currency->iso_code = $iso_code;
                $currency->symbol = $symbol;
                $currency->rate = $rate;

                $currency->save();

                $id = $currency->id();

                echo $id;
            } else {
                echo $msg;
            }
        }

        break;

    case 'make_base_currency':
        $id = route(2);
        $id = str_replace('b', '', $id);

        $currency = Model::factory('Models_Currency');

        $c = $currency->find_one($id);

        if ($c) {
            update_option('home_currency', $c->cname);
            update_option('currency_code', $c->symbol);
        }

        r2(U . 'settings/currencies/', 's', 'Currency Updated Successfully.');

        break;

    case 'email-test':
        $validator = new Validator();
        $data = $request->all();
        $validation = $validator->validate($data, [
            'email' => 'required|email',
        ]);

        if ($validation->fails()) {
            $message = '';
            foreach ($validation->errors()->all() as $key => $value) {
                $message .= $value . ' <br> ';
            }
            // validation failed
            responseWithError($message);
        } else {
            $msg = '';

            $msg .=
                'Sending and email with Test Invoice Attachment....' . PHP_EOL;

            $email = $data['email'];

            $invoice = Invoice::first();

            if (!$invoice) {
                $msg .= 'You don\'t have an Invoice to test.... ' . PHP_EOL;
            }

            if ($invoice) {
                if ($invoice->cn != '') {
                    $dispid = $invoice->cn;
                } else {
                    $dispid = $invoice->id;
                }

                $in = $invoice->invoicenum . $dispid;

                $attach_pdf = _post('attach_pdf');
                $attachment_path = '';
                $attachment_file = '';

                Invoice::pdf($invoice->id, 'store');
                $attachment_path = 'storage/temp/Invoice_' . $in . '.pdf';
                $attachment_file = 'Invoice_' . $in . '.pdf';

                $subject = 'A Test email!';

                $message = 'Test body with an attachment';

                $email_config = EmailConfig::first();

                if ($email_config) {
                    if ($email_config->method == 'smtp') {
                        $transport = (new Swift_SmtpTransport(
                            $email_config->host,
                            $email_config->port
                        ))
                            ->setUsername($email_config->username)
                            ->setPassword($email_config->password);
                    } else {
                        $transport = new Swift_SendmailTransport(
                            '/usr/sbin/sendmail -bs'
                        );
                    }

                    $mailer = new Swift_Mailer($transport);

                    $logger = new Swift_Plugins_Loggers_ArrayLogger();
                    $mailer->registerPlugin(
                        new Swift_Plugins_LoggerPlugin($logger)
                    );

                    $logger = new Swift_Plugins_Loggers_EchoLogger();
                    $mailer->registerPlugin(
                        new Swift_Plugins_LoggerPlugin($logger)
                    );

                    $message = (new Swift_Message($subject))
                        ->setFrom([
                            $config['sysEmail'] => $config['CompanyName'],
                        ])
                        ->setTo([$email => 'Test'])
                        ->setBody($message, 'text/html');

                    if ($attachment_path != '') {
                        $message->attach(
                            Swift_Attachment::fromPath($attachment_path)
                        );
                    }

                    $mailer->send($message);

                    echo $logger->dump();
                }
            }

            echo $msg;
        }

        break;

    default:
        echo 'action not defined';
}
