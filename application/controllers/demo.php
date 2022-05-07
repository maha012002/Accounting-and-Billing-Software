<?php
//this script will run only in demo mode

if ($_app_stage != 'Demo') {
    exit();
}

$action = route(1);

switch ($action) {
    case 'admin':
        // auto login to admin

        Ib_Internal::autoLogin('demo@example.com', '123456');

        break;

    case 'client':
        Ib_Internal::autoLogin('customer@example.com', '123456', 'customer');

        break;

    case 'reset':
        Demo::reset();
        r2(U . 'dashboard');

        break;

    case 'create':
        Demo::reset();
        Demo::makeReady('us');

        $cron = route(2);

        if ($cron == '1') {
            exit();
        } else {
            r2(U . 'dashboard');
        }

        break;
}
