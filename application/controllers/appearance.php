<?php
_auth();
$ui->assign('_title', $_L['Appearance'] . '- ' . $config['CompanyName']);
$ui->assign('_st', $_L['Appearance']);
$ui->assign('_application_menu', 'appearance');
$action = $routes[1];
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'themes':
        // by Max Mendez [ github user Akiracr ]

        //Scan for themes
        $themes = glob('ui/theme/*');
        $themes = array_map('basename', array_filter($themes, 'is_dir'));
        $ui->assign('themes', $themes);

        $ui->display('appearance_themes.tpl');

        break;

    case 'ui':
        $ca = new Ib_Animate();

        $ca_options = $ca->options($config['contentAnimation']);
        $ui->assign('ca_options', $ca_options);

        $ui->assign('xfooter', Asset::js(['settings/appearance']));
        $ui->display('appearance_user_interface.tpl');

        break;

    case 'customize':
        $ui->display('appearance_customize.tpl');

        break;

    case 'editor':
        $ui->assign(
            'xfooter',
            Asset::js(['ace/ace', 'ace/ext-modelist', 'settings/editor'])
        );
        $ui->assign('_include', 'box');

        $ui->display('appearance_editor.tpl');

        break;

    case 'themes_post':
        if ($_app_stage == 'Demo') {
            r2(
                U . 'appearance/themes/',
                'e',
                'Sorry! This option is disabled in the demo mode.'
            );
        }

        $theme = _post('theme');

        $nstyle = _post('nstyle');

        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'theme')
            ->find_one();
        $d->value = $theme;
        $d->save();

        $d = ORM::for_table('sys_appconfig')
            ->where('setting', 'nstyle')
            ->find_one();
        $d->value = $nstyle;
        $d->save();

        r2(U . 'appearance/themes/', 's', $_L['Settings Saved Successfully']);

        break;

    case 'edit':
        break;

    default:
        echo 'action not defined';
}
