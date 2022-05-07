<?php

$apiKey = _post('apiKey');

if($apiKey == ''){
    $resp = [
        'success' => false,
        'message' => 'API Key is empty'
    ];

    api_response($resp);
}

$dataType = _post('dataType');

$check = ORM::for_table('sys_api')->where('apiKey',$apiKey)->find_one();

if($check){
    $resp = [
        'success' => true,
        'message' => 'Authentication Success'
    ];
}

else{
    $resp = [
        'success' => false,
        'message' => 'Authentication Failed'
    ];

    api_response($resp);
}

switch ($dataType){


    case 'auth':

        //

        break;

    case 'customers':

        $customers = ORM::for_table('crm_accounts')->find_array();

        api_response($customers);


        break;

    case 'companies':

        $companies = ORM::for_table('sys_companies')->find_array();

        api_response($companies);

        break;


    case 'invoices':

        $invoices = ORM::for_table('sys_invoices')->find_array();

        api_response($invoices);


        break;


    case 'invoice_items':


        $invoice_items = ORM::for_table('sys_invoiceitems')->find_array();

        api_response($invoice_items);


        break;


    case 'quotes':

        $quotes = ORM::for_table('sys_quotes')->find_array();

        api_response($quotes);


        break;


    case 'quote_items':


        $quote_items = ORM::for_table('sys_quoteitems')->find_array();

        api_response($quote_items);


        break;



    case 'transactions':

        $transactions = ORM::for_table('sys_transactions')->find_array();

        api_response($transactions);


        break;


    case 'groups':

        $groups = ORM::for_table('crm_groups')->find_array();

        api_response($groups);

        break;


    case 'accounts':

        $accounts = ORM::for_table('sys_accounts')->find_array();

        api_response($accounts);

        break;

    case 'appConfig':


        api_response($config);


        break;

    case 'items':

        $items = ORM::for_table('sys_items')->find_array();

        api_response($items);


        break;

    case 'currencies':

        $currencies = ORM::for_table('sys_currencies')->find_array();

        api_response($currencies);

        break;


    case 'categories':


        $categories = ORM::for_table('sys_cats')->find_array();

        api_response($categories);



        break;


    case 'custom_fields':

        $custom_fields = ORM::for_table('crm_customfields')->find_array();

        api_response($custom_fields);



        break;



    case 'custom_field_values':

        $custom_field_values = ORM::for_table('crm_customfieldsvalues')->find_array();

        api_response($custom_field_values);


        break;


    case 'api_keys':

        $api_keys = ORM::for_table('sys_api')->find_array();

        api_response($api_keys);

        break;


    case 'email_logs':

        $email_logs = ORM::for_table('sys_email_logs')->find_array();

        api_response($email_logs);

        break;


    case 'email_templates':

        $email_templates = ORM::for_table('sys_email_templates')->find_array();

        api_response($email_templates);

        break;


    case 'users':

        $i_users = ORM::for_table('sys_users')->find_array();

        api_response($i_users);


        break;

}