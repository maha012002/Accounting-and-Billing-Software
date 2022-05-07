<?php
_auth();
$ui->assign('_title', $_L['Settings'] . '- ' . $config['CompanyName']);
$ui->assign('_pagehead', '<i class="fa fa-cogs lblue"></i> Settings');
$ui->assign('_st', $_L['Settings']);
$ui->assign('_application_menu', 'settings');

$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'create_htaccess':
        $htaccess = 'RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?ng=$1 [L,QSA]';

        $fs = new IBilling_FileSystem();

        if ($fs->exist('.htaccess')) {
            ib_die('A .htaccess file already exist, please remove it first.');
        }

        try {
            $fs->createFile('.htaccess', $htaccess);
            echo 'ok';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        break;

    case 'remove_htaccess':
        update_option('url_rewrite', 0);

        $fs = new IBilling_FileSystem();

        try {
            $fs->select('.htaccess')->delete();
            echo 'ok';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        break;

    default:
        echo 'action not defined';
}
