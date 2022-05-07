<?php
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

$x = $t->save('show_sql');

echo $x;
