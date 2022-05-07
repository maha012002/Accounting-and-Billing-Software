<?php

$ui->assign('latest_build', $file_build);
// Enable Error Reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
$msg = '';

$d = ORM::for_table('sys_pl')
    ->raw_query("SHOW COLUMNS FROM sys_pl LIKE 'name'")
    ->find_one();

if ($d) {
    $r = ORM::for_table('sys_pl')->raw_execute(
        "ALTER TABLE sys_pl DROP name, DROP url, DROP icon"
    );
    $msg .= 'Updated sys_pl table
';
}

$d = ORM::for_table('crm_accounts')
    ->raw_query("SHOW TABLES LIKE 'crm_customfields'")
    ->find_one();

if (!$d) {
    $r = ORM::for_table('crm_accounts')
        ->raw_execute("CREATE TABLE IF NOT EXISTS crm_customfields (
id int(10) NOT NULL AUTO_INCREMENT,
  ctype text,
  relid int(10) NOT NULL DEFAULT '0',
  fieldname text,
  fieldtype text,
  description text,
  fieldoptions text,
  regexpr text,
  adminonly text,
  required text,
  showorder text,
  showinvoice text,
  sorder int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY ( id )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

    $msg .= 'Created table crm_customfields
';
}

$d = ORM::for_table('crm_accounts')
    ->raw_query("SHOW TABLES LIKE 'crm_customfieldsvalues'")
    ->find_one();

if (!$d) {
    $r = ORM::for_table('crm_accounts')
        ->raw_execute("CREATE TABLE IF NOT EXISTS crm_customfieldsvalues (
  id int(10) NOT NULL AUTO_INCREMENT,
  fieldid int(10) NOT NULL,
  relid int(10) NOT NULL,
  fvalue text NOT NULL,
  PRIMARY KEY ( id )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

    $msg .= 'Created table crm_customfieldsvalues
';
}

if (add_option('build', $file_build)) {
    $msg .= 'Build Row Created
';
}

if (get_option('build') != $file_build) {
    update_option('build', $file_build);
    $msg .=
        'Build Updated to: ' .
        $file_build .
        '
';
}

$d = ORM::for_table('sys_invoices')
    ->raw_query("SHOW COLUMNS FROM sys_invoices LIKE 'discount'")
    ->find_one();

if (!$d) {
    $r = ORM::for_table('sys_invoices')->raw_execute(
        "ALTER TABLE sys_invoices ADD discount DECIMAL(14,2) NOT NULL DEFAULT '0.00' AFTER subtotal"
    );
    $r = ORM::for_table('sys_invoices')->raw_execute(
        "ALTER TABLE sys_invoices ADD discount_value DECIMAL(14,2) NOT NULL DEFAULT '0.00' AFTER subtotal"
    );
    $r = ORM::for_table('sys_invoices')->raw_execute(
        "ALTER TABLE sys_invoices ADD discount_type VARCHAR(1) NOT NULL DEFAULT 'f' AFTER subtotal"
    );

    $msg .= 'Discount Column Created in Invoice Table
';
}

if (add_option('animate', '1')) {
    $msg .= 'Animate Row Created
';
}

if (add_option('pdf_font', 'dejavusanscondensed')) {
    $msg .= 'Font Row Created
';
}

/*
 * @ From v 2.3
 */

$d = ORM::for_table('crm_customfields')
    ->where('ctype', '')
    ->find_many();
foreach ($d as $ds) {
    $x = ORM::for_table('crm_customfields')->find_one($ds['id']);
    $x->ctype = 'crm';
    $x->save();
    $msg .=
        'ctype changed for ' .
        $ds['fieldname'] .
        '
';
}

/*
 * @ From v 2.4
 */

// Added for Settings -> Choose Features

if (add_option('accounting', '1')) {
    $msg .= 'accounting Row Created
';
}

if (add_option('invoicing', '1')) {
    $msg .= 'invoicing Row Created
';
}

if (add_option('quotes', '1')) {
    $msg .= 'quotes Row Created
';
}

if (add_option('client_dashboard', '1')) {
    $msg .= 'client_dashboard Row Created
';
}

//creating table for quote

$d = ORM::for_table('crm_accounts')
    ->raw_query("SHOW TABLES LIKE 'sys_quotes'")
    ->find_one();

if (!$d) {
    $r = ORM::execute("
    CREATE TABLE IF NOT EXISTS sys_quotes (
id int(10) NOT NULL AUTO_INCREMENT,
subject text NOT NULL,
stage enum('Draft','Delivered','On Hold','Accepted','Lost','Dead') NOT NULL,
validuntil date NOT NULL,
userid int(10) NOT NULL,
invoicenum text NOT NULL,
cn text NOT NULL,
account text NOT NULL,
firstname text NOT NULL,
lastname text NOT NULL,
companyname text NOT NULL,
email text NOT NULL,
address1 text NOT NULL,
address2 text NOT NULL,
city text NOT NULL,
state text NOT NULL,
postcode text NOT NULL,
country text NOT NULL,
phonenumber text NOT NULL,
currency int(10) NOT NULL,
subtotal decimal(10,2) NOT NULL,
discount_type text NOT NULL,
discount_value decimal(10,2) NOT NULL,
discount decimal(10,2) NOT NULL,
taxname text NOT NULL,
taxrate decimal(10,2) NOT NULL,
tax1 decimal(10,2) NOT NULL,
tax2 decimal(10,2) NOT NULL,
total decimal(10,2) NOT NULL,
proposal text NOT NULL,
customernotes text NOT NULL,
adminnotes text NOT NULL,
datecreated date NOT NULL,
lastmodified date NOT NULL,
datesent date NOT NULL,
dateaccepted date NOT NULL,
vtoken text NOT NULL,
PRIMARY KEY ( id )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000
    ");

    $msg .= 'Created table sys_quotes
';

    $r = ORM::execute("CREATE TABLE IF NOT EXISTS sys_quoteitems (
id int(10) NOT NULL AUTO_INCREMENT,
qid int(10) NOT NULL,
itemcode text NOT NULL,
description text NOT NULL,
qty text NOT NULL,
amount decimal(10,2) NOT NULL,
discount decimal(10,2) NOT NULL,
total decimal(10,2) NOT NULL,
taxable int(1) NOT NULL,
PRIMARY KEY ( id )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
 ");

    $msg .= 'Created table sys_quoteitems
';
}

$d = ORM::for_table('sys_email_templates')
    ->where('tplname', 'Quote:Quote Created')
    ->find_one();
if (!$d) {
    ORM::execute("INSERT INTO sys_email_templates (tplname, language_id, subject, message, send, core, hidden) VALUES
('Quote:Quote Created', 1, '{{quote_subject}}', '<div style=\"line-height:1.6;color:#222;text-align:left;width:550px;font-size:10pt;margin:0px 10px;font-family:verdana,sans-serif;padding:14px;border:3px solid #d8d8d8;border-top:3px solid #007bc3\"><div style=\"padding:5px;font-size:11pt;font-weight:bold\">   Greetings,</div>  <div style=\"padding:5px\">   Dear {{contact_name}},&nbsp;<br> Here is the quote you requested for.  The quote is valid until {{valid_until}}.  </div><div style=\"padding:10px 5px\">    Quote Unique URL: <a href=\"{{quite_url}}\" target=\"_blank\">{{quote_url}}</a><br></div><div style=\"padding:5px\"><span style=\"font-size: 13.3333330154419px; line-height: 21.3333320617676px;\">You may view the quote at any time and simply reply to this email with any further questions or requirement.</span><br></div><div style=\"padding:0px 5px\">  <div>Best Regards,<br>{{business_name}} Team</div></div></div>', 'Yes', 'Yes', 0)
");

    $msg .= 'Quote Email Template Created
';
}

$d = ORM::for_table('sys_invoices')
    ->raw_query("SHOW COLUMNS FROM sys_invoices LIKE 'cn'")
    ->find_one();

if (!$d) {
    ORM::execute(
        "ALTER TABLE sys_invoices ADD cn VARCHAR(100) NOT NULL DEFAULT '' AFTER account"
    );

    $msg .= 'Custom Invoice Number Column Created in Invoice Table
';
}

// Braintree and ccavenue Payment Gateway from v2.4

// INSERT INTO sys_pg (name, settings, value, processor, ins, c1, c2, c3, c4, c5, status, sorder) VALUES('Braintree', 'Merchant ID', 'your merchant id', 'braintree', '', 'your public key', 'your private key', 'bank account', 'sandbox', '', 'Active', 5);
$d = ORM::for_table('sys_pg')
    ->where('processor', 'braintree')
    ->find_one();

if (!$d) {
    ORM::execute(
        "INSERT INTO sys_pg (name, settings, value, processor, ins, c1, c2, c3, c4, c5, status, sorder) VALUES('Braintree', 'Merchant ID', 'your merchant id', 'braintree', '', 'your public key', 'your private key', 'bank account', 'sandbox', '', 'Inactive', 5)"
    );
    ORM::execute(
        "INSERT INTO sys_pg (name, settings, value, processor, ins, c1, c2, c3, c4, c5, status, sorder) VALUES('CCAvenue', 'Merchant ID', 'your merchant id', 'ccavenue', '', 'insert working key here', 'INR', '1', '', '', 'Inactive', 6)"
    );

    $msg .= 'PG 2.4 Rows created
';
}

// =============================================== V 3.0.0 ===============================================

// For API support

$d = ORM::for_table('crm_accounts')
    ->raw_query("SHOW TABLES LIKE 'sys_api'")
    ->find_one();

if (!$d) {
    $t = new Schema('sys_api');
    $t->add('label');
    $t->add('ip');
    $t->add('apikey');
    $t->save();

    $msg .= 'API Table is created
';
}

if (add_option('contact_set_view_mode', 'card')) {
    $msg .= 'contact_set_view_mode Row Created
';
}

// End ==================================

// Version 3.2

if (file_exists('application/controllers/cases.php')) {
    unlink('application/controllers/cases.php');
}

if (file_exists('application/controllers/notes.php')) {
    unlink('application/controllers/notes.php');
}

// Version 3.3

if (add_option('invoice_terms', '')) {
    $msg .= 'Invoice Terms Row Created
';
}

if (add_option('console_notify_invoice_created', '0')) {
    $msg .= 'console_notify_invoice_created Row Created
';
}

// Version 3.4

if (add_option('i_driver', 'v2')) {
    $msg .= 'i_driver Row Created
';
}

// Version 3.6

$d = ORM::for_table('sys_invoices')
    ->raw_query("SHOW COLUMNS FROM sys_invoices LIKE 'eid'")
    ->find_one();

if (!$d) {
    ORM::execute(
        "ALTER TABLE sys_invoices ADD eid INT(10) NOT NULL DEFAULT '0' AFTER nd, ADD ename VARCHAR(200) NOT NULL DEFAULT '' AFTER eid"
    );

    $msg .= 'Emp Column Created in Invoice Table
';
}

// v 4.0

// create purchase key row

if (add_option('purchase_code', '')) {
    $msg .= 'Purchase Code Row is Created
';
}

if (add_option('c_cache', '')) {
    $msg .= 'Cache Row is Created
';
}

if (add_option('mininav', '0')) {
    $msg .= 'Mini Navbar Row is Created
';
}

if (add_option('hide_footer', '0')) {
    $msg .= 'Hide Footer Row is Created
';
}

if (add_option('design', 'default')) {
    $msg .= 'Design row is created
';
}

$d = ORM::for_table('sys_accounts')
    ->raw_query("SHOW COLUMNS FROM sys_accounts LIKE 'bank_name'")
    ->find_one();

if (!$d) {
    ORM::execute(
        "ALTER TABLE sys_accounts ADD bank_name VARCHAR(200) NULL DEFAULT NULL, ADD account_number VARCHAR(200) NULL DEFAULT NULL, ADD currency VARCHAR(20) NULL DEFAULT NULL, ADD branch VARCHAR(200) NULL DEFAULT NULL, ADD address VARCHAR(200) NULL DEFAULT NULL, ADD contact_person VARCHAR(200) NULL DEFAULT NULL, ADD contact_phone VARCHAR(100) NULL DEFAULT NULL, ADD website VARCHAR(200) NULL DEFAULT NULL, ADD ib_url VARCHAR(200) NULL DEFAULT NULL, ADD created DATE NULL DEFAULT NULL, ADD notes TEXT NULL DEFAULT NULL, ADD sorder INT(11) NULL DEFAULT NULL, ADD e VARCHAR(200) NULL DEFAULT NULL, ADD token VARCHAR(200) NULL DEFAULT NULL, ADD status VARCHAR(200) NULL DEFAULT NULL"
    );

    $msg .= 'Accounts table altered
';
}

// V 4.1

if (add_option('default_landing_page', 'login')) {
    $msg .= 'Default landing page row is created
';
}

$d = ORM::for_table('sys_pg')
    ->raw_query("SHOW COLUMNS FROM sys_pg LIKE 'logo'")
    ->find_one();

if (!$d) {
    $r = ORM::for_table('sys_invoices')->raw_execute(
        "ALTER TABLE sys_pg ADD logo VARCHAR (200), ADD mode VARCHAR (200)"
    );

    $msg .= 'Sys_pg altered.
';
}

$d = ORM::for_table('crm_accounts')
    ->raw_query("SHOW COLUMNS FROM crm_accounts LIKE 'tax_number'")
    ->find_one();

if (!$d) {
    $r = ORM::for_table('crm_accounts')->raw_execute("
ALTER TABLE crm_accounts
ADD twitter VARCHAR (100),
ADD skype VARCHAR (100),
 ADD tax_number VARCHAR (100),
  ADD entity_number VARCHAR (100),
  ADD currency  VARCHAR (50),
  ADD pmethod VARCHAR (100),
  ADD autologin VARCHAR (100),
  ADD lastlogin datetime,
  ADD lastloginip VARCHAR (100),
  ADD stage VARCHAR (50),
  ADD timezone VARCHAR (50),
  ADD isp VARCHAR (100),
  ADD lat VARCHAR (50),
  ADD lon VARCHAR (50),
  ADD gname VARCHAR (200),
  ADD gid INT (11) NOT NULL DEFAULT '0',
  ADD sid VARCHAR (200),
  ADD role VARCHAR (200),
  ADD country_code VARCHAR (20),
  ADD country_idd VARCHAR (20),
  ADD signed_up_by VARCHAR (100),
  ADD signed_up_ip VARCHAR (20),
  ADD dob date,
  ADD ct VARCHAR (200),
  ADD assistant VARCHAR (200),
  ADD asst_phone VARCHAR (100),
  ADD second_email VARCHAR (100),
  ADD second_phone VARCHAR (100),
  ADD taxexempt VARCHAR (50),
  ADD latefeeoveride VARCHAR (50),
  ADD overideduenotices VARCHAR (50),
  ADD separateinvoices VARCHAR (50),
  ADD disableautocc VARCHAR (50),
  ADD billingcid INT (10) NOT NULL DEFAULT '0',
  ADD securityqid INT (10) NOT NULL DEFAULT '0',
  ADD securityqans text,
  ADD cardtype VARCHAR (200),
  ADD cardlastfour VARCHAR (20),
  ADD cardnum text,
  ADD startdate VARCHAR (50),
  ADD expdate VARCHAR (50),
  ADD issuenumber VARCHAR (200),
  ADD bankname VARCHAR (200),
  ADD banktype VARCHAR (200),
  ADD bankcode VARCHAR (200),
  ADD bankacct VARCHAR (200),
  ADD gatewayid INT (10) NOT NULL DEFAULT '0',
  ADD language text,
  ADD pwresetkey VARCHAR (100),
  ADD emailoptout VARCHAR (50),
  ADD email_verified VARCHAR (50),
  ADD created_at datetime,
  ADD updated_at datetime,
  ADD pwresetexpiry datetime,
  ADD c1 VARCHAR (200),
  ADD c2 VARCHAR (200),
  ADD c3 VARCHAR (200),
  ADD c4 VARCHAR (200),
  ADD c5 VARCHAR (200)

");

    $msg .= 'Contacts table altered.
';
}

$d = ORM::for_table('crm_accounts')
    ->raw_query("SHOW TABLES LIKE 'crm_groups'")
    ->find_one();

if (!$d) {
    $s = new Schema('crm_groups');
    $s->add('gname', 'varchar', 200);
    $s->add('color', 'varchar', 50);
    $s->add('discount', 'varchar', 50);
    $s->add('parent', 'varchar', 200);
    $s->add('pid', 'int', 10);
    $s->add('exempt');
    $s->add('description');
    $s->add('separateinvoices');
    $s->add('sorder', 'int', 10);
    $s->add('c1', 'varchar', 200);
    $s->add('c2', 'varchar', 200);
    $s->add('c3', 'varchar', 200);
    $s->add('c4', 'varchar', 200);
    $s->add('c5', 'varchar', 200);
    $s->save();

    $msg .= 'Created table crm_groups
';
}

//

// email template

$d = ORM::for_table('sys_email_templates')
    ->where('tplname', 'Client:Client Signup Email')
    ->find_one();

if (!$d) {
    $c = ORM::for_table('sys_email_templates')->create();

    $c->tplname = 'Client:Client Signup Email';
    $c->language_id = 1;
    $c->subject = 'Your {{business_name}} Login Info';
    $c->message = '<p>Dear {{client_name}},</p>
<p>Welcome to {{business_name}}.</p>
<p>You can track your billing, profile, transactions from this portal.</p>
<p>Your login information is as follows:</p>
<p>---------------------------------------------------------------------------------------</p>
<p>Login URL: {{client_login_url}} <br />Email Address: {{client_email}}<br /> Password: Your chosen password.</p>
<p>----------------------------------------------------------------------------------------</p>
<p>We very much appreciate you for choosing us.</p>
<p>{{business_name}} Team</p>';

    $c->send = 'Yes';
    $c->core = 'Yes';
    $c->hidden = 0;

    $c->save();

    $msg .= 'New email template added
';
}

// V 4.2

if (add_option('recaptcha', '0')) {
    $msg .= 'recaptcha row is created
';
}

if (add_option('recaptcha_sitekey', '')) {
    $msg .= 'recaptcha sitekey row is created
';
}

if (add_option('recaptcha_secretkey', '')) {
    $msg .= 'recaptcha secretkey row is created
';
}

if (add_option('home_currency', 'USD')) {
    $msg .= 'home_currency row is created
';
}

if (add_option('currency_decimal_digits', 'true')) {
    $msg .= 'currency_decimal_digits row is created
';
}

if (add_option('currency_symbol_position', 'p')) {
    $msg .= 'currency_symbol_position row is created
';
}

if (add_option('thousand_separator_placement', '3')) {
    $msg .= 'thousand_separator_placement row is created
';
}

# 4.3

# 4.4

if (add_option('dashboard', 'canvas')) {
    $msg .= 'dashboard row is created
';
}

# 4.5

if (add_option('header_scripts', '')) {
    $msg .= 'header_scripts row is created
';
}

if (add_option('footer_scripts', '')) {
    $msg .= 'footer_scripts row is created
';
}

if (add_option('ib_key', 'vLBLfhA6DNi1R2MFHO8IvFWr4Cn9665eHUF+L/sqAKM=')) {
    $msg .= 'Encryption Key Created
';
}

if (
    add_option(
        'ib_s',
        'PNhjeZ0sOFF3JNfzT2mLxvNNKPeh6ltqpE+G5LVSDSvgp/z79Sco7W4tJEoXYIl8'
    )
) {
    //    $msg .= 'Encryption Key Created
    //';
}

if (add_option('ib_u_t', 1)) {
    $msg .= 'Time Synced
';
}

if (add_option('ib_u_a', 0)) {
}

if ($file_build < 4500) {
    // ALTER TABLE `sys_quotes` CHANGE `subtotal` `subtotal` DECIMAL(16,2) NOT NULL;

    ORM::execute(
        "ALTER TABLE `sys_quotes` CHANGE `subtotal` `subtotal` DECIMAL(18,2) NOT NULL"
    );
    ORM::execute(
        "ALTER TABLE `sys_quotes` CHANGE `total` `total` DECIMAL(18,2) NOT NULL"
    );
    ORM::execute(
        "ALTER TABLE `sys_quoteitems` CHANGE `amount` `amount` DECIMAL(18,2) NOT NULL"
    );
    ORM::execute(
        "ALTER TABLE `sys_quoteitems` CHANGE `total` `total` DECIMAL(18,2) NOT NULL"
    );
    ORM::execute(
        "ALTER TABLE `sys_invoices` CHANGE `subtotal` `subtotal` DECIMAL(18,2) NOT NULL"
    );
    ORM::execute(
        "ALTER TABLE `sys_invoices` CHANGE `total` `total` DECIMAL(18,2) NOT NULL DEFAULT '0.00'"
    );

    $msg .= 'Deciaml Length Altered
';
}

# Build 4506

$d = ORM::for_table('sys_pl')
    ->raw_query("SHOW COLUMNS FROM sys_pl LIKE 'build'")
    ->find_one();

if (!$d) {
    ORM::execute(
        "ALTER TABLE `sys_pl` ADD `build` INT(10) NULL DEFAULT '1', ADD `c1` TEXT NULL, ADD `c2` TEXT NULL"
    );

    $msg .= 'Pl Table Altered
';
}

# Build 4520

$d = ORM::for_table('sys_users')
    ->raw_query("SHOW COLUMNS FROM sys_users LIKE 'notes'")
    ->find_one();

if (!$d) {
    ORM::execute(
        "ALTER TABLE `sys_users` ADD `roleid` INT(11) NOT NULL DEFAULT '0', ADD `role` VARCHAR(200) NULL DEFAULT NULL, ADD `last_activity` datetime NULL DEFAULT NULL, ADD `autologin` VARCHAR(200) NULL DEFAULT NULL, ADD `at` VARCHAR(200) NULL DEFAULT NULL, ADD `landing_page` VARCHAR(200) NULL DEFAULT NULL,ADD `language` VARCHAR(100) NULL DEFAULT NULL, ADD `notes` TEXT NULL DEFAULT NULL, ADD `c1` TEXT NULL DEFAULT NULL, ADD `c2` TEXT NULL DEFAULT NULL, ADD `c3` TEXT NULL DEFAULT NULL, ADD `c4` TEXT NULL DEFAULT NULL, ADD `c5` TEXT NULL DEFAULT NULL"
    );

    $msg .= 'sys_users table Altered
';
}

// set locale for Moment

if (add_option('momentLocale', 'en')) {
    $msg .= 'Locale for momentjs added.
';
}

if (add_option('contentAnimation', 'animated fadeIn')) {
    $msg .= 'Animation class added
';
}

$d = ORM::for_table('sys_invoices')
    ->raw_query("SHOW COLUMNS FROM sys_invoices LIKE 'currency'")
    ->find_one();

if (!$d) {
    ORM::execute(
        "ALTER TABLE `sys_invoices` ADD `vid` INT(11) NOT NULL DEFAULT '0', ADD `currency` INT(11) NOT NULL DEFAULT '0', ADD `currency_symbol` VARCHAR(10) NULL DEFAULT NULL, ADD `currency_prefix` VARCHAR(10) NULL DEFAULT NULL, ADD `currency_suffix` VARCHAR(10) NULL DEFAULT NULL, ADD `currency_rate` DECIMAL(11,4) NOT NULL DEFAULT '1.0000', ADD `recurring` TINYINT(1) NOT NULL DEFAULT '0', ADD `recurring_ends` DATE NULL DEFAULT NULL, ADD `last_recurring_date` DATE NULL DEFAULT NULL, ADD `source` VARCHAR(200) NULL DEFAULT NULL, ADD `sale_agent` INT(11) NOT NULL DEFAULT '0', ADD `last_overdue_reminder` DATE NULL DEFAULT NULL, ADD `allowed_payment_methods` TEXT NULL DEFAULT NULL, ADD `billing_street` VARCHAR(200) NULL DEFAULT NULL, ADD `billing_city` VARCHAR(100) NULL DEFAULT NULL, ADD `billing_state` VARCHAR(100) NULL DEFAULT NULL, ADD `billing_zip` VARCHAR(50) NULL DEFAULT NULL, ADD `billing_country` VARCHAR(100) NULL DEFAULT NULL, ADD `shipping_street` VARCHAR(200) NULL DEFAULT NULL, ADD `shipping_city` VARCHAR(100) NULL DEFAULT NULL, ADD `shipping_state` VARCHAR(100) NULL DEFAULT NULL, ADD `shipping_zip` VARCHAR(100) NULL DEFAULT NULL, ADD `shipping_country` VARCHAR(100) NULL DEFAULT NULL, ADD `q_hide` TINYINT(1) NOT NULL DEFAULT '0', ADD `show_quantity_as` INT(11) NOT NULL DEFAULT '1', ADD `pid` INT(11) NOT NULL DEFAULT '0'"
    );

    ORM::execute(
        "ALTER TABLE `sys_transactions` ADD `currency` INT(11) NOT NULL DEFAULT '0', ADD `currency_symbol` VARCHAR(10) NULL DEFAULT NULL, ADD `currency_prefix` VARCHAR(10) NULL DEFAULT NULL, ADD `currency_suffix` VARCHAR(10) NULL DEFAULT NULL, ADD `currency_rate` DECIMAL(11,4) NOT NULL DEFAULT '1.0000',ADD `company_id` INT(11) NOT NULL DEFAULT '0', ADD `vid` INT(11) NOT NULL DEFAULT '0', ADD `aid` INT NOT NULL, ADD `updated_at` DATETIME NULL DEFAULT NULL, ADD `updated_by` INT(11) NOT NULL DEFAULT '0', ADD `attachments` TEXT NULL DEFAULT NULL, ADD `source` VARCHAR(200) NULL DEFAULT NULL, ADD `rid` INT(11) NOT NULL DEFAULT '0', ADD `pid` INT(11) NOT NULL DEFAULT '0', ADD `archived` INT(1) NOT NULL DEFAULT '0', ADD `trash` INT(1) NOT NULL DEFAULT '0', ADD `flag` INT(1) NOT NULL DEFAULT '0', ADD `c1` TEXT NULL DEFAULT NULL, ADD `c2` TEXT NULL DEFAULT NULL, ADD `c3` TEXT NULL DEFAULT NULL, ADD `c4` TEXT NULL DEFAULT NULL, ADD `c5` TEXT NULL DEFAULT NULL"
    );

    $msg .= 'sys_invoices table altered
';
}

// Create Permissions Table

$d = ORM::for_table('crm_accounts')
    ->raw_query("SHOW TABLES LIKE 'sys_permissions'")
    ->find_one();

if (!$d) {
    $t = new Schema('sys_permissions');
    $t->add('pname', 'varchar', 200);
    $t->add('shortname', 'varchar', 200);
    $t->add('available', 'int', 1, '0');
    $t->add('core', 'int', 1, 1);
    $t->add_primary_data('(`pname`, `shortname`) VALUES
(\'Customers\', \'customers\'),
(\'Companies\', \'companies\'),
(\'Transactions\', \'transactions\'),
(\'Sales\', \'sales\'),
(\'Bank & Cash\', \'bank_n_cash\'),
(\'Products & Services\', \'products_n_services\'),
(\'Reports\', \'reports\'),
(\'Utilities\', \'utilities\'),
(\'Appearance\', \'appearance\'),
( \'Plugins\', \'plugins\'),
( \'Calendar\', \'calendar\'),
( \'Leads\', \'leads\'),
( \'Tasks\', \'tasks\'),
( \'Contracts\', \'contracts\'),
( \'Orders\', \'orders\'),
( \'Settings\', \'settings\')
');
    $t->save();

    // Add Choose features config

    update_option('theme', 'ibilling');

    add_option('calendar', '1');
    add_option('leads', '1');
    add_option('tasks', '1');
    add_option('orders', '1');

    $t = new Schema('sys_roles');
    $t->add('rname', 'varchar', 200);
    $t->add_primary_data('(`id`, `rname`) VALUES
(1, \'Employee\')');
    $t->save();

    $t = new Schema('sys_staffpermissions');
    $t->add('rid', 'int', 11);
    $t->add('pid', 'int', 11);
    $t->add('shortname', 'varchar', 50);
    $t->add('can_view', 'int', 1, '0');
    $t->add('can_edit', 'int', 1, '0');
    $t->add('can_create', 'int', 1, '0');
    $t->add('can_delete', 'int', 1, '0');
    $t->save();

    $msg .= 'Staff Permissions Table Created
';

    // Create Table Orders

    // Create Table Tasks

    $t = new Schema('sys_tasks');
    $t->drop_before_build();
    $t->add('title', 'text');
    $t->add('description', 'text');
    $t->add('status', 'varchar', 200);
    $t->add('cid', 'int', 11, '0');
    $t->add('oid', 'int', 11, '0');
    $t->add('iid', 'int', 11, '0');
    $t->add('aid', 'int', 11, '0');
    $t->add('tid', 'int', 11, '0');
    $t->add('eid', 'int', 11, '0');
    $t->add('pid', 'int', 11, '0');
    $t->add('did', 'int', 11, '0');
    $t->add('company_id', 'int', 11, '0');
    $t->add('subscribers', 'text');
    $t->add('assigned_to', 'text');
    $t->add('priority', 'varchar', 200);
    $t->add('created_at', 'datetime');
    $t->add('created_by', 'varchar', 200);
    $t->add('updated_at', 'datetime');
    $t->add('updated_by', 'varchar', 200);
    $t->add('vtoken', 'varchar', 50);
    $t->add('ptoken', 'varchar', 50);
    $t->add('started', 'date');
    $t->add('due_date', 'date');
    $t->add('stime', 'varchar', 50);
    $t->add('dtime', 'varchar', 50);
    $t->add('time_spent', 'varchar', 50);
    $t->add('date_finished', 'date');
    $t->add('source', 'varchar', 100);
    $t->add('flag', 'int', 1, '0');
    $t->add('finished', 'int', 1, '0');
    $t->add('ratings', 'varchar', '50');
    $t->add('rel_type', 'varchar', '50');
    $t->add('rel_id', 'int', 11);
    $t->add('parent', 'int', 11, '0');
    $t->add('is_public', 'int', 1, '0');
    $t->add('billable', 'int', 1, '0');
    $t->add('billed', 'int', 1, '0');
    $t->add('hourly_rate', 'decimal', '14,2', '0.00');
    $t->add('milestone', 'int', 11);
    $t->add('progress', 'int', 3);
    $t->add('visible_to_client', 'int', 1, '0');
    $t->add('notification', 'int', 1, '0');
    $t->add('trash', 'int', '1', '0');
    $t->add('archived', 'int', '1', '0');
    $t->save();

    $msg .= 'Tasks Permissions Table Created
';

    // Create Table Events

    $t = new Schema('sys_events');
    $t->add('title');
    $t->add('description');
    $t->add('contacts');
    $t->add('deals');
    $t->add('owner', 'varchar', 200);
    $t->add('status', 'varchar', 200);
    $t->add('etype', 'varchar', 200);
    $t->add('priority', 'varchar', 200);
    $t->add('color', 'varchar', 20);
    $t->add('o', 'varchar', 200);
    $t->add('cid', 'int', 11, '0');
    $t->add('aid', 'int', 11, '0');
    $t->add('iid', 'int', 11, '0');
    $t->add('oid', 'int', 11, '0');
    $t->add('rid', 'int', 11, '0');
    $t->add('company_id', 'int', 11, '0');
    $t->add('start', 'datetime');
    $t->add('end', 'datetime');
    $t->add('allday', 'int', 1, '0');
    $t->add('notification', 'int', 1, '0');
    $t->add('trash', 'int', 1, '0');
    $t->add('archived', 'int', 1, '0');
    $t->save();

    $msg .= 'Events Table Created
';

    // Create Table Leads

    $t = new Schema('sys_leads');
    $t->add('fullname', 'varchar', 200);
    $t->add('company', 'varchar', 200);
    $t->add('email', 'varchar', 200);
    $t->add('phone', 'varchar', 50);
    $t->add('color', 'varchar', 20);
    $t->add('status', 'varchar', 200);
    $t->add('source', 'varchar', 200);
    $t->add('added_from', 'varchar', 200);
    $t->add('o', 'varchar', 200);
    $t->add('cid', 'int', 11, '0');
    $t->add('aid', 'int', 11, '0');
    $t->add('iid', 'int', 11, '0');
    $t->add('oid', 'int', 11, '0');
    $t->add('rid', 'int', 11, '0');
    $t->add('sorder', 'int', 11, '0');
    $t->add('assigned', 'int', 11, '0');
    $t->add('created_at', 'datetime');
    $t->add('created_by', 'varchar', 200);
    $t->add('updated_at', 'datetime');
    $t->add('updated_by', 'varchar', 200);
    $t->add('last_contact', 'datetime');
    $t->add('last_contact_by', 'varchar', 200);
    $t->add('date_converted', 'datetime');
    $t->add('public', 'int', 1, '0');
    $t->add('ratings', 'varchar', '50');
    $t->add('flag', 'int', 1, '0');
    $t->add('lost', 'int', 1, '0');
    $t->add('junk', 'int', 1, '0');
    $t->add('trash', 'int', 1, '0');
    $t->add('archived', 'int', 1, '0');
    $t->save();

    $msg .= 'Leads Table Created
';

    $t = new Schema('sys_currencies');
    $t->add('cname', 'varchar', 100);
    $t->add('iso_code', 'varchar', 10);
    $t->add('symbol', 'varchar', 20);
    $t->add('rate', 'decimal', '11,4', '1.0000');
    $t->add('prefix', 'varchar', 20);
    $t->add('suffix', 'varchar', 20);
    $t->add('format', 'varchar', 100);
    $t->add('decimal_separator', 'varchar', 10);
    $t->add('thousand_separator', 'varchar', 10);
    $t->add('created_at', 'datetime');
    $t->add('created_by', 'varchar', 200);
    $t->add('updated_at', 'datetime');
    $t->add('updated_by', 'varchar', 200);
    $t->add('available_in', 'text');
    $t->add('isdefault', 'int', 1, '0');
    $t->add('trash', 'int', 1, '0');
    $t->add('archived', 'int', 1, '0');
    $t->save();

    $msg .= 'Currencies Table Created
';

    $t = new Schema('sys_companies');
    $t->add('company_name', 'varchar', 200);
    $t->add('url', 'varchar', 200);
    $t->add('logo_url', 'varchar', 200);
    $t->add('logo_path', 'varchar', 200);
    $t->add('email', 'varchar', 200);
    $t->add('phone', 'varchar', 200);
    $t->add('emails');
    $t->add('phones');
    $t->add('tags');
    $t->add('description');
    $t->add('notes');
    $t->add('address1', 'varchar', 200);
    $t->add('address2', 'varchar', 200);
    $t->add('city', 'varchar', 200);
    $t->add('state', 'varchar', 200);
    $t->add('zip', 'varchar', 50);
    $t->add('country', 'varchar', 100);
    $t->add('source', 'varchar', 200);
    $t->add('added_from', 'varchar', 200);
    $t->add('o', 'varchar', 200);
    $t->add('cid', 'int', 11, '0');
    $t->add('aid', 'int', 11, '0');
    $t->add('pid', 'int', 11, '0');
    $t->add('oid', 'int', 11, '0');
    $t->add('rid', 'int', 11, '0');
    $t->add('assigned', 'int', 11, '0');
    $t->add('created_at', 'datetime');
    $t->add('created_by', 'varchar', 200);
    $t->add('updated_at', 'datetime');
    $t->add('updated_by', 'varchar', 200);
    $t->add('last_contact', 'datetime');
    $t->add('last_contact_by', 'varchar', 200);
    $t->add('ratings', 'varchar', '50');
    $t->add('trash', 'int', 1, '0');
    $t->add('archived', 'int', 1, '0');
    $t->add('c1');
    $t->add('c2');
    $t->add('c3');
    $t->add('c4');
    $t->add('c5');
    $t->save();

    $msg .= 'Companies Table Created
';

    ORM::execute(
        'ALTER TABLE `crm_accounts` CHANGE `currency` `currency` INT(11) NULL DEFAULT \'0\''
    );

    // change language to ISO i18n standard

    $current_language = $config['language'];

    switch ($current_language) {
        case 'arabic':
            update_option('language', 'ar');

            break;

        case 'chinese':
            update_option('language', 'zh');

            break;

        case 'danish':
            update_option('language', 'da');

            break;

        case 'dutch':
            update_option('language', 'nl');

            break;

        case 'en-us':
            update_option('language', 'en');

            break;

        case 'french':
            update_option('language', 'fr');

            break;

        case 'german':
            update_option('language', 'de');

            break;

        case 'italian':
            update_option('language', 'it');

            break;

        case 'indonesian':
            update_option('language', 'id');

            break;

        case 'portuguese-br':
            update_option('language', 'pt_BR');

            break;

        case 'portuguese-pt':
            update_option('language', 'pt');

            break;

        case 'russian':
            update_option('language', 'ru');

            break;

        case 'spanish':
            update_option('language', 'es');

            break;

        case 'swedish':
            update_option('language', 'sv');

            break;

        case 'thai':
            update_option('language', 'th');

            break;

        case 'turkish':
            update_option('language', 'tr');

            break;

        case 'ukranian':
            update_option('language', 'uk');

            break;

        default:
            update_option('language', 'en');
    }

    $df = $config['df'];

    if ($df == 'M d Y' || $df == 'd M Y' || $df == 'jS M Y') {
        update_option('df', 'Y-m-d');
    }
}

# Build 4596

// Documents table
$d = ORM::for_table('crm_accounts')
    ->raw_query("SHOW TABLES LIKE 'sys_documents'")
    ->find_one();

if (!$d) {
    $t = new Schema('sys_documents');
    $t->add('title', 'varchar', 200);
    $t->add('file_o_name', 'varchar', 200);
    $t->add('file_r_name', 'varchar', 200);
    $t->add('file_mime_type', 'varchar', 200);
    $t->add('file_path', 'varchar', 200);
    $t->add('file_dl_token', 'varchar', 200);
    $t->add('file_owner', 'int', 11, '0');
    $t->add('version', 'varchar', 100);
    $t->add('link', 'varchar', 100);
    $t->add('sha1', 'varchar', 40);
    $t->add('md5', 'varchar', 32);
    $t->add('cid', 'int', 11, '0');
    $t->add('gid', 'int', 11, '0');
    $t->add('company_id', 'int', 11, '0');
    $t->add('aid', 'int', 11, '0');
    $t->add('contacts');
    $t->add('deals');
    $t->add('leads');
    $t->add('created_at', 'datetime');
    $t->add('created_by', 'varchar', 200);
    $t->add('updated_at', 'datetime');
    $t->add('updated_by', 'varchar', 200);
    $t->add('customer_can_download', 'int', 1, '0');
    $t->add('trash', 'int', 1, '0');
    $t->add('archived', 'int', 1, '0');
    $t->save();

    $msg .= 'Documents Table Created
';
}

// Build 4597
$d = ORM::for_table('crm_accounts')
    ->raw_query("SHOW TABLES LIKE 'sys_orders'")
    ->find_one();

if (!$d) {
    $t = new Schema('sys_orders');
    $t->add('ordernum', 'varchar', 50);
    $t->add('source', 'varchar', 100);
    $t->add('status', 'varchar', 100);
    $t->add('sales_person', 'varchar', 100);
    $t->add('branch_name', 'varchar', 100);
    $t->add('cname', 'varchar', 100); // Customer Name
    $t->add('cid', 'int', 11, 0);
    $t->add('contract_id', 'int', 11, 0);
    $t->add('bid', 'int', 11, 0); // Branch ID
    $t->add('date_added', 'date');
    $t->add('date_expiry', 'date');
    $t->add('pid', 'int', 11, 0);
    $t->add('stitle', 'varchar', 200); // Service Title
    $t->add('sid', 'int', 11, 0); // Service ID
    $t->add('iid', 'int', 11, 0);
    $t->add('aid', 'int', 11, 0); // Admin ID

    $t->add('amount', 'decimal', '16,2', '0.00');
    $t->add('recurring', 'decimal', '16,2', '0.00');
    $t->add('setup_fee', 'decimal', '16,2', '0.00');
    $t->add('billing_cycle', 'text');
    $t->add('addon_ids', 'text');
    $t->add('related_orders', 'text');
    $t->add('description', 'text');
    $t->add('upgrade_ids', 'text');
    $t->add('xdata', 'text');
    $t->add('xsecret', 'varchar', 100);

    $t->add('promo_code', 'text');
    $t->add('promo_type', 'text');
    $t->add('promo_value', 'text');

    $t->add('payment_method', 'text');
    $t->add('ipaddress', 'text');
    $t->add('fraud_module', 'text');
    $t->add('fraud_output', 'text');
    $t->add('activation_subject', 'text');
    $t->add('activation_message', 'text');
    $t->add('trash', 'int', '1', '0');

    $t->add('archived', 'int', '1', '0');
    $t->add('c1', 'text');
    $t->add('c2', 'text');
    $t->add('c3', 'text');
    $t->add('c4', 'text');
    $t->add('c5', 'text');

    $save = $t->save();

    if ($save) {
        $msg .= 'Orders Table Created
';
    } else {
        $msg .= $save;
    }
}

$d = ORM::for_table('sys_items')
    ->raw_query("SHOW COLUMNS FROM sys_items LIKE 'payterm'")
    ->find_one();

if (!$d) {
    /*


    ALTER TABLE `sys_items`
CHANGE `added` `added` date NULL AFTER `status`,
CHANGE `last_sold` `last_sold` date NULL AFTER `added`


     */

    ORM::execute("ALTER TABLE `sys_items` 
ADD `sorder` INT(11) NOT NULL DEFAULT '0',
ADD `gid` INT(11) NOT NULL DEFAULT '0',
ADD `category_id` INT(11) NOT NULL DEFAULT '0',
ADD `supplier_id` INT(11) NOT NULL DEFAULT '0',
ADD `gname` VARCHAR(100) NULL DEFAULT NULL,
ADD `product_id` VARCHAR(100) NULL DEFAULT NULL,
ADD `size` VARCHAR(100) NULL DEFAULT NULL,
ADD `start_date` DATE NULL DEFAULT NULL,
ADD `end_date` DATE NULL DEFAULT NULL,
ADD `expire_date` DATE NULL DEFAULT NULL,
ADD `expire_days` INT(11) NOT NULL DEFAULT '0',
ADD `image` TEXT NULL DEFAULT NULL,
ADD `flag` INT(1) NOT NULL DEFAULT '0',
ADD `is_service` INT(1) NOT NULL DEFAULT '0',
ADD `commission_percent` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `commission_percent_type` VARCHAR(100) NULL DEFAULT NULL,
ADD `commission_fixed` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `trash` INT(1) NOT NULL DEFAULT '0',
ADD `payterm` VARCHAR(200) NULL DEFAULT NULL,
ADD `cost_price` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `unit_price` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `promo_price` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `setup` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `onetime` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `monthly` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `monthlysetup` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `quarterly` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `quarterlysetup` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `halfyearly` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `halfyearlysetup` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `annually` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `annuallysetup` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `biennially` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `bienniallysetup` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `triennially` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `trienniallysetup` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
ADD `has_domain` VARCHAR(100) NULL DEFAULT NULL,
ADD `free_domain` VARCHAR(100) NULL DEFAULT NULL,
ADD `email_rel` INT(11) NOT NULL DEFAULT '0',
ADD `tags` TEXT NULL DEFAULT NULL,
ADD `c1` TEXT NULL DEFAULT NULL,
ADD `c2` TEXT NULL DEFAULT NULL,
ADD `c3` TEXT NULL DEFAULT NULL,
ADD `c4` TEXT NULL DEFAULT NULL,
ADD `c5` TEXT NULL DEFAULT NULL,
ADD `c6` TEXT NULL DEFAULT NULL,
ADD `c7` TEXT NULL DEFAULT NULL,
ADD `c8` TEXT NULL DEFAULT NULL,
ADD `c9` TEXT NULL DEFAULT NULL,
ADD `c10` TEXT NULL DEFAULT NULL,
ADD `c11` TEXT NULL DEFAULT NULL,
ADD `c12` TEXT NULL DEFAULT NULL,
ADD `c13` TEXT NULL DEFAULT NULL,
ADD `c14` TEXT NULL DEFAULT NULL,
ADD `c15` TEXT NULL DEFAULT NULL,
ADD `c16` TEXT NULL DEFAULT NULL,
ADD `c17` TEXT NULL DEFAULT NULL,
ADD `c18` TEXT NULL DEFAULT NULL,
ADD `c19` TEXT NULL DEFAULT NULL,
ADD `c20` TEXT NULL DEFAULT NULL,
ADD `c21` TEXT NULL DEFAULT NULL,
ADD `c22` TEXT NULL DEFAULT NULL,
ADD `c23` TEXT NULL DEFAULT NULL,
ADD `c24` TEXT NULL DEFAULT NULL,
ADD `c25` TEXT NULL DEFAULT NULL,
ADD `c26` TEXT NULL DEFAULT NULL,
ADD `c27` TEXT NULL DEFAULT NULL,
ADD `c28` TEXT NULL DEFAULT NULL,
ADD `c29` TEXT NULL DEFAULT NULL,
ADD `c30` TEXT NULL DEFAULT NULL
");

    $msg .= 'sys_items table altered
';

    // Add Permission for Documents

    addPermission('Documents', 'documents');

    // add documents relation table

    $t = new Schema('ib_doc_rel');

    $t->add('rtype', 'varchar', 100, 'contact');
    $t->add('rid', 'int', 11, '0');
    $t->add('did', 'int', 11, '0');
    $t->add('can_download', 'int', 1, '0');
    $t->save();
}

// sync

if ($config['build'] <= 4670) {
    if (!db_column_exist('sys_documents', 'is_global')) {
        ORM::execute(
            'ALTER TABLE `sys_documents` ADD `is_global` INT(1) NOT NULL DEFAULT \'0\''
        );
    }

    if (!db_table_exist('sys_item_cats')) {
        $t = new Schema('sys_item_cats');
        $t->add('pid', 'int', '11', '0');
        $t->add('name', 'varchar', '200');
        $t->add('type', 'varchar', '200');
        $t->add('img', 'varchar', '200');
        $t->add('status', 'varchar', '200');
        $t->add('description');
        $t->add('sorder', 'int', '11', '0');
        $t->add('created_at', 'datetime');
        $t->add('updated_at', 'datetime');
        $t->save();

        ORM::execute(
            'ALTER TABLE `sys_items` ADD `inventory` DECIMAL(16,4) NOT NULL DEFAULT \'0.0000\' AFTER `sales_price`, ADD `weight` DECIMAL(16,4) NOT NULL DEFAULT \'0.0000\' AFTER `inventory`, ADD `width` DECIMAL(12,4) NOT NULL DEFAULT \'0.0000\' AFTER `weight`, ADD `length` DECIMAL(12,4) NOT NULL DEFAULT \'0.0000\' AFTER `width`, ADD `height` DECIMAL(12,4) NOT NULL DEFAULT \'0.0000\' AFTER `length`,ADD `sku` VARCHAR(50) NULL AFTER `height`,ADD `upc` VARCHAR(50) NULL AFTER `sku`, ADD `ean` VARCHAR(50) NULL AFTER `upc`, ADD `mpn` VARCHAR(50) NULL AFTER `ean`, ADD `isbn` VARCHAR(50) NULL AFTER `mpn`,ADD `sid` INT(11) NOT NULL DEFAULT \'0\' AFTER `isbn`, ADD `supplier` VARCHAR(200) NULL DEFAULT NULL AFTER `sid`, ADD `bid` INT(11) NOT NULL DEFAULT \'0\' AFTER `supplier`, ADD `brand` VARCHAR(200) NULL DEFAULT NULL AFTER `bid`, ADD `sell_account` INT(11) NOT NULL DEFAULT \'0\' AFTER `brand`, ADD `purchase_account` INT(11) NOT NULL DEFAULT \'0\' AFTER `sell_account`, ADD `inventory_account` INT(11) NOT NULL DEFAULT \'0\' AFTER `purchase_account`, ADD `taxable` INT(1) NOT NULL DEFAULT \'0\' AFTER `inventory_account`, ADD `location` VARCHAR(200) NULL AFTER `taxable`, ADD `sold_count` DECIMAL(16,4) NULL DEFAULT \'0.0000\', ADD `total_amount` DECIMAL(16,4) NULL DEFAULT \'0.0000\', ADD `created_at` TIMESTAMP NULL, ADD `updated_at` TIMESTAMP NULL'
        );

        ORM::execute(
            'ALTER TABLE `sys_invoices` CHANGE `show_quantity_as` `show_quantity_as` VARCHAR(100) NULL DEFAULT NULL, MODIFY datepaid DATETIME'
        );

        $t = new Schema('sys_units');
        $t->add('type', 'varchar', '200');
        $t->add('name', 'varchar', '200');
        $t->add('reference', 'varchar', '200');
        $t->add('conversion_factor', 'decimal', '16,2', '0.00');
        $t->add('sorder', 'int', '11', '0');
        $t->add('created_at', 'TIMESTAMP NULL');
        $t->add('updated_at', 'TIMESTAMP NULL');
        $t->save();

        add_option('show_quantity_as', '');

        $t = new Schema('crm_leads');
        // $t->drop();
        $t->add('secret', 'varchar', 200);
        $t->add('status', 'varchar', 200);
        $t->add('o', 'varchar', 200);
        $t->add('oid', 'int', 11, '0');
        $t->add('salutation', 'varchar', 200);
        $t->add('first_name', 'varchar', 200);
        $t->add('middle_name', 'varchar', 200);
        $t->add('last_name', 'varchar', 200);
        $t->add('suffix', 'varchar', 200);
        $t->add('title', 'varchar', 200);
        $t->add('company', 'varchar', 200);
        $t->add('company_id', 'int', 11, '0');
        $t->add('website', 'varchar', 200);
        $t->add('industry', 'varchar', 200);
        $t->add('employees', 'varchar', 200);
        $t->add('email', 'varchar', 200);
        $t->add('phone', 'varchar', 50);
        $t->add('color', 'varchar', 20);
        $t->add('source', 'varchar', 200);
        $t->add('added_from', 'varchar', 200);
        $t->add('mobile', 'varchar', 200);
        $t->add('address', 'varchar', 200);
        $t->add('street', 'varchar', 200);
        $t->add('city', 'varchar', 200);
        $t->add('state', 'varchar', 200);
        $t->add('zip', 'varchar', 50);
        $t->add('country', 'varchar', 50);
        $t->add('created_by', 'varchar', 200);
        $t->add('created_at', 'TIMESTAMP NULL');
        $t->add('updated_at', 'TIMESTAMP NULL');
        $t->add('updated_by', 'varchar', 200);
        $t->add('viewed_at', 'datetime');
        $t->add('cid', 'int', 11, '0');
        $t->add('aid', 'int', 11, '0');
        $t->add('iid', 'int', 11, '0');
        $t->add('rid', 'int', 11, '0');
        $t->add('sorder', 'int', 11, '0');
        $t->add('assigned', 'int', 11, '0');
        $t->add('last_contact', 'datetime');
        $t->add('last_contact_by', 'varchar', 200);
        $t->add('date_converted', 'datetime');
        $t->add('public', 'int', 1, '0');
        $t->add('ratings', 'varchar', '50');
        $t->add('flag', 'int', 1, '0');
        $t->add('lost', 'int', 1, '0');
        $t->add('junk', 'int', 1, '0');
        $t->add('trash', 'int', 1, '0');
        $t->add('archived', 'int', 1, '0');
        $t->add('memo');
        $t->save();

        $t = new Schema('crm_lead_sources');
        $t->drop();
        $t->add('sname', 'varchar', '200');
        $t->add('is_active', 'int', '1', '1');
        $t->add('is_default', 'int', '1', '1');
        $t->add('sorder', 'int', '11', '0');
        $t->add('created_at', 'TIMESTAMP NULL');
        $t->add('updated_at', 'TIMESTAMP NULL');
        $t->add_primary_data('(`sname`) VALUES 
        (\'Advertisement\'),
         (\'Customer Event\'),
         (\'Employee Referral\'),
         (\'Google AdWords\'),
         (\'Other\'),
         (\'Partner\'),
         (\'Purchased List\'),
         (\'Trade Show\'),
         (\'Webinar\'),
         (\'Website\'),
         (\'Facebook\')
         ');
        $t->save();

        $t = new Schema('crm_industries');
        $t->drop();
        $t->add('industry', 'varchar', '200');
        $t->add('is_active', 'int', '1', '1');
        $t->add('is_default', 'int', '1', '0');
        $t->add('sorder', 'int', '11', '0');
        $t->add('created_at', 'TIMESTAMP NULL');
        $t->add('updated_at', 'TIMESTAMP NULL');
        $t->add_primary_data('(`industry`) VALUES 
        (\'Agriculture\'),
         (\'Apparel\'),
         (\'Banking\'),
         (\'Biotechnology\'),
         (\'Chemicals\'),
         (\'Communications\'),
         (\'Construction\'),
         (\'Consulting\'),
         (\'Education\'),
         (\'Electronics\'),
         (\'Energy\'),
         (\'Engineering\'),
         (\'Entertainment\'),
         (\'Environmental\'),
         (\'Finance\'),
         (\'Food & Beverage\'),
         (\'Government\'),
         (\'Healthcare\'),
         (\'Hospitality\'),
         (\'Insurance\'),
         (\'Machinery\'),
         (\'Manufacturing\'),
         (\'Media\'),
         (\'Not For Profit\'),
         (\'Other\'),
         (\'Recreation\'),
         (\'Retail\'),
         (\'Shipping\'),
         (\'Technology\'),
         (\'Telecommunications\'),
         (\'Transportation\'),
         (\'Utilities\')
         ');
        $t->save();

        $t = new Schema('crm_lead_status');
        $t->drop();
        $t->add('sname', 'varchar', '200');
        $t->add('is_active', 'int', '1', '1');
        $t->add('is_default', 'int', '1', '0');
        $t->add('is_converted', 'int', '1', '0');
        $t->add('sorder', 'int', '11', '0');
        $t->add('created_at', 'TIMESTAMP NULL');
        $t->add('updated_at', 'TIMESTAMP NULL');
        $t->add_primary_data('(`sname`,`is_default`) VALUES 
        (\'Unqualified\',\'0\'),
         (\'New\',\'1\'),
         (\'Working\',\'0\'),
         (\'Nurturing\',\'0\'),
         (\'Qualified\',\'0\')
         ');
        $t->save();

        $t = new Schema('crm_salutations');
        $t->drop();
        $t->add('sname', 'varchar', '200');
        $t->add('is_active', 'int', '1', '1');
        $t->add('is_default', 'int', '1', '0');
        $t->add('sorder', 'int', '11', '0');
        $t->add('created_at', 'TIMESTAMP NULL');
        $t->add('updated_at', 'TIMESTAMP NULL');
        $t->add_primary_data('(`sname`) VALUES 
        (\'Mr.\'),
         (\'Ms.\'),
         (\'Mrs.\'),
         (\'Dr.\'),
         (\'Prof.\')
         ');
        $t->save();

        add_option('gmap_api_key', '');
        add_option('license_key', '');
        add_option('local_key', '');

        $t = new Schema('sys_cart');
        $t->add('secret', 'varchar', 100);
        $t->add('items');
        $t->add('total', 'decimal', '16,2', '0.00');
        $t->add('discount', 'decimal', '16,2', '0.00');
        $t->add('ip', 'varchar', 100);
        $t->add('fullname', 'varchar', 200);
        $t->add('phone', 'varchar', 200);
        $t->add('email', 'varchar', 200);
        $t->add('status', 'varchar', 200);
        $t->add('browser', 'varchar', 200);
        $t->add('country', 'varchar', 200);
        $t->add('currency', 'varchar', 200);
        $t->add('language', 'varchar', 200);
        $t->add('coupon', 'varchar', 200);
        $t->add('lat', 'varchar', 50);
        $t->add('lon', 'varchar', 50);
        $t->add('item_count', 'int', '11', '0');
        $t->add('cid', 'int', '11', '0');
        $t->add('aid', 'int', '11', '0');
        $t->add('lid', 'int', '11', '0');
        $t->add('currency_id', 'int', '11', '0');
        $t->add('company_id', 'int', '11', '0');
        $t->add('created_at', 'TIMESTAMP NULL');
        $t->add('updated_at', 'TIMESTAMP NULL');
        $t->add('expiry', 'datetime');
        $t->add('memo');
        $t->save();

        $t = new Schema('ib_invoice_access_log');
        $t->drop();
        $t->add('lid', 'int', '11', '0');
        $t->add('cid', 'int', '11', '0');
        $t->add('iid', 'int', '11', '0');
        $t->add('company_id', 'int', '11', '0');
        $t->add('customer', 'varchar', '200');
        $t->add('ip', 'varchar', '50');
        $t->add('browser', 'varchar', '200');
        $t->add('referer', 'varchar', '200');
        $t->add('city', 'varchar', '200');
        $t->add('postal_code', 'varchar', '50');
        $t->add('country', 'varchar', '200');
        $t->add('country_iso', 'varchar', '20');
        $t->add('viewed_at', 'varchar', '200');
        $t->add('lat', 'varchar', '100');
        $t->add('lon', 'varchar', '100');
        $t->add('created_at', 'TIMESTAMP NULL');
        $t->add('updated_at', 'TIMESTAMP NULL');
        $t->save();

        $t = new Schema('account_balances');
        $t->drop();
        $t->add('account_id', 'int', '11', '0');
        $t->add('currency_id', 'int', '11', '0');
        $t->add('balance', 'decimal', '16,4', '0');
        $t->add('created_at', 'TIMESTAMP NULL');
        $t->add('updated_at', 'TIMESTAMP NULL');
        $t->save();

        // ====== internal

        ORM::execute(
            'ALTER TABLE `sys_email_logs` ADD `rel_type` VARCHAR(100) NULL DEFAULT NULL, ADD `rel_id` INT(11) NOT NULL DEFAULT \'0\''
        );

        ORM::execute(
            'ALTER TABLE `crm_accounts` ADD `options` TEXT NULL DEFAULT NULL AFTER `notes`'
        );

        add_option('add_fund', '0');
        add_option('add_fund_minimum_deposit', '100');
        add_option('add_fund_maximum_deposit', '2500');
        add_option('add_fund_maximum_balance', '25000');
        add_option('add_fund_require_active_order', '0');

        ORM::execute(
            'ALTER TABLE `sys_invoices` ADD `is_credit_invoice` INT(1) NOT NULL DEFAULT \'0\''
        );
    }

    // after 4622

    if (!hasColumn('all_data', 'sys_staffpermissions')) {
        ORM::execute(
            'ALTER TABLE `sys_staffpermissions` ADD `all_data` INT(1) NOT NULL DEFAULT \'0\' AFTER `can_delete`'
        );
    }

    add_option('sales_target', '10000');

    if (!hasColumn('is_email_verified', 'crm_accounts')) {
        ORM::execute(
            'ALTER TABLE `crm_accounts` DROP `email_verified`, ADD `is_email_verified` INT(1) NOT NULL DEFAULT \'0\', ADD `is_phone_veirifed` INT(1) NOT NULL DEFAULT \'0\', ADD `photo_id_type` VARCHAR(100) NULL DEFAULT NULL, ADD `photo_id` VARCHAR(100) NULL DEFAULT NULL'
        );
    }

    if (!hasColumn('aid', 'sys_invoices')) {
        ORM::execute(
            'ALTER TABLE `sys_invoices` ADD `aid` INT(11) NOT NULL DEFAULT \'0\', ADD `aname` VARCHAR(200) NULL DEFAULT NULL'
        );
    }

    // End Update

    // future

    add_option('industry', 'default');
    add_option('inventory', '1');

    add_option('secondary_currency', '');

    add_option('customer_custom_username', '0');
    add_option('documents', '1');

    add_option('projects', '1');
    add_option('purchase', '1');
    add_option('suppliers', '1');
    add_option('support', '1');
    add_option('hrm', '1');
    add_option('companies', '1');
    add_option('plugins', '1');

    ORM::execute(
        'ALTER TABLE `sys_currencies` CHANGE `rate` `rate` DECIMAL(16,8) NOT NULL DEFAULT \'1.00000000\''
    );

    ORM::execute(
        'ALTER TABLE `sys_companies` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL'
    );
    ORM::execute(
        'ALTER TABLE `sys_companies` CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL'
    );

    if (!hasColumn('username', 'crm_accounts')) {
        ORM::execute(
            'ALTER TABLE `crm_accounts` ADD `username` VARCHAR(100) NULL DEFAULT NULL AFTER `email`'
        );
    }

    // ALTER TABLE `sys_cats` ADD `amount` DECIMAL(16,4) NULL DEFAULT '0.0000' AFTER `type`;

    ORM::execute(
        'ALTER TABLE `sys_cats` ADD `total_amount` DECIMAL(16,4) NULL DEFAULT \'0.0000\', ADD `budget` DECIMAL(16,4) NULL DEFAULT \'0.0000\', ADD `created_at` TIMESTAMP NULL, ADD `updated_at` TIMESTAMP NULL'
    );

    add_option('country_flag_code', 'us');

    add_option('graph_primary_color', '2196f3');
    add_option('graph_secondary_color', 'eb3c00');

    add_option('expense_type_1', 'Personal');

    add_option('expense_type_2', 'Business');

    add_option('edition', 'default');

    ORM::execute(
        'ALTER TABLE `sys_transactions` ADD `base_amount` DECIMAL(16,4) NOT NULL DEFAULT \'0.0000\' AFTER `currency_rate`, MODIFY updated_at TIMESTAMP NULL, ADD created_at TIMESTAMP NULL AFTER aid, MODIFY category VARCHAR(200) NULL, MODIFY payer VARCHAR(200) NULL, MODIFY payee VARCHAR(200) NULL, MODIFY method VARCHAR(200) NULL, MODIFY ref VARCHAR(200) NULL, MODIFY description TEXT NULL, MODIFY tags TEXT NULL, MODIFY aid INT(11) NULL, MODIFY date DATE NULL, MODIFY amount DECIMAL(18,2) NULL'
    );
}

if ($config['build'] <= 4670) {
    ORM::execute(
        'ALTER TABLE `crm_groups` ADD `created_at` TIMESTAMP  NULL  DEFAULT NULL, ADD `updated_at` TIMESTAMP  NULL  DEFAULT NULL'
    );
    ORM::execute(
        'ALTER TABLE `sys_users` ADD `created_at` TIMESTAMP  NULL  DEFAULT NULL, ADD `updated_at` TIMESTAMP  NULL  DEFAULT NULL'
    );
    ORM::execute(
        'ALTER TABLE `sys_accounts` ADD `created_at` TIMESTAMP  NULL  DEFAULT NULL, ADD `updated_at` TIMESTAMP  NULL  DEFAULT NULL'
    );
}

// End Update

if ($msg == '') {
    $msg = 'Done! You are using Latest Version!';
} else {
    $msg .= 'Update Completed!
';
    _log($msg, 'System');
}

$display = route(1);

if ($display == 'ajax') {
    echo $msg;
} else {
    $ui->assign('msg', $msg);

    $ui->display('update.tpl');
}
