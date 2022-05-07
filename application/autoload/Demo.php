<?php

use Faker\Provider\DateTime;

class Demo
{
    public static function reset()
    {
        DB::table('crm_accounts')->truncate();

        DB::table('sys_accounts')->truncate();

        DB::table('sys_invoices')->truncate();
        DB::table('sys_invoiceitems')->truncate();
        DB::table('sys_quotes')->truncate();
        DB::table('sys_quoteitems')->truncate();
        DB::table('sys_api')->truncate();
        DB::table('crm_groups')->truncate();
        DB::table('sys_currencies')->truncate();
        DB::table('sys_transactions')->truncate();
        DB::table('sys_companies')->truncate();
        DB::table('sys_items')->truncate();
        DB::table('sys_logs')->truncate();
        DB::table('sys_orders')->truncate();
    }

    private static function genPhone($country)
    {
        $phone = '';

        $start = ['016', '017', '018', '019'];

        if ($country == 'bd') {
            $phone = $start[array_rand($start)] . _raid(8);
        }

        return $phone;
    }

    private static function genEmail($name)
    {
        $email = '';

        $domain = ['gmail.com', 'yahoo.com', 'hotmail.com'];

        $name = str_replace(' ', '', $name);
        $name = str_replace('Mr', '', $name);
        $name = str_replace('Mrs', '', $name);
        $name = str_replace('.', '', $name);

        $email = $name . '@' . $domain[array_rand($domain)];

        return $email;
    }

    public static function makeReady($country = '')
    {
        $today = date('Y-m-d');

        $today_time = date('Y-m-d H:i:s');

        $gname = 'Default';

        switch ($country) {
            default:
                $faker = Faker\Factory::create();

                $group = new ContactGroup();
                $group->gname = $gname;
                $group->save();

                $currency = new Currency();
                $currency->cname = 'USD';
                $currency->iso_code = 'USD';
                $currency->symbol = '$';
                $currency->save();

                // create companies

                $c_emails_types = [
                    'sales',
                    'info',
                    'admin',
                    'hello',
                    'media',
                    'support',
                    'billing',
                ];

                for ($i = 0; $i < 144; $i++) {
                    shuffle($c_emails_types);

                    $company = new Company();

                    $company_name = $faker->company;

                    $company_domain = strtolower($company_name);
                    $company_domain = str_replace(' ', '', $company_domain);
                    $company_domain = str_replace('.', '', $company_domain);
                    $company_domain = str_replace(',', '', $company_domain);
                    $company_domain = str_replace('-', '', $company_domain);
                    $company_domain = $company_domain . '.com';
                    $company_email = $c_emails_types[0] . '@' . $company_domain;

                    $company->company_name = $faker->company;
                    $company->email = $company_email;
                    $company->phone =
                        '1-' . _raid(3) . '-' . _raid(3) . '-' . _raid(4);

                    $company->url = 'http://www.' . $company_domain;

                    $company->save();
                }

                update_option('CompanyName', 'CloudOnex LLC.');
                update_option('nstyle', 'dark');
                update_option('currency_code', '$');
                update_option('country', 'United States');
                update_option('country_flag_code', 'us');
                update_option('timezone', 'America/New_York');
                update_option('df', 'Y-m-d');
                update_option('home_currency', 'USD');
                update_option('momentLocale', 'en');
                update_option('language', 'en');
                update_option(
                    'caddress',
                    'CloudOnex <br>1101 Marina Villae Parkway, Suite 201<br>Alameda, California 94501<br>United State'
                );

                update_option('graph_primary_color', '2196f3');

                update_option('edition', 'default');

                update_option('dec_point', '.');
                update_option('thousands_sep', ',');

                update_option('networth_goal', '350000');

                update_option('logo_default', 'logo.png');
                update_option('logo_inverse', 'logo_white.png');

                $user = User::find(1);

                $user->language = 'en';

                $user->fullname = 'Richard Williams';

                $user->img = APP_URL . '/storage/dev/user1.jpg';

                $user->save();

                $_SESSION['language'] = 'en';

                $companies = Company::all()->toArray();

                for ($i = 0; $i < 293; $i++) {
                    shuffle($companies);

                    $c = new Contact();

                    $c->account = $faker->name;
                    $c->fname = '';
                    $c->jobtitle = '';
                    $c->lname = '';
                    $c->email = $faker->email;
                    $c->phone =
                        '1-' . _raid(3) . '-' . _raid(3) . '-' . _raid(4);
                    $c->company = $companies[0]['company_name'];

                    $c->cid = $companies[0]['id'];

                    $c->gid = 1;
                    $c->gname = $gname;

                    $c->address = $faker->streetAddress;
                    $c->city = $faker->city;
                    $c->state = $faker->state;
                    $c->zip = $faker->postcode;
                    $c->country = $faker->country;
                    $c->lat = $faker->latitude;
                    $c->lon = $faker->longitude;

                    $c->balance = 0.0;

                    $c->notes = '';
                    $c->tags = '';

                    $c->password = Password::_crypt('123456');
                    $c->token = '';
                    $c->ts = '';
                    $c->img = '';
                    $c->web = '';
                    $c->facebook = '';
                    $c->google = '';
                    $c->linkedin = '';

                    $c->save();
                }

                // create banks

                $banks = [
                    [
                        'name' => 'JPMorgan Chase & Co.',
                    ],
                    [
                        'name' => 'HSBC',
                    ],
                    [
                        'name' => 'Standard Chartered',
                    ],
                    [
                        'name' => 'Cash',
                    ],
                    [
                        'name' => 'City Bank',
                    ],
                ];

                foreach ($banks as $bank) {
                    $account = new Account();
                    $account->account = $bank['name'];
                    $account->bank_name = $bank['name'];
                    $account->balance = _raid(5);
                    $account->description = '';
                    $account->save();
                }

                // Generate Transactions

                $tr_incomes = [
                    [
                        'description' => 'Sales',
                        'amount' => 5400,
                    ],
                    [
                        'description' => 'Music Lessons',
                        'amount' => 1800,
                    ],
                    [
                        'description' => 'Software Development',
                        'amount' => 2500,
                    ],
                    [
                        'description' => 'Web Development',
                        'amount' => 1500,
                    ],
                    [
                        'description' => 'Consultancy',
                        'amount' => 4000,
                    ],
                    [
                        'description' => 'Interest',
                        'amount' => 700,
                    ],
                ];

                $transactionMethod = TransactionMethod::all()->toArray();

                for ($i = 0; $i < 723; $i++) {
                    shuffle($banks);
                    shuffle($tr_incomes);
                    shuffle($transactionMethod);

                    $method = $transactionMethod[0]['name'];

                    if ($method == 'Cash') {
                        $ref = 'Office / Store Desk';
                    } elseif ($method == 'Check') {
                        $ref = 'Check Number- ' . _raid(4) . '-' . _raid(8);
                    } elseif ($method == 'Credit Card') {
                        $ref =
                            $faker->creditCardType . ' - ' . '****' . _raid(4);
                    } else {
                        $ref =
                            'Transaction ID- ' .
                            strtoupper(Ib_Str::random_string(17));
                    }

                    $transaction = new Transaction();
                    $transaction->account = $banks[0]['name'];
                    $transaction->description = $tr_incomes[0]['description'];
                    $transaction->amount = $tr_incomes[0]['amount'];
                    $transaction->cr = $tr_incomes[0]['amount'];
                    $transaction->date = $faker->dateTimeBetween(
                        $startDate = '-1 year',
                        $endDate = '+3 month'
                    );

                    $transaction->type = 'Income';

                    $transaction->vid = _raid(8);

                    $transaction->ref = $ref;
                    $transaction->method = $method;
                    $transaction->aid = 1;

                    $transaction->save();
                }

                // for categories chart

                $categories = TransactionCategory::expense();

                $cat_amounts = [
                    297523,
                    12189,
                    3290,
                    54782,
                    323459,
                    19220,
                    2145,
                    723,
                    182,
                    4198,
                    5289,
                    39902,
                    2678,
                    229,
                    820,
                    2678,
                    9379,
                    14890,
                    3802,
                    18903,
                    5782,
                    45782,
                    27834,
                    9492,
                    2784,
                    28549,
                    3882,
                    38290,
                    932,
                    56,
                    28820,
                    38400,
                    922,
                    39273,
                    7123,
                    81267,
                    47200,
                    37892,
                    1792,
                    3971,
                    37293,
                    2748,
                    27849,
                ];

                $i = 0;

                foreach ($categories as $category) {
                    $category->total_amount = $cat_amounts[$i];
                    $category->save();

                    $i++;
                }

                // Generate Expense

                $tr_expenses = [
                    [
                        'description' => 'Salaries',
                        'amount' => 5400,
                    ],
                    [
                        'description' => 'Freight',
                        'amount' => 1800,
                    ],
                    [
                        'description' => 'Travel',
                        'amount' => 2500,
                    ],
                    [
                        'description' => 'Phone',
                        'amount' => 1500,
                    ],
                    [
                        'description' => 'Consultancy',
                        'amount' => 4000,
                    ],
                    [
                        'description' => 'Bank Fees',
                        'amount' => 700,
                    ],
                ];

                for ($i = 0; $i < 393; $i++) {
                    shuffle($banks);
                    shuffle($tr_expenses);

                    shuffle($transactionMethod);

                    $method = $transactionMethod[0]['name'];

                    if ($method == 'Cash') {
                        $ref = 'Office / Store Desk';
                    } elseif ($method == 'Check') {
                        $ref = 'Check Number- ' . _raid(4) . '-' . _raid(8);
                    } elseif ($method == 'Credit Card') {
                        $ref =
                            $faker->creditCardType . ' - ' . '****' . _raid(4);
                    } else {
                        $ref =
                            'Transaction ID- ' .
                            strtoupper(Ib_Str::random_string(17));
                    }

                    $transaction = new Transaction();
                    $transaction->account = $banks[0]['name'];
                    $transaction->description = $tr_expenses[0]['description'];
                    $transaction->amount = $tr_expenses[0]['amount'];
                    $transaction->dr = $tr_expenses[0]['amount'];
                    $transaction->date = $faker->dateTimeBetween(
                        $startDate = '-1 year',
                        $endDate = '+3 months'
                    );

                    $transaction->type = 'Expense';

                    $transaction->vid = _raid(8);

                    $transaction->method = $method;

                    $transaction->ref = $ref;

                    $transaction->aid = 1;

                    $transaction->save();
                }

                $customer = new Contact();

                $customer_name = 'Maria Elizabeth';

                $customer->token = '';
                $customer->ts = '';
                $customer->web = '';
                $customer->facebook = '';
                $customer->google = '';
                $customer->linkedin = '';
                $customer->jobtitle = '';
                $customer->notes = '';
                $customer->tags = '';

                $customer_email = 'customer@example.com';

                $customer->account = $customer_name;

                $customer->fname = '';
                $customer->lname = '';

                $customer->img = APP_URL . '/storage/dev/user2.png';

                $customer->password = '$1$WN..nD2.$Vo9niDl/fUf0VhheEjmHe/';

                $customer->email = $customer_email;
                $customer->phone =
                    '1-' . _raid(3) . '-' . _raid(3) . '-' . _raid(4);

                $customer->company = 'StackRent';

                $customer->balance = '0.00';

                $customer->cid = 1;

                $customer->gid = 1;

                $customer->gname = $gname;

                $customer->address = '28th Floor, 1325 6th Avenue';
                $customer->city = 'New York';
                $customer->state = 'NY';
                $customer->zip = '10019';
                $customer->country = 'United States';
                $customer->lat = '40.762901';
                $customer->lon = '-73.980733';

                $customer->autologin = '15aoqoa8mv07htq4hp4z2941506859446';

                $customer->save();

                $customer_id = $customer->id;

                $card_ref = $faker->creditCardType . ' - ' . '****' . _raid(4);

                DB::insert(
                    'INSERT INTO sys_invoices (userid, account, cn, invoicenum, date, duedate, datepaid, subtotal, discount_type, discount_value, discount, credit, taxname, tax, tax2, total, taxrate, taxrate2, status, paymentmethod, notes, vtoken, ptoken, r, nd, eid, ename, vid, currency, currency_symbol, currency_prefix, currency_suffix, currency_rate, recurring, recurring_ends, last_recurring_date, source, sale_agent, last_overdue_reminder, allowed_payment_methods, billing_street, billing_city, billing_state, billing_zip, billing_country, shipping_street, shipping_city, shipping_state, shipping_zip, shipping_country, q_hide, show_quantity_as, pid, is_credit_invoice, aid, aname) VALUES (' .
                        $customer_id .
                        ', \'' .
                        $customer_name .
                        '\', \'\', \'\', \'' .
                        $today .
                        '\', \'' .
                        $today .
                        '\', \'' .
                        $today_time .
                        '\', 144.00, \'f\', 0.00, 0.00, 0.00, \'\', 0.00, 0.00, 144.00, 0.00, 0.00, \'Paid\', \'\', \'\', \'0738541991\', \'7715021517\', \'0\', \'' .
                        $today .
                        '\', 0, \'\', 0, 1, \'$\', null, null, 1.0000, 0, null, null, null, 0, null, null, null, null, null, null, null, null, null, null, null, null, 0, \'\', 0, 1, 0, null), (' .
                        $customer_id .
                        ', \'' .
                        $customer_name .
                        '\', \'\', \'\', \'' .
                        $today .
                        '\', \'' .
                        $today .
                        '\', \'' .
                        $today_time .
                        '\', 2000.00, \'f\', 200.00, 200.00, 0.00, \'Sales Tax\', 300.00, 0.00, 2100.00, 15.00, 0.00, \'Unpaid\', \'\', \'\', \'4491605289\', \'9317090421\', \'0\', \'' .
                        $today .
                        '\', 0, \'\', 0, 1, \'$\', null, null, 1.0000, 0, null, null, null, 0, null, null, null, null, null, null, null, null, null, null, null, null, 0, \'\', 0, 0, 0, null), (' .
                        $customer_id .
                        ', \'' .
                        $customer_name .
                        '\', \'\', \'\', \'' .
                        $today .
                        '\', \'' .
                        $today .
                        '\', \'' .
                        $today_time .
                        '\', 149.00, \'p\', 0.00, 0.00, 149.00, \'\', 0.00, 0.00, 149.00, 0.00, 0.00, \'Paid\', \'\', \'\', \'3559815740\', \'6479179633\', \'0\', \'2017-09-23\', 0, \'\', 0, 1, \'$\', null, null, 1.0000, 0, null, null, null, 0, null, null, null, null, null, null, null, null, null, null, null, null, 0, null, 0, 0, 0, null)'
                );

                DB::insert(
                    'INSERT INTO sys_invoiceitems (invoiceid, userid, type, relid, itemcode, description, qty, amount, taxed, taxamount, total, duedate, paymentmethod, notes) 
VALUES (1, ' .
                        $customer_id .
                        ', \'\', 0, \'\', \'Credit\', \'1\', 144.00, 0, 0.00, 144.00, \'' .
                        $today .
                        '\', \'\', \'\'),
  (2, ' .
                        $customer_id .
                        ', \'\', 0, \'\', \'API Integration\', \'1\', 400.00, 1, 0.00, 400.00, \'' .
                        $today .
                        '\', \'\', \'\'),
(2, ' .
                        $customer_id .
                        ', \'\', 0, \'\', \'UI & UX Design\', \'1\', 400.00, 1, 0.00, 400.00, \'' .
                        $today .
                        '\', \'\', \'\'),
(2, ' .
                        $customer_id .
                        ', \'\', 0, \'\', \'Project Research & Familiarization\', \'1\', 700.00, 1, 0.00, 700.00, \'' .
                        $today .
                        '\', \'\', \'\'),
(2, ' .
                        $customer_id .
                        ', \'\', 0, \'\', \'Meeting, Preparation of Documents & Strategic Planning\', \'1\', 500.00, 1, 0.00, 500.00, \'' .
                        $today .
                        '\', \'\', \'\'),
(3, ' .
                        $customer_id .
                        ', \'\', 0, \'\', \'Web Hosting / Yearly\', \'1\', 149.00, 0, 0.00, 149.00, \'' .
                        $today .
                        '\', \'\', \'\')'
                );

                DB::insert(
                    'INSERT INTO sys_transactions (account, type,  category, amount, payer, payee, payerid, payeeid, method, ref, status, description, tags, tax, date, dr, cr, bal, iid, currency, currency_symbol, currency_prefix, currency_suffix, currency_rate, base_amount, company_id, vid, aid, created_at, updated_at, updated_by, attachments, source, rid, pid, archived, trash, flag, c1, c2, c3, c4, c5) VALUES (\'Cash\', \'Income\', \'Uncategorized\', 144.00, \'' .
                        $customer_name .
                        '\', \'\', ' .
                        $customer_id .
                        ', 0, \'Credit Card\', \'' .
                        $card_ref .
                        '\', \'Cleared\', \'Invoice 1 Payment\', \'\', 0.00, \'2017-09-23\', 0.00, 144.00, 0.00, 1, 1, \'USD\', null, null, 1.0000, 0.0000, 0, ' .
                        _raid(8) .
                        ', 0, \'2017-09-23 15:19:56\', \'2017-09-23 09:19:56\', 0, null, null, 0, 0, 0, 0, 0, null, null, null, null, null), (\'JPMorgan Chase & Co.\', \'Income\', \'Uncategorized\', 149.00, \'' .
                        $customer_name .
                        '\', \'\', ' .
                        $customer_id .
                        ', 0, \'Paypal\', \'Transaction ID- ' .
                        strtoupper(Ib_Str::random_string(17)) .
                        '\', \'Cleared\', \'Invoice 3 Payment\', \'\', 0.00, \'2017-09-23\', 0.00, 149.00, 0.00, 3, 1, \'USD\', null, null, 1.0000, 0.0000, 0, ' .
                        _raid(8) .
                        ', 0, \'2017-09-23 15:22:00\', \'2017-09-23 09:22:00\', 0, null, null, 0, 0, 0, 0, 0, null, null, null, null, null)'
                );

                DB::insert('INSERT INTO sys_items (name, unit, sales_price, inventory, weight, width, length, height, sku, upc, ean, mpn, isbn, sid, supplier, bid, brand, sell_account, purchase_account, inventory_account, taxable, location, item_number, description, type, track_inventroy, negative_stock, available, status, added, last_sold, e, sorder, gid, category_id, supplier_id, gname, product_id, size, start_date, end_date, expire_date, expire_days, image, flag, is_service, commission_percent, commission_percent_type, commission_fixed, trash, payterm, cost_price, unit_price, promo_price, setup, onetime, monthly, monthlysetup, quarterly, quarterlysetup, halfyearly, halfyearlysetup, annually, annuallysetup, biennially, bienniallysetup, triennially, trienniallysetup, has_domain, free_domain, email_rel, tags, sold_count, total_amount, created_at, updated_at) VALUES (\'T-Shirt with AmarBiz Logo\', \'\', 150.00, -2.0000, 0.0000, 0.0000, 0.0000, 0.0000, null, null, null, null, null, 0, null, 0, null, 0, 0, 0, 0, null, \'0001\', \'\', \'Product\', \'No\', \'No\', 0, \'Active\', null, null, \'\', 0, 0, 0, 0, null, null, null, null, null, null, 0, \'_c4b43ae0870238150617433711107582.png\', 0, 0, 0.00, null, 0.00, 0, null, 110.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, null, null, 0, null, 8.0000, 155.0000, null, \'2017-10-04 18:46:13\'),
(\'Golf Hat\', \'\', 120.00, -2.0000, 0.0000, 0.0000, 0.0000, 0.0000, null, null, null, null, null, 0, null, 0, null, 0, 0, 0, 0, null, \'0002\', \'\', \'Product\', \'No\', \'No\', 0, \'Active\', null, null, \'\', 0, 0, 0, 0, null, null, null, null, null, null, 0, \'_7a0c1035255988150617492810876737.png\', 0, 0, 0.00, null, 0.00, 0, null, 70.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, null, null, 0, null, 9.0000, 108.0000, null, \'2017-10-04 18:46:13\'),
(\'Gift Card 250\', \'\', 250.00, -2.0000, 0.0000, 0.0000, 0.0000, 0.0000, null, null, null, null, null, 0, null, 0, null, 0, 0, 0, 0, null, \'0003\', \'\', \'Product\', \'No\', \'No\', 0, \'Active\', null, null, \'\', 0, 0, 0, 0, null, null, null, null, null, null, 0, \'_7ae11af2868642150642538311023612.png\', 0, 0, 0.00, null, 0.00, 0, null, 250.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, null, null, 0, null, 6.0000, 1500.0000, null, \'2017-10-04 18:46:13\')');

                break;
        }

        // after demo ready

        if (APP_URL == 'http://demo.tryib.com') {
            update_option('c_cache', 'c5d290ed06d60879b7226b804fb13691');
        } elseif (APP_URL == 'http://ibc.dev/ibilling') {
            update_option('c_cache', 'bf062fbb10db24f4898a83a9dcb20180');
        } else {
        }
    }
}
