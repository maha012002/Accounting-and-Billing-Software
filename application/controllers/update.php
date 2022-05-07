<?php

$ui->assign('latest_build',$file_build);
// Enable Error Reporting
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
$msg = '';
$message = '';


if(!db_table_exist('relations')){
    ORM::execute('CREATE TABLE `relations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
    $message .= 'Created relations table...'.PHP_EOL;

}



if(!db_table_exist('clx_integrations')){

    ORM::execute('CREATE TABLE `clx_integrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT \'1\',
  `is_default` tinyint(1) NOT NULL DEFAULT \'0\',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

    $message .= 'Created integrations table...'.PHP_EOL;
}

$msg .= $message;

update_option('build',$file_build);
$msg = 'Build updated: '.$file_build.PHP_EOL;

if($msg == ''){
    $msg = 'Done! You are using Latest Version!';
}
else{

    $msg .= 'Update Completed!
';
    _log($msg,'System');
}

$display = route(1);

if($display == 'ajax'){
    echo $msg;
}
else{
    $ui->assign('msg',$msg);

    $ui->display('update.tpl');
}