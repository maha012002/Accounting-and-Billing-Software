<?php
if (!defined('APP_RUN')) {
    exit('No direct access allowed');
}

function ib_api_auth()
{
    $data = [];
    $data['success'] = false;
    $data['msg'] = '';

    if (function_exists('getallheaders')) {
        $headers = getallheaders();
    } elseif (function_exists(apache_request_headers)) {
        $headers = apache_request_headers();
    } else {
        $data['msg'] =
            'This Server is not Supported Bearer Token Authentication. Please Upgrade your Server to Latest PHP.';

        return $data;
    }

    if (!isset($headers['Authorization'])) {
        $data['msg'] = 'Authorization token not found with the Request.';

        return $data;
    }

    $token = $headers['Authorization'];
    $token = str_replace('Bearer', '', $token);
    $token = trim($token);

    $d = ORM::for_table('sys_users')
        ->where('at', $token)
        ->find_one();

    if ($d) {
        $data['msg'] = 'Authentication Successful';
        $data['success'] = true;
    } else {
        $data['msg'] = 'Invalid Authentication Token';
    }

    return $data;
}
