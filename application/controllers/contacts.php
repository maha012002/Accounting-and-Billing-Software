<?php
if (!isset($myCtrl)) {
    $myCtrl = 'contacts';
}
_auth();
$ui->assign('_application_menu', 'contacts');
$ui->assign('_title', $_L['Contacts'] . ' - ' . $config['CompanyName']);
$ui->assign('_st', $_L['Contacts']);
$ui->assign('content_inner', inner_contents($config['c_cache']));
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);

$ui->assign(
    'jsvar',
    '
_L[\'Working\'] = \'' .
        $_L['Working'] .
        '\';
_L[\'Submit\'] = \'' .
        $_L['Submit'] .
        '\';
 '
);

switch ($action) {
    case 'add':
        Event::trigger('contacts/add/');

        if (!has_access($user->roleid, 'customers', 'create')) {
            permissionDenied();
        }

        $ui->assign('countries', Countries::all($config['country'])); // may add this $config['country_code']

        $fs = ORM::for_table('crm_customfields')
            ->where('ctype', 'crm')
            ->order_by_asc('id')
            ->find_many();
        $ui->assign('fs', $fs);

        // find all companies

        $companies = ORM::for_table('sys_companies')
            ->select('id')
            ->select('company_name')
            ->order_by_desc('id')
            ->find_array();

        $ui->assign('companies', $companies);

        // find all groups

        $gs = ORM::for_table('crm_groups')
            ->order_by_asc('sorder')
            ->find_array();

        $ui->assign('gs', $gs);

        $g_selected_id = route(2);
        $c_selected_id = route(3);

        if ($g_selected_id) {
            $ui->assign('g_selected_id', $g_selected_id);
        } else {
            $ui->assign('g_selected_id', '');
        }

        if ($c_selected_id) {
            $ui->assign('c_selected_id', $c_selected_id);
        } else {
            $ui->assign('c_selected_id', '');
        }

        $ui->assign('xheader', Asset::css(['modal', 's2/css/select2.min']));
        $ui->assign(
            'xfooter',
            Asset::js([
                'modal',
                's2/js/select2.min',
                's2/js/i18n/' . lan(),
                'add-contact',
            ])
        );
        $tags = Tags::get_all('Contacts');
        $ui->assign('tags', $tags);
        $ui->assign(
            'xjq',
            '
 $("#country").select2({
 theme: "bootstrap"
 });
 '
        );

        $ui->assign(
            'jsvar',
            '
_L[\'Working\'] = \'' .
                $_L['Working'] .
                '\';
_L[\'Company Name\'] = \'' .
                $_L['Company Name'] .
                '\';
_L[\'New Company\'] = \'' .
                $_L['New Company'] .
                '\';
 '
        );

        $currencies = Model::factory('Models_Currency')->find_array();

        $ui->assign('currencies', $currencies);

        $ui->display('add-contact.tpl');

        break;

    case 'summary':
        Event::trigger('contacts/summary/');

        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if ($d) {
            $ti = ORM::for_table('sys_transactions')
                ->where('payerid', $cid)
                ->sum('cr');
            if ($ti == '') {
                $ti = '0';
            }
            $ui->assign('ti', $ti);
            $te = ORM::for_table('sys_transactions')
                ->where('payeeid', $cid)
                ->sum('dr');
            if ($te == '') {
                $te = '0';
            }

            $ui->assign('te', $te);
            $ui->assign('d', $d);

            $cf = ORM::for_table('crm_customfields')
                ->where('ctype', 'crm')
                ->order_by_asc('id')
                ->find_many();
            $ui->assign('cf', $cf);

            // Find Profit

            if ($ti > $te) {
                $happened = $_L['Profit'];
                $css_class = 'green';

                $d_amount = $ti - $te;
            } else {
                $happened = $_L['Loss'];
                $css_class = 'danger';
                $d_amount = $te - $ti;
            }

            $ui->assign('happened', $happened);
            $ui->assign('css_class', $css_class);
            $ui->assign('d_amount', $d_amount);

            $ui->display('ajax.contact-summary.tpl');
        } else {
        }

        break;

    case 'activity':
        Event::trigger('contacts/activity/');

        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if ($d) {
            $ac = ORM::for_table('sys_activity')
                ->where('cid', $cid)
                ->limit(20)
                ->order_by_desc('id')
                ->find_many();
            $ui->assign('ac', $ac);
            $ui->display('ajax.contact-activity.tpl');
        } else {
        }

        break;

    case 'invoices':
        Event::trigger('contacts/invoices/');

        $cid = _post('cid');
        $ui->assign('cid', $cid);
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if ($d) {
            $i = ORM::for_table('sys_invoices')
                ->where('userid', $cid)
                ->find_many();
            $ui->assign('i', $i);
            $ui->display('ajax.contact-invoices.tpl');
        } else {
        }

        break;

    case 'quotes':
        Event::trigger('contacts/quotes/');

        $cid = _post('cid');
        $ui->assign('cid', $cid);
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if ($d) {
            $i = ORM::for_table('sys_quotes')
                ->where('userid', $cid)
                ->find_many();
            $ui->assign('i', $i);
            $ui->display('ajax.contact-quotes.tpl');
        } else {
        }

        break;

    case 'transactions':
        Event::trigger('contacts/transactions/');

        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if ($d) {
            $tr = ORM::for_table('sys_transactions')
                ->where_raw('(`payerid` = ? OR `payeeid` = ?)', [$cid, $cid])
                ->order_by_desc('id')
                ->find_many();
            $ui->assign('tr', $tr);
            $ui->display('ajax.contact-transactions.tpl');
        } else {
        }

        break;

    case 'email':
        Event::trigger('contacts/email/');

        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if ($d) {
            $e = ORM::for_table('sys_email_logs')
                ->where('userid', $cid)
                ->order_by_desc('id')
                ->find_many();
            $ui->assign('d', $d);
            $ui->assign('e', $e);
            $ui->display('ajax.contact-emails.tpl');
        } else {
        }

        break;

    case 'edit':
        if (!has_access($user->roleid, 'customers', 'edit')) {
            permissionDenied();
        }

        Event::trigger('contacts/edit/');

        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if ($d) {
            $fs = ORM::for_table('crm_customfields')
                ->where('ctype', 'crm')
                ->order_by_asc('id')
                ->find_many();
            $ui->assign('fs', $fs);
            $ui->assign('countries', Countries::all($d['country']));
            $ui->assign('d', $d);
            $tags = Tags::get_all('Contacts');
            $ui->assign('tags', $tags);
            $dtags = explode(',', $d['tags']);
            $ui->assign('dtags', $dtags);

            // find all groups

            $gs = ORM::for_table('crm_groups')
                ->order_by_asc('sorder')
                ->find_array();

            $ui->assign('gs', $gs);

            $companies = ORM::for_table('sys_companies')
                ->select('id')
                ->select('company_name')
                ->order_by_desc('id')
                ->find_array();

            $ui->assign('companies', $companies);

            $g_selected_id = route(4);

            if ($g_selected_id) {
                $ui->assign('g_selected_id', $g_selected_id);
            } else {
                $ui->assign('g_selected_id', '');
            }

            $c_selected_id = route(5);

            if ($c_selected_id) {
                $ui->assign('c_selected_id', $c_selected_id);
            } else {
                $ui->assign('c_selected_id', '');
            }

            $currencies = Model::factory('Models_Currency')->find_array();

            $ui->assign('currencies', $currencies);

            $ui->display('ajax.contact-edit.tpl');
        } else {
        }

        break;

    case 'add-activity-post':
        Event::trigger('contacts/add-activity-post/');

        $cid = _post('cid');
        $msg = $_POST['msg'];
        $icon = $_POST['icon'];
        $icon = trim($icon);

        $icon = str_replace('<a href="#"><i class="', '', $icon);
        $icon = str_replace('"></i></a>', '', $icon);
        if ($icon == '') {
            $icon = 'fa fa-check';
        }

        if (Validator::Length($msg, 1000, 5) == false) {
            echo $_L['Message Should be between 5 to 1000 characters'];
        } else {
            $d = ORM::for_table('sys_activity')->create();
            $d->cid = $cid;
            $d->msg = $msg;
            $d->icon = $icon;
            $d->stime = time();
            $d->sdate = date('Y-m-d');
            $d->o = $user['id'];
            $d->oname = $user['fullname'];
            $d->save();

            echo $cid;
        }

        break;

    case 'activity-delete':
        Event::trigger('contacts/activity-delete/');

        $id = $routes['3'];
        $d = ORM::for_table('sys_activity')->find_one($id);
        $d->delete();
        $cid = $routes['2'];
        r2(
            U . $myCtrl . '/view/' . $cid . '/',
            's',
            $_L['Deleted Successfully']
        );
        break;

    case 'view':
        Event::trigger('contacts/view/');

        $id = $routes['2'];
        $d = ORM::for_table('crm_accounts')->find_one($id);
        if ($d) {
            $extra_tab = '';
            $extra_jq = '';

            $tab = route(3);

            if (!$tab) {
                $tab = 'summary';
            }

            $ui->assign('tab', $tab);

            Event::trigger('contacts/view/_on_start');

            $ui->assign('extra_tab', $extra_tab);

            // invoice count

            $inv_count = ORM::for_table('sys_invoices')
                ->where('userid', $id)
                ->count();

            if ($inv_count == '') {
                $inv_count = 0;
            }

            $ui->assign('inv_count', $inv_count);

            $quote_count = ORM::for_table('sys_quotes')
                ->where('userid', $id)
                ->count();

            if ($quote_count == '') {
                $quote_count = 0;
            }

            $ui->assign('quote_count', $quote_count);

            $ui->assign(
                'xheader',
                Asset::css([
                    'modal',
                    'redactor/redactor',
                    's2/css/select2.min',
                    'imgcrop/assets/css/croppic',
                ]) .
                    '
            
            <style>
            .redactor-box {

     margin-bottom: 0;
}
            </style>
            '
            );

            $ui->assign(
                'xfooter',
                Asset::js(
                    [
                        'modal',
                        'redactor/redactor.min',
                        's2/js/select2.min',
                        's2/js/i18n/' . lan(),
                        'imgcrop/croppic',
                        'numeric',
                        'profile',
                    ],
                    $file_build
                )
            );

            $ui->assign(
                'xjq',
                '
 var cid = $(\'#cid\').val();
    var _url = $("#_url").val();
    var cb = function cb (){



            };




 ' . $extra_jq
            );

            $ui->assign('d', $d);

            Event::trigger('contacts/view/_on_display');

            $ui->display('account-profile-alt.tpl');
        } else {
            r2(U . 'customers/list/', 'e', $_L['Account_Not_Found']);
        }

        break;

    case 'add-post':
        Event::trigger('contacts/add-post/');

        Event::trigger('contacts/add-post/_on_start');

        $account = _post('account');

        //  $company = _post('company');

        $company_id = _post('cid');

        $company = '';
        $cid = 0;

        if ($company_id != '' || $company_id != '0') {
            $company_db = db_find_one('sys_companies', $company_id);

            if ($company_db) {
                $company = $company_db->company_name;
                $cid = $company_id;
            }
        }

        $email = _post('email');
        $phone = _post('phone');
        $currency = _post('currency');

        if ($currency == '') {
            $currency = '0';
        }

        if (isset($_POST['tags']) and $_POST['tags'] != '') {
            $tags = $_POST['tags'];
        } else {
            $tags = '';
        }

        $address = _post('address');
        $city = _post('city');
        $state = _post('state');
        $zip = _post('zip');
        $country = _post('country');
        $msg = '';

        if ($account == '') {
            $msg .= $_L['Account Name is required'] . ' <br>';
        }

        if ($email != '') {
            if (Validator::Email($email) == false) {
                $msg .= $_L['Invalid Email'] . ' <br>';
            }
            $f = ORM::for_table('crm_accounts')
                ->where('email', $email)
                ->find_one();

            if ($f) {
                $msg .= $_L['Email already exist'] . ' <br>';
            }
        }

        if ($phone != '') {
            $f = ORM::for_table('crm_accounts')
                ->where('phone', $phone)
                ->find_one();

            if ($f) {
                $msg .= $_L['Phone number already exist'] . ' <br>';
            }
        }

        $gid = _post('group');
        $gname = '';
        if ($gid != '') {
            $g = db_find_one('crm_groups', $gid);
            if ($g) {
                $gname = $g['gname'];
            }
        } else {
            $gid = 0;
        }

        $password = _post('password');
        $cpassword = _post('cpassword');

        $u_password = '';

        if ($password != '') {
            if (!Validator::Length($password, 15, 5)) {
                $msg .=
                    'Password should be between 6 to 15 characters' . '<br>';
            }

            if ($password != $cpassword) {
                $msg .= 'Passwords does not match' . '<br>';
            }

            $u_password = $password;
            $password = Password::_crypt($password);
        }

        if ($msg == '') {
            Tags::save($tags, 'Contacts');

            $data = [];

            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $d = ORM::for_table('crm_accounts')->create();

            $d->account = $account;
            $d->email = $email;
            $d->phone = $phone;
            $d->address = $address;
            $d->city = $city;
            $d->zip = $zip;
            $d->state = $state;
            $d->country = $country;
            $d->tags = Arr::arr_to_str($tags);

            //others
            $d->fname = '';
            $d->lname = '';
            $d->company = $company;
            $d->jobtitle = '';
            $d->cid = $cid;
            $d->o = $user->id;
            $d->balance = '0.00';
            $d->status = 'Active';
            $d->notes = '';
            $d->password = $password;
            $d->token = '';
            $d->ts = '';
            $d->img = '';
            $d->web = '';
            $d->facebook = '';
            $d->google = '';
            $d->linkedin = '';

            // v 4.2

            $d->gname = $gname;
            $d->gid = $gid;

            // build 4550

            $d->currency = $currency;

            //

            $d->created_at = $data['created_at'];

            //
            $d->save();
            $cid = $d->id();
            _log(
                $_L['New Contact Added'] .
                    ' ' .
                    $account .
                    ' [CID: ' .
                    $cid .
                    ']',
                'Admin',
                $user['id']
            );

            //now add custom fields
            $fs = ORM::for_table('crm_customfields')
                ->where('ctype', 'crm')
                ->order_by_asc('id')
                ->find_many();
            foreach ($fs as $f) {
                $fvalue = _post('cf' . $f['id']);
                $fc = ORM::for_table('crm_customfieldsvalues')->create();
                $fc->fieldid = $f['id'];
                $fc->relid = $cid;
                $fc->fvalue = $fvalue;
                $fc->save();
            }
            //

            Event::trigger('contacts/add-post/_on_finished');

            // send welcome email if needed

            $send_client_signup_email = _post('send_client_signup_email');

            if (
                $email != '' &&
                $send_client_signup_email == 'Yes' &&
                $u_password != ''
            ) {
                $email_data = [];
                $email_data['account'] = $account;
                $email_data['company'] = $company;
                $email_data['password'] = $u_password;
                $email_data['email'] = $email;

                $send_email = Ib_Email::send_client_welcome_email($email_data);
            }

            echo $cid;
        } else {
            echo $msg;
        }
        break;

    case 'list':
        Event::trigger('contacts/list/');

        $name = _post('name');
        //find all tags
        $t = ORM::for_table('sys_tags')
            ->where('type', 'contacts')
            ->find_many();
        $ui->assign('t', $t);

        $mode_css = '';
        $mode_js = '';

        if ($config['contact_set_view_mode'] == 'search') {
            // Foo Table

            $mode_css = Asset::css('footable/css/footable.core.min');

            $mode_js = Asset::js([
                'footable/js/footable.all.min',
                'contacts/mode_search',
            ]);

            $d = ORM::for_table('crm_accounts')
                ->order_by_desc('id')
                ->find_many();

            $paginator['contents'] = '';
        } elseif ($name != '') {
            $paginator = Paginator::bootstrap(
                'crm_accounts',
                'account',
                '%' . $name . '%'
            );
            $d = ORM::for_table('crm_accounts')
                ->where_like('account', '%' . $name . '%')
                ->offset($paginator['startpoint'])
                ->limit($paginator['limit'])
                ->order_by_desc('id')
                ->find_many();
        } elseif (
            isset($routes[2]) and
            $routes[2] != '' and
            !is_numeric($routes[2])
        ) {
            $tags = $routes[2];
            $paginator['contents'] = '';
            $d = ORM::for_table('crm_accounts')
                ->where_like('tags', '%' . $tags . '%')
                ->order_by_desc('id')
                ->find_many();
        } else {
            $paginator = Paginator::bootstrap('crm_accounts');
            $d = ORM::for_table('crm_accounts')
                ->offset($paginator['startpoint'])
                ->limit($paginator['limit'])
                ->order_by_desc('id')
                ->find_many();
        }

        $ui->assign('d', $d);
        $ui->assign('paginator', $paginator);

        $ui->assign('xheader', $mode_css);

        $ui->assign(
            'xfooter',
            $mode_js .
                '
<script type="text/javascript" src="' .
                $_theme .
                '/lib/list-contacts.js"></script>

'
        );
        $ui->assign(
            'jsvar',
            '
_L[\'are_you_sure\'] = \'' .
                $_L['are_you_sure'] .
                '\';
 '
        );
        $ui->display('list-contacts.tpl');

        break;

    case 'edit-post':
        Event::trigger('contacts/edit-post/');

        $id = _post('fcid');
        $d = ORM::for_table('crm_accounts')->find_one($id);
        if ($d) {
            $old_account = $d->account;

            $account = _post('account');
            // $company = _post('company');

            $company_id = _post('company_id');

            $company = '';
            $cid = 0;

            if ($company_id != '' || $company_id != '0') {
                $company_db = db_find_one('sys_companies', $company_id);

                if ($company_db) {
                    $company = $company_db->company_name;
                    $cid = $company_id;
                }
            }

            $email = _post('edit_email');

            if (isset($_POST['tags'])) {
                $tags = $_POST['tags'];
            } else {
                $tags = '';
            }

            $currency = _post('currency', '0');

            if ($currency == '') {
                $currency = '0';
            }

            $phone = _post('phone');
            $address = _post('address');
            $city = _post('city');
            $state = _post('state');
            $zip = _post('zip');
            $country = _post('country');
            $msg = '';

            if ($account == '') {
                $msg .= $_L['Account Name is required'] . ' <br>';
            }

            Tags::save($tags, 'Contacts');

            if ($email != '') {
                if ($email != $d['email']) {
                    $f = ORM::for_table('crm_accounts')
                        ->where('email', $email)
                        ->find_one();

                    if ($f) {
                        $msg .= $_L['Email already exist'] . ' <br>';
                    }
                }
                if (Validator::Email($email) == false) {
                    $msg .= $_L['Invalid Email'] . ' <br>';
                }
            }

            $gid = _post('group');

            if ($gid != '') {
                $g = db_find_one('crm_groups', $gid);
                $gname = $g['gname'];
            } else {
                $gid = 0;
                $gname = '';
            }

            $password = _post('password');

            if ($msg == '') {
                $d = ORM::for_table('crm_accounts')->find_one($id);
                $d->account = $account;
                $d->company = $company;
                $d->cid = $company_id;

                $d->email = $email;
                $d->tags = Arr::arr_to_str($tags);
                $d->phone = $phone;
                $d->address = $address;
                $d->city = $city;
                $d->zip = $zip;
                $d->state = $state;
                $d->country = $country;

                $d->gname = $gname;
                $d->gid = $gid;

                $d->currency = $currency;

                if ($password != '') {
                    $d->password = Password::_crypt($password);
                }

                $d->save();

                $exf = ORM::for_table('crm_customfieldsvalues')
                    ->where('relid', $id)
                    ->delete_many();
                $fs = ORM::for_table('crm_customfields')
                    ->order_by_asc('id')
                    ->find_many();
                foreach ($fs as $f) {
                    $fvalue = _post('cf' . $f['id']);
                    $fc = ORM::for_table('crm_customfieldsvalues')->create();
                    $fc->fieldid = $f['id'];
                    $fc->relid = $id;
                    $fc->fvalue = $fvalue;
                    $fc->save();
                }

                if ($account != $old_account) {
                    $sql = "update sys_invoices set account='$account' where account='$old_account'";

                    ORM::execute($sql);
                }

                _msglog('s', $_L['account_updated_successfully']);

                echo $id;
            } else {
                echo $msg;
            }
        } else {
            r2(U . $myCtrl . '/list', 'e', $_L['Account_Not_Found']);
        }

        break;
    case 'delete':
        Event::trigger('contacts/delete/');

        $id = $routes['2'];
        if ($_app_stage == 'Demo') {
            r2(
                U . $myCtrl . '/list/',
                'e',
                'Sorry! Deleting Account is disabled in the demo mode.'
            );
        }
        $d = ORM::for_table('crm_accounts')->find_one($id);
        if ($d) {
            $d->delete();
            r2(U . $myCtrl . '/list/', 's', $_L['account_delete_successful']);
        }

        break;

    case 'more':
        Event::trigger('contacts/more/');

        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if ($d) {
            $ui->assign('countries', Countries::all($d['country']));
            $ui->assign('d', $d);
            $ui->display('ajax.contact-more.tpl');
        } else {
        }

        break;

    case 'edit-more':
        Event::trigger('contacts/edit-more/');

        $id = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($id);
        if ($d) {
            $img = _post('picture');
            $facebook = _post('facebook');
            $google = _post('google');
            $linkedin = _post('linkedin');

            $msg = '';

            //check email already exist

            if ($msg == '') {
                $d = ORM::for_table('crm_accounts')->find_one($id);

                $d->img = $img;
                $d->facebook = $facebook;
                $d->google = $google;
                $d->linkedin = $linkedin;
                $d->save();
                echo $d->id();
            } else {
                echo $msg;
            }
        } else {
            r2(U . $myCtrl . '/list/', 'e', $_L['Account_Not_Found']);
        }

        break;

    case 'edit-notes':
        Event::trigger('contacts/edit-notes/');

        $id = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($id);
        if ($d) {
            $notes = _post('notes');

            $msg = '';

            //check email already exist

            if ($msg == '') {
                $d = ORM::for_table('crm_accounts')->find_one($id);

                $d->notes = $notes;
                $d->save();
                echo $d->id();
            } else {
                echo $msg;
            }
        } else {
            r2(U . $myCtrl . '/list/', 'e', $_L['Account_Not_Found']);
        }

        break;

    case 'render-address':
        Event::trigger('contacts/render-address/');

        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        $address = $d['address'];
        $city = $d['city'];
        $state = $d['state'];
        $zip = $d['zip'];
        $country = $d['country'];
        echo "$address
$city
$state $zip
$country
";
        break;

    case 'send_email':
        Event::trigger('contacts/send_email/');

        $msg = '';
        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        $email = $d['email'];
        $toname = $d['account'];
        $subject = _post('subject');
        if ($subject == '') {
            $msg .= $_L['Subject is Empty'] . ' <br>';
        }
        $message = $_POST['message'];
        if ($message == '') {
            $msg .= $_L['Message is Empty'] . ' <br>';
        }
        if ($msg == '') {
            //send email
            Notify_Email::_send($toname, $email, $subject, $message, $cid);
            echo $cid;
        } else {
            echo $msg;
        }
        break;

    case 'modal_add':
        Event::trigger('contacts/modal_add/');

        $ui->assign('countries', Countries::all($config['country'])); // may add this $config['country_code']
        $ui->display('modal_add_contact.tpl');

        break;

    case 'set_view_mode':
        Event::trigger('contacts/set_view_mode/');

        if (isset($routes[2]) and $routes[2] != '') {
            $mode = $routes['2'];
        } else {
            $mode = 'tbl';
        }

        $available_mode = ["tbl", "card", "search"];
        if (in_array($mode, $available_mode)) {
            update_option('contact_set_view_mode', $mode);
        }

        r2(U . 'contacts/list/');

        break;

    case 'export_csv':
        $fileName = 'contacts_' . time() . '.csv';

        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$fileName}");
        header("Expires: 0");
        header("Pragma: public");

        $fh = @fopen('php://output', 'w');

        $headerDisplayed = false;

        $results = db_find_array('crm_accounts', [
            'id',
            'account',
            'company',
            'phone',
            'email',
            'address',
            'city',
            'state',
            'zip',
            'country',
            'balance',
            'tags',
        ]);

        foreach ($results as $data) {
            if (!$headerDisplayed) {
                fputcsv($fh, array_keys($data));
                $headerDisplayed = true;
            }

            fputcsv($fh, $data);
        }
        // Close the file
        fclose($fh);

        break;

    case 'dev_demo_data':
        // this only work with dev mode
        is_dev();

        break;

    case 'import_csv':
        $ui->assign('xheader', Asset::css(['dropzone/dropzone']));

        $ui->assign(
            'xfooter',
            Asset::js(['dropzone/dropzone', 'contacts/import'])
        );

        $ui->display('contacts_import.tpl');

        break;

    case 'csv_upload':
        $uploader = new Uploader();
        $uploader->setDir('application/storage/temp/');
        // $uploader->sameName(true);
        $uploader->setExtensions(['csv']); //allowed extensions list//
        if ($uploader->uploadFile('file')) {
            //txtFile is the filebrowse element name //
            $uploaded = $uploader->getUploadName(); //get uploaded file name, renames on upload//

            $_SESSION['uploaded'] = $uploaded;
        } else {
            //upload failed
            _msglog('e', $uploader->getMessage()); //get upload error message
        }

        break;

    case 'csv_uploaded':
        if (isset($_SESSION['uploaded'])) {
            $uploaded = $_SESSION['uploaded'];

            $csv = new parseCSV();
            $csv->auto('application/storage/temp/' . $uploaded);

            $contacts = $csv->data;

            $cn = 0;

            foreach ($contacts as $contact) {
                $data = [];
                $data['account'] = $contact['Full Name'];
                $data['email'] = $contact['Email'];
                $data['phone'] = $contact['Phone'];
                $data['address'] = $contact['Address'];
                $data['city'] = $contact['City'];
                $data['zip'] = $contact['Zip'];
                $data['state'] = $contact['State'];
                $data['country'] = $contact['Country'];
                $data['company'] = $contact['Company'];

                $save = Contacts::add($data);

                if (is_numeric($save)) {
                    $cn++;
                }
            }

            _msglog('s', $cn . ' Contacts Imported');
        } else {
            _msglog('e', 'An Error Occurred while uploading the files');
        }

        break;

    case 'groups':
        $gs = ORM::for_table('crm_groups')
            ->order_by_asc('sorder')
            ->find_array();

        $ui->assign('gs', $gs);

        $ui->assign('xfooter', Asset::js(['contacts/groups']));

        $ui->assign(
            'jsvar',
            '
_L[\'are_you_sure\'] = \'' .
                $_L['are_you_sure'] .
                '\';
 '
        );

        $ui->display('crm_groups.tpl');

        break;

    case 'add_group':
        $group_name = _post('group_name');

        if ($group_name != '') {
            $c = ORM::for_table('crm_groups')
                ->where('gname', $group_name)
                ->find_one();

            if ($c) {
                ib_die('A Group with same name already exist');
            }

            $d = ORM::for_table('crm_groups')->create();
            $d->gname = $group_name;
            $d->color = '';
            $d->discount = '';
            $d->parent = '';
            $d->pid = 0;
            $d->exempt = '';
            $d->description = '';
            $d->separateinvoices = '';
            $d->sorder = 0;
            $d->c1 = '';
            $d->c2 = '';
            $d->c3 = '';
            $d->c4 = '';
            $d->c5 = '';
            $d->save();

            echo $d->id();
        } else {
            echo 'Group Name is required';
        }

        break;

    case 'find_by_group':
        $gid = route(2);

        if ($gid) {
            $g = ORM::for_table('crm_groups')->find_one($gid);

            if ($g) {
                $d = ORM::for_table('crm_accounts')
                    ->where('gid', $gid)
                    ->order_by_desc('id')
                    ->find_array();

                $ui->assign('d', $d);
                $ui->assign('gid', $gid);

                $ui->assign(
                    'xjq',
                    ' $(".cdelete").click(function (e) {
        e.preventDefault();
        var id = this.id;
        bootbox.confirm("' .
                        $_L['are_you_sure'] .
                        '", function(result) {
           if(result){
               var _url = $("#_url").val();
               window.location.href = _url + "delete/crm-user/" + id + "/' .
                        $gid .
                        '/";
           }
        });
    });
'
                );

                $ui->display('contacts_find_by_group.tpl');
            }
        }

        break;

    case 'group_edit':
        $id = _post('id');
        $id = str_replace('e', '', $id);
        $gname = _post('gname');

        $d = ORM::for_table('crm_groups')->find_one($id);

        if ($d) {
            $o_gname = $d->gname;

            ORM::execute(
                "update crm_accounts set gname='$gname' where gname='$o_gname'"
            );

            $d->gname = $gname;

            $d->save();

            echo $d->id;
        }

        break;

    case 'group_email':
        $gid = route(2);

        if ($gid) {
            $ds = ORM::for_table('crm_accounts')
                ->where('gid', $gid)
                ->where_not_equal('email', '')
                ->select('account')
                ->select('email')
                ->order_by_desc('id')
                ->find_array();

            $ui->assign('ds', $ds);

            $ui->assign(
                'xheader',
                Asset::css([
                    's2/css/select2.min',
                    'sn/summernote',
                    'sn/summernote-bs3',
                    'sn/summernote-application',
                ])
            );

            $ui->assign(
                'xfooter',
                Asset::js([
                    's2/js/select2.min',
                    's2/js/i18n/' . lan(),
                    'sn/summernote.min',
                    'contacts/group_email',
                ])
            );
            $ui->display('contacts_group_email.tpl');
        }

        break;

    case 'group_email_post':
        $emails = $_POST['emails'];
        $subject = $_POST['subject'];
        $msg = $_POST['msg'];

        Ib_Email::bulk_email($emails, $subject, $msg, $user->username);

        echo 'Mail Sent!';

        break;

    case 'companies':
        $ui->assign(
            'jsvar',
            '
_L[\'are_you_sure\'] = \'' .
                $_L['are_you_sure'] .
                '\';
 '
        );

        $ui->assign('_application_menu', 'companies');
        $ui->assign('_st', $_L['Companies']);

        // find all companies

        $companies = Model::factory('Models_Company')->find_array();

        $ui->assign('xheader', Asset::css(['modal']));
        $ui->assign(
            'xfooter',
            Asset::js([
                'modal',
                'tinymce/tinymce.min',
                'js/editor',
                'numeric',
                'contacts/companies',
            ])
        );

        $ui->assign('companies', $companies);

        $ui->display('companies.tpl');

        break;

    case 'modal_add_company':
        $id = route(2);

        $company = false;

        if ($id != '') {
            $id = str_replace('ae', '', $id);
            $id = str_replace('be', '', $id);

            $company = Model::factory('Models_Company')->find_one($id);
        }

        $val = [];

        if ($company) {
            $f_type = 'edit';
            $val['company_name'] = $company->company_name;
            $val['url'] = $company->url;
            $val['email'] = $company->email;
            $val['phone'] = $company->phone;
            $val['logo_url'] = $company->logo_url;
            $val['cid'] = $id;

            //            $val[''] = $company->;
        } else {
            $f_type = 'create';
            $val['company_name'] = '';
            $val['url'] = 'http://';
            $val['email'] = '';
            $val['phone'] = '';
            $val['logo_url'] = '';
            $val['cid'] = $id;
            //            $val[''] = '';
        }

        $ui->assign('f_type', $f_type);
        $ui->assign('val', $val);

        $ui->display('modal_add_company.tpl');

        break;

    case 'add_company_post':
        $data = ib_posted_data();

        if ($data['f_type'] == 'edit') {
            $company = Model::factory('Models_Company')->find_one($data['cid']);

            if (!$company) {
                i_close('Company Not Found');
            }
        } else {
            $company = Model::factory('Models_Company')->create();
        }

        if ($data['company_name'] == '') {
            i_close($_L['Company Name is required']);
        }

        if ($data['email'] != '' && !Validator::Email($data['email'])) {
            i_close($_L['Invalid Email']);
        }

        if ($data['url'] == 'http') {
            $data['url'] = '';
        }

        $company->company_name = $data['company_name'];
        $company->url = $data['url'];
        $company->email = $data['email'];
        $company->phone = $data['phone'];
        $company->logo_url = $data['logo_url'];
        $company->save();

        echo $company->id();

        break;

    case 'modal_edit_activity':
        $id = route(2);

        $id = str_replace('activity_', '', $id);

        $d = ORM::for_table('sys_activity')->find_one($id);

        if ($d) {
            $ui->assign('d', $d);
            $ui->display('modal_edit_activity.tpl');
        }

        break;

    case 'edit_activity_post':
        $edit_activity_id = _post('edit_activity_id');

        $d = ORM::for_table('sys_activity')->find_one($edit_activity_id);

        if ($d) {
            $message_text = $_POST['message_text'];
            $icon = $_POST['edit_activity_type'];
            $icon = str_replace('<a href="#"><i class="', '', $icon);
            $icon = str_replace('"></i></a>', '', $icon);
            if ($icon == '') {
                $icon = 'fa fa-check';
            }
            $d->icon = $icon;
            $d->msg = $message_text;
            $d->save();
            echo $d->id();
        }

        break;

    case 'orders':
        Event::trigger('contacts/orders/');

        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if ($d) {
            $d = ORM::for_table('sys_orders')
                ->where('cid', $cid)
                ->find_array();
            $ui->assign('d', $d);
            $ui->display('contacts_orders.tpl');
        } else {
        }

        break;

    case 'files':
        Event::trigger('contacts/files/');

        $cid = _post('cid');

        $ui->assign('cid', $cid);

        // find all available files for this client

        $file_ids = ORM::for_table('ib_doc_rel')
            ->where('rtype', 'contact')
            ->where('rid', $cid)
            ->find_array();

        $ids = [];

        foreach ($file_ids as $f) {
            $ids[] = $f['did'];
        }

        if (!empty($ids)) {
            $d = ORM::for_table('sys_documents')
                ->where_in('id', $ids)
                ->find_many();
        } else {
            $d = [];
        }

        // select all files

        $files = ORM::for_table('sys_documents')->find_array();

        $ui->assign('files', $files);

        $ui->assign('d', $d);

        $ui->display('contacts_files.tpl');

        break;

    case 'assign_file':
        $cid = _post('cid');

        $did = _post('did');

        // find the customer

        // check if exist

        $check = ORM::for_table('ib_doc_rel')
            ->where('rtype', 'contact')
            ->where('rid', $cid)
            ->where('did', $did)
            ->find_one();

        if ($check) {
            i_close('This file is already available for this contact.');
        }

        $d = ORM::for_table('ib_doc_rel')->create();
        $d->rtype = 'contact';
        $d->rid = $cid;
        $d->did = $did;
        $d->save();

        echo $cid;

        break;

    case 'remove_file':
        $cid = route(2);
        $did = route(3);

        $d = ORM::for_table('ib_doc_rel')
            ->where('rtype', 'contact')
            ->where('rid', $cid)
            ->where('did', $did)
            ->find_one();

        if ($d) {
            $d->delete();
        }

        r2(U . 'contacts/view/' . $cid . '/files/', 's', $_L['Data Updated']);

        break;

    case 'gen_auto_login':
        $id = route(2);

        $d = ORM::for_table('crm_accounts')->find_one($id);

        if ($d) {
            $d->autologin = Ib_Str::random_string(20) . $id . time();
            $d->save();

            r2(
                U . 'contacts/view/' . $id . '/summary/',
                's',
                $_L['Created Successfully']
            );
        } else {
            echo 'Contact Not Found.';
        }

        break;

    case 'revoke_auto_login':
        $id = route(2);

        $d = ORM::for_table('crm_accounts')->find_one($id);

        if ($d) {
            $d->autologin = '';
            $d->save();

            r2(
                U . 'contacts/view/' . $id . '/summary/',
                's',
                $_L['Data Updated']
            );
        } else {
            echo 'Contact Not Found.';
        }

        break;

    case 'modal_view_company':
        $id = route(2);
        $id = str_replace('ae', '', $id);

        $extra_links = '';

        $company = ORM::for_table('sys_companies')->find_one($id);

        if ($company) {
            $ui->assign('company', $company);

            Event::trigger('contacts/modal_view_company/');

            $ui->assign('extra_links', $extra_links);

            $ui->display('modal_view_company.tpl');
        } else {
            echo 'Company Not Found';
        }

        break;

    case 'company_memo':
        $cid = _post('cid');

        $d = ORM::for_table('sys_companies')->find_one($cid);

        if ($d) {
            echo '<textarea class="form-control" id="v_memo" name="v_memo" rows="6">' .
                $d->notes .
                '</textarea> <button type="button" id="memo_update" class="btn btn-primary btn-block mt-sm act_memo_update">' .
                $_L['Save'] .
                '</button>';
        }

        break;

    case 'company_update_notes':
        $id = _post('id');

        $d = ORM::for_table('sys_companies')->find_one($id);

        if ($d) {
            $memo = $_POST['memo'];
            $d->notes = $memo;
            $d->save();
        }

        echo $_L['Data Updated'];

        break;

    case 'company_customers':
        $cid = _post('cid');

        $customers = ORM::for_table('crm_accounts')
            ->select('id')
            ->select('account')
            ->select('email')
            ->select('phone')
            ->where('cid', $cid)
            ->find_array();

        $tr_customers = '';

        foreach ($customers as $customer) {
            $tr_customers .=
                '<tr>
         <th scope="row"><a href="' .
                U .
                'contacts/view/' .
                $customer['id'] .
                '">' .
                $customer['id'] .
                '</a></th>
         <td><a href="' .
                U .
                'contacts/view/' .
                $customer['id'] .
                '">' .
                $customer['account'] .
                '</a></td>
         <td>' .
                $customer['email'] .
                '</td>
         <td>' .
                $customer['phone'] .
                '</td>
      </tr>';
        }

        if ($tr_customers == '') {
            $tr_customers =
                '<tr><td colspan="4">' .
                $_L['No Data Available'] .
                '</td></tr>';
        }

        echo '
<h4>' .
            $_L['Customers'] .
            '</h4>
<hr>
<a class="btn btn-primary" href="' .
            U .
            'contacts/add/0/' .
            $cid .
            '">' .
            $_L['Add Customer'] .
            '</a>
<hr>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>#</th>
         <th>' .
            $_L['Name'] .
            '</th>
         <th>' .
            $_L['Email'] .
            '</th>
         <th>' .
            $_L['Phone'] .
            '</th>
      </tr>
   </thead>
   <tbody>
      ' .
            $tr_customers .
            '
   </tbody>
</table>';

        break;

    case 'company_summary':
        $cid = _post('cid');

        $cid = str_replace('ae', '', $cid);

        $d = ORM::for_table('sys_companies')->find_one($cid);

        if ($d) {
            $url = $d->url;

            if ($url == 'http://') {
                $url = '';
            }

            echo '<p>

                            <strong>' .
                $_L['Company Name'] .
                ': </strong>  ' .
                $d->company_name .
                '<br>
                            <strong>' .
                $_L['URL'] .
                ': </strong>  ' .
                $url .
                '<br>
                            <strong>' .
                $_L['Email'] .
                ': </strong>  ' .
                ($d->email != ''
                    ? '<a href="#" class="send_email">' . $d->email . '</a>'
                    : '') .
                '<br>
                            <strong>' .
                $_L['Phone'] .
                ': </strong>  ' .
                $d->phone .
                '<br>
                         
                            
                            



                        </p>

                        

                        <a href="#" class="md-btn md-btn-primary cedit" id="me' .
                $d->id .
                '"><i class="fa fa-pencil"></i> ' .
                $_L['Edit'] .
                '</a>
                        
                        
                        <hr>
                        
                        <a href="#" class="md-btn md-btn-primary li_memo"><i class="fa fa-pencil"></i> ' .
                $_L['Memo'] .
                '</a>
                        
                        <hr>
                        
                        ' .
                $d->notes .
                '
                        
                        ';
        }

        break;

    case 'company_invoices':
        $cid = _post('cid');
        $d = ORM::for_table('sys_companies')->find_one($cid);

        if ($d) {
            $customers = Contacts::findByCompany($cid);

            if ($customers) {
                $invoices = ORM::for_table('sys_invoices')
                    ->where_in('userid', $customers)
                    ->find_array();

                $dt = '';

                foreach ($invoices as $invoice) {
                    $dt .=
                        '<tr>
            <td><a href="' .
                        U .
                        'invoices/view/' .
                        $invoice['id'] .
                        '/">' .
                        $invoice['invoicenum'] .
                        ' ' .
                        ($invoice['cn'] != ''
                            ? $invoice['cn']
                            : $invoice['id']) .
                        '</a> </td>
            <td><a href="' .
                        U .
                        'contacts/view/' .
                        $invoice['userid'] .
                        '/">' .
                        $invoice['account'] .
                        '</a></td>
            <td class="amount" data-a-dec="." data-a-sep="," data-a-pad="true" data-p-sign="p" data-a-sign="$ " data-d-group="3">' .
                        $invoice['total'] .
                        '</td>
            <td>' .
                        $invoice['date'] .
                        '</td>
            <td>' .
                        $invoice['duedate'] .
                        '</td>
            <td>' .
                        $invoice['status'] .
                        '</td>
            <td>
                <a href="' .
                        U .
                        'invoices/view/' .
                        $invoice['id'] .
                        '/" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> </a>
                <a href="' .
                        U .
                        'invoices/edit/' .
                        $invoice['id'] .
                        '/" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
            </td>
        </tr>';
                }

                if ($dt == '') {
                    $tds =
                        '<tr><td colspan="7">' .
                        $_L['No Data Available'] .
                        '</td> </tr>';
                } else {
                    $tds = $dt;
                }
            } else {
                $tds =
                    '<tr><td colspan="7">' .
                    $_L['No Data Available'] .
                    '</td> </tr>';
            }

            echo '<table class="table table-bordered table-hover sys_table">
    <thead>
    <tr>
        <th>#</th>
        <th>' .
                $_L['Customer'] .
                '</th>
        <th>' .
                $_L['Amount'] .
                '</th>
        <th>' .
                $_L['Invoice Date'] .
                '</th>
        <th>' .
                $_L['Due Date'] .
                '</th>
        <th>' .
                $_L['Status'] .
                '</th>
        <th class="text-right">' .
                $_L['Manage'] .
                '</th>
    </tr>
    </thead>
    <tbody>

            
           ' .
                $tds .
                ' 
    

    </tbody>
</table>';
        }

        break;

    case 'company_quotes':
        $cid = _post('cid');
        $d = ORM::for_table('sys_companies')->find_one($cid);

        if ($d) {
            $customers = Contacts::findByCompany($cid);

            if ($customers) {
                $quotes = ORM::for_table('sys_quotes')
                    ->where_in('userid', $customers)
                    ->find_array();

                $dt = '';

                foreach ($quotes as $quote) {
                    $dt .=
                        '<tr>
            <td>' .
                        $quote['id'] .
                        ' </td>
            <td><a href="' .
                        U .
                        'contacts/view/' .
                        $quote['userid'] .
                        '/">' .
                        $quote['account'] .
                        '</a></td>
            <td><a href="' .
                        U .
                        'quotes/view/' .
                        $quote['id'] .
                        '/">' .
                        $quote['subject'] .
                        '</a></td>
            <td class="amount" data-a-dec="." data-a-sep="," data-a-pad="true" data-p-sign="p" data-a-sign="$ " data-d-group="3">' .
                        $quote['total'] .
                        '</td>
            <td>' .
                        $quote['datecreated'] .
                        '</td>
            <td>' .
                        $quote['validuntil'] .
                        '</td>
            <td>' .
                        $quote['stage'] .
                        '</td>
            <td>
                <a href="' .
                        U .
                        'quotes/view/' .
                        $quote['id'] .
                        '/" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
                <a href="' .
                        U .
                        'quotes/edit/' .
                        $quote['id'] .
                        '/" class="btn btn-info btn-xs"><i class="fa fa-repeat"></i></a>
            </td>
        </tr>';
                }

                if ($dt == '') {
                    $tds =
                        '<tr><td colspan="7">' .
                        $_L['No Data Available'] .
                        '</td> </tr>';
                } else {
                    $tds = $dt;
                }
            } else {
                $tds =
                    '<tr><td colspan="7">' .
                    $_L['No Data Available'] .
                    '</td> </tr>';
            }

            echo '<table class="table table-bordered table-hover sys_table">
    <thead>
    <tr>
        <th>#</th>
        <th>' .
                $_L['Customer'] .
                '</th>
        <th>' .
                $_L['Subject'] .
                '</th>
        <th>' .
                $_L['Amount'] .
                '</th>
        <th>' .
                $_L['Date Created'] .
                '</th>
        <th>' .
                $_L['Expiry Date'] .
                '</th>
        <th>' .
                $_L['Stage'] .
                '</th>
        <th class="text-right">' .
                $_L['Manage'] .
                '</th>
    </tr>
    </thead>
    <tbody>

            
           ' .
                $tds .
                ' 
    

    </tbody>
</table>';
        }

        break;

    case 'company_orders':
        $cid = _post('cid');
        $d = ORM::for_table('sys_companies')->find_one($cid);

        if ($d) {
            // find all customers with that company_id

            $customers = Contacts::findByCompany($cid);

            //  var_dump($invoices);

            if ($customers) {
                $orders = ORM::for_table('sys_orders')
                    ->where_in('cid', $customers)
                    ->find_array();

                $dt = '';

                foreach ($orders as $order) {
                    $dt .=
                        '<tr>
           
            <td><a href="' .
                        U .
                        'orders/view/' .
                        $order['id'] .
                        '">' .
                        $order['ordernum'] .
                        '</a> </td>
            <td>' .
                        date($config['df'], strtotime($order['date_added'])) .
                        '</td>
            <td><a href="' .
                        U .
                        'contacts/view/' .
                        $order['cid'] .
                        '">' .
                        $order['cname'] .
                        '</a> </td>
            <td>' .
                        $order['amount'] .
                        '</td>
            <td>' .
                        $order['status'] .
                        '</td>
            
            
        </tr>';
                }

                if ($dt == '') {
                    $tds =
                        '<tr><td colspan="6">' .
                        $_L['No Data Available'] .
                        '</td> </tr>';
                } else {
                    $tds = $dt;
                }
            } else {
                $tds =
                    '<tr><td colspan="6">' .
                    $_L['No Data Available'] .
                    '</td> </tr>';
            }

            echo '<table class="table table-bordered table-hover sys_table">
    <thead>
    <tr>
        
                        <th>' .
                $_L['Order'] .
                ' #</th>
                        <th>' .
                $_L['Date'] .
                '</th>
                        <th>' .
                $_L['Customer'] .
                '</th>
                        <th>' .
                $_L['Total'] .
                '</th>
                        <th>' .
                $_L['Status'] .
                '</th>
                        
    </tr>
    </thead>
    <tbody>

            
           ' .
                $tds .
                ' 
    

    </tbody>
</table>';
        }

        break;

    case 'company_files':
        break;

    case 'company_transactions':
        $cid = _post('cid');
        $d = ORM::for_table('sys_companies')->find_one($cid);

        if ($d) {
            // find all customers with that company_id

            $customers = Contacts::findByCompany($cid);

            //  var_dump($invoices);

            if ($customers) {
                $transactions_payer = ORM::for_table('sys_transactions')
                    ->where_in('payerid', $customers)
                    ->find_array();
                $transactions_payee = ORM::for_table('sys_transactions')
                    ->where_in('payeeid', $customers)
                    ->find_array();

                $transactions = array_merge(
                    $transactions_payer,
                    $transactions_payee
                );

                $dt = '';

                foreach ($transactions as $transaction) {
                    $dt .=
                        '<tr>
            <td>' .
                        $transaction['id'] .
                        ' </td>
            <td>' .
                        $transaction['date'] .
                        '</td>
            <td>' .
                        $transaction['account'] .
                        '</td>
            <td>' .
                        $transaction['type'] .
                        '</td>
          
            <td class="amount" data-a-dec="." data-a-sep="," data-a-pad="true" data-p-sign="p" data-a-sign="$ " data-d-group="3">' .
                        $transaction['amount'] .
                        '</td>
            <td>' .
                        $transaction['description'] .
                        '</td>
            <td>' .
                        $transaction['dr'] .
                        '</td>
            <td>' .
                        $transaction['cr'] .
                        '</td>
            <td>' .
                        $transaction['bal'] .
                        '</td>
            <td>
                <a href="' .
                        U .
                        'transactions/manage/' .
                        $transaction['id'] .
                        '/" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
                
            </td>
        </tr>';
                }

                if ($dt == '') {
                    $tds =
                        '<tr><td colspan="7">' .
                        $_L['No Data Available'] .
                        '</td> </tr>';
                } else {
                    $tds = $dt;
                }
            } else {
                $tds =
                    '<tr><td colspan="7">' .
                    $_L['No Data Available'] .
                    '</td> </tr>';
            }

            echo '<table class="table table-bordered table-hover sys_table">
    <thead>
    <tr>
        <th>#</th>
        <th>' .
                $_L['Date'] .
                '</th>
        <th>' .
                $_L['Account'] .
                '</th>
        <th>' .
                $_L['Type'] .
                '</th>
        <th>' .
                $_L['Amount'] .
                '</th>
        <th>' .
                $_L['Description'] .
                '</th>
        <th>' .
                $_L['Dr'] .
                '</th>
        <th>' .
                $_L['Cr'] .
                '</th>
        <th>' .
                $_L['Balance'] .
                '</th>
        <th class="text-right">' .
                $_L['Manage'] .
                '</th>
    </tr>
    </thead>
    <tbody>

            
           ' .
                $tds .
                ' 
    

    </tbody>
</table>';
        }

        break;

    default:
        echo 'action not defined';
}
