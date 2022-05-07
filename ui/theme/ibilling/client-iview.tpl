<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{$_L['INVOICE']} - {$d['invoicenum']}{if $d['cn'] neq ''} {$d['cn']} {else} {$d['id']} {/if}</title>
    <link rel="shortcut icon" href="{$app_url}storage/icon/favicon.ico" type="image/x-icon" />
    <link href="{$_theme}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{$_theme}/lib/fa/css/font-awesome.min.css" rel="stylesheet">
    <link href="{$_theme}/lib/icheck/skins/all.css" rel="stylesheet">
    <link href="{$app_url}ui/lib/css/animate.css" rel="stylesheet">
    <link href="{$app_url}ui/lib/toggle/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="{$_theme}/fonts/open-sans/open-sans.css?ver=4.0.1" rel="stylesheet">
    <link href="{$_theme}/css/style.css?ver=2.0.1" rel="stylesheet">
    <link href="{$_theme}/css/component.css?ver=2.0.1" rel="stylesheet">
    <link href="{$_theme}/css/custom.css" rel="stylesheet">

    <link href="{$app_url}ui/lib/icons/css/ibilling_icons.css" rel="stylesheet">
    <link href="{$_theme}/css/material.css" rel="stylesheet">

    <link href="{$_theme}/css/{$_c['nstyle']}.css" rel="stylesheet">

    {foreach $plugin_ui_header_client as $plugin_ui_header_add}
        {$plugin_ui_header_add}
    {/foreach}

    {if $_c['rtl'] eq '1'}
        <link href="{$_theme}/css/bootstrap-rtl.min.css" rel="stylesheet">
        <link href="{$_theme}/css/style-rtl.min.css" rel="stylesheet">
    {/if}

    {if isset($xheader)}
        {$xheader}
    {/if}

    {block name=style}{/block}

    {$_c['header_scripts']}
    <style type="text/css">
        body {

            background-color: #FAFAFA;
            overflow-x: visible;
        }
        .paper {
            margin: 50px auto;
            width: 980px;
            border: 2px solid #DDD;
            background-color: #FFF;
            position: relative;

        }
    </style>

    {if !empty($payment_gateways['stripe'])}
        <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
        <script src="https://js.stripe.com/v3/"></script>
    {/if}

</head>

<body class="fixed-nav">

<div class="paper">
    <section class="panel">
        <div class="panel-body">
            <div class="invoice">
                {if isset($notify)}
                    {$notify}
                {/if}
                <header class="clearfix">
                    <div class="row">
                        <div class="col-sm-6 mt-md">
                            <h2 class="h2 mt-none mb-sm text-dark text-bold">{$_L['INVOICE']}</h2>
                            <h4 class="h4 m-none text-dark text-bold">#{$d['invoicenum']}{if $d['cn'] neq ''} {$d['cn']} {else} {$d['id']} {/if}</h4>
                            {if $d['status'] eq 'Unpaid'}
                                <h3 class="alert alert-danger">{$_L['Unpaid']}</h3>
                            {elseif $d['status'] eq 'Paid'}
                                <h3 class="alert alert-success">{$_L['Paid']}</h3>
                            {elseif $d['status'] eq 'Partially Paid'}
                                <h3 class="alert alert-info">{$_L['Partially Paid']}</h3>
                            {else}
                                <h3 class="alert alert-info">{$d['status']}</h3>
                            {/if}



                        </div>
                        <div class="col-sm-6 text-right mt-md mb-md">
                            <address class="ib mr-xlg">
                                <strong>{$_c['CompanyName']}</strong>
                                <br>
                                {$_c['caddress']}
                            </address>
                            <div class="ib">
                                <img src="{$app_url}application/storage/system/logo.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                </header>
                <div class="bill-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bill-to">
                                <p class="h5 mb-xs text-dark text-semibold"><strong>{$_L['Invoiced To']}</strong></p>
                                <address>
                                    {if $a['company'] neq ''}
                                        {$a['company']}
                                        <br>
                                        {$_L['ATTN']}: {$d['account']}
                                        <br>
                                    {else}
                                        {$d['account']}
                                        <br>
                                    {/if}
                                    {$a['address']} <br>
                                    {$a['city']} <br>
                                    {$a['state']} - {$a['zip']} <br>
                                    {$a['country']}
                                    <br>
                                    <strong>{$_L['Phone']}:</strong> {$a['phone']}
                                    <br>
                                    <strong>{$_L['Email']}:</strong> {$a['email']}
                                    {foreach $cf as $cfs}
                                        <br>
                                        <strong>{$cfs['fieldname']}: </strong> {get_custom_field_value($cfs['id'],$a['id'])}
                                    {/foreach}
                                    {$x_html}
                                </address>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bill-data text-right">
                                <p class="mb-none">
                                    <span class="text-dark">{$_L['Invoice Date']}</span>
                                    <span class="value">{date( $_c['df'], strtotime($d['date']))}</span>
                                </p>
                                <p class="mb-none">
                                    <span class="text-dark">{$_L['Due Date']}:</span>
                                    <span class="value">{date( $_c['df'], strtotime($d['duedate']))}</span>
                                </p>

                                <h2> {$_L['Invoice Total']}: {ib_money_format($d['total'],$_c,$d['currency_symbol'])} </h2>
                                {if ($d['credit']) neq '0.00'}
                                    <h2> {$_L['Total Paid']}: {ib_money_format($d['credit'],$_c,$d['currency_symbol'])}</h2>
                                    <h2> {$_L['Amount Due']}: {ib_money_format($i_due,$_c,$d['currency_symbol'])}</h2>
                                {/if}
                                {if (($d['status']) neq 'Paid') AND (ib_pg_count() neq '0' AND (($d['status']) neq 'Cancelled'))}
                                    <form class="form-inline" method="post" action="{$_url}client/ipay/{$d['id']}/token_{$d['vtoken']}">

                                        <div class="form-group has-success">
                                            <select class="form-control" name="pg" id="pg">
                                                {foreach $pgs as $pg}
                                                    <option value="{$pg['processor']}">{$pg['name']}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary ml-sm" id="btn_pay_now"><i class="fa fa-credit-card"></i> {$_L['Pay Now']}</button>
                                    </form>

                                    {if $a->balance > 0 && $d->is_credit_invoice neq 1}
                                        <hr>
                                        <h3> Your Current Balance: <span class="amount">{$a->balance}</span> </h3>
                                        <a class="btn btn-primary" href="{$_url}client/pay_with_credit/{$d->id}/token_{$d->vtoken}"> Pay with Credit</a>
                                        <hr>
                                    {/if}

                                {/if}

                                {*<a href="{$_url}client/ipay/{$d['id']}/token_{$d['vtoken']}" class="btn btn-info ml-sm"><i class="fa fa-credit-card"></i> Pay Now</a>*}

                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table invoice-items">
                        <thead>
                        <tr class="h4 text-dark">
                            <th id="cell-id" class="text-semibold">#</th>
                            <th id="cell-item" class="text-semibold">{$_L['Item']}</th>

                            <th id="cell-price" class="text-center text-semibold">{$_L['Price']}</th>
                            {*<th id="cell-qty" class="text-center text-semibold">{$_L['Quantity']}</th>*}
                            <th id="cell-qty" class="text-center text-semibold">{if $d['show_quantity_as'] eq '' || $d['show_quantity_as'] eq '1'}{$_L['Qty']}{else}{$d['show_quantity_as']}{/if}</th>
                            <th id="cell-total" class="text-center text-semibold">{$_L['Total']}</th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach $items as $item}
                            <tr>
                                <td>{$item['itemcode']}</td>
                                <td class="text-semibold text-dark">{$item['description']}</td>

                                <td class="text-center">{ib_money_format($item['amount'],$_c,$d['currency_symbol'])}</td>
                                <td class="text-center">{$item['qty']}</td>
                                <td class="text-center">{ib_money_format($item['total'],$_c,$d['currency_symbol'])}</td>
                            </tr>
                        {/foreach}

                        </tbody>
                    </table>
                </div>

                <div class="invoice-summary">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-8">
                            <table class="table h5 text-dark">
                                <tbody>
                                <tr class="b-top-none">
                                    <td colspan="2">{$_L['Sub Total']}</td>
                                    <td class="text-left">{ib_money_format($d['subtotal'],$_c,$d['currency_symbol'])}</td>
                                </tr>

                                {if ($d['discount']) neq '0.00'}
                                    <tr>
                                        <td colspan="2">{$_L['Discount']}
                                            {if $d['discount_type'] eq 'p'}({$d['discount_value']}%){/if}
                                        </td>
                                        <td class="text-left">{ib_money_format($d['discount'],$_c,$d['currency_symbol'])}</td>
                                    </tr>
                                {/if}

                                <tr>
                                    <td colspan="2">{$_L['TAX']}</td>
                                    <td class="text-left">{ib_money_format($d['tax'],$_c,$d['currency_symbol'])}</td>
                                </tr>
                                {if ($d['credit']) neq '0.00'}
                                    <tr>
                                        <td colspan="2">{$_L['Total']}</td>
                                        <td class="text-left">{ib_money_format($d['total'],$_c,$d['currency_symbol'])}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">{$_L['Total Paid']}</td>
                                        <td class="text-left">{ib_money_format($d['credit'],$_c,$d['currency_symbol'])}</td>
                                    </tr>
                                    <tr class="h4">
                                        <td colspan="2">{$_L['Amount Due']}</td>
                                        <td class="text-left">{ib_money_format($i_due,$_c,$d['currency_symbol'])}</td>
                                    </tr>
                                {else}
                                    <tr class="h4">
                                        <td colspan="2">{$_L['Grand Total']}</td>
                                        <td class="text-left">{ib_money_format($d['total'],$_c,$d['currency_symbol'])}</td>
                                    </tr>
                                {/if}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {if ($trs_c neq '')}
                <h3>{$_L['Related Transactions']}</h3>
                <table class="table table-bordered sys_table">
                    <th>{$_L['Date']}</th>
                    <th>{$_L['Account']}</th>


                    <th class="text-right">{$_L['Amount']}</th>

                    <th>{$_L['Description']}</th>




                    {foreach $trs as $tr}
                        <tr class="{if $tr['cr'] eq '0.00'}warning {else}info{/if}">
                            <td>{date( $_c['df'], strtotime($tr['date']))}</td>
                            <td>{$tr['account']}</td>


                            <td class="text-right">{ib_money_format($tr['amount'],$_c,$d['currency_symbol'])}</td>
                            <td>{$tr['description']}</td>




                        </tr>
                    {/foreach}



                </table>
            {/if}



            {if ($d['notes']) neq ''}
                <div class="well m-t">
                    {$d['notes']}
                </div>
            {/if}
            <div class="text-right">

                <br>
                <a href="{$_url}client/dashboard/" class="btn btn-primary ml-sm no-shadow no-border"><i class="fa fa-long-arrow-left"></i> {$_L['Back to Client Area']}</a>
                <a href="{$_url}client/ipdf/{$d['id']}/token_{$d['vtoken']}/dl/" class="btn btn-primary buttons-pdf ml-sm"><i class="fa fa-file-pdf-o"></i> {$_L['Download PDF']}</a>
                <a href="{$_url}client/ipdf/{$d['id']}/token_{$d['vtoken']}/view/" class="btn btn-primary buttons-excel ml-sm"><i class="fa fa-file-text-o"></i> {$_L['View PDF']}</a>
                <a href="{$_url}iview/print/{$d['id']}/token_{$d['vtoken']}" target="_blank" class="btn btn-primary buttons-print ml-sm"><i class="fa fa-print"></i> {$_L['Printable Version']}</a>
            </div>
        </div>
    </section>



</div>



<input type="hidden" id="_url" name="_url" value="{$_url}">
<input type="hidden" id="_df" name="_df" value="{$_c['df']}">
<input type="hidden" id="_lan" name="_lan" value="{$_c['language']}">
<!-- END PRELOADER -->
<!-- Mainly scripts -->

<script>

    var _L = [];


    _L['Save'] = '{$_L['Save']}';
    _L['Submit'] = '{$_L['Submit']}';
    _L['Loading'] = '{$_L['Loading']}';
    _L['Media'] = '{$_L['Media']}';
    _L['OK'] = '{$_L['OK']}';
    _L['Cancel'] = '{$_L['Cancel']}';
    _L['Close'] = '{$_L['Close']}';
    _L['Close'] = '{$_L['Close']}';
    _L['are_you_sure'] = '{$_L['are_you_sure']}';
    _L['Saved Successfully'] = '{$_L['Saved Successfully']}';
    _L['Empty'] = '{$_L['Empty']}';

    var app_url = '{$app_url}';
    var base_url = '{$base_url}';

    {if ($_c['animate']) eq '1'}
    var config_animate = 'Yes';
    {else}
    var config_animate = 'No';
    {/if}
    {$jsvar}
</script>



<script src="{$_theme}/js/jquery-1.10.2.js"></script>
<script src="{$_theme}/js/jquery.metisMenu.js"></script>
<script src="{$_theme}/js/jquery.slimscroll.min.js"></script>
<script src="{$_theme}/js/bootstrap.min.js"></script>
<script src="{$app_url}/ui/lib/blockui.js"></script>
<script src="{$app_url}/ui/lib/numeric.js"></script>



{if $_c['language'] neq 'en'}

    <script src="{$app_url}ui/lib/moment/moment-with-locales.min.js"></script>

    <script>
        moment.locale('{$_c['momentLocale']}');
    </script>

{else}

    <script src="{$app_url}ui/lib/moment/moment.min.js"></script>

{/if}




<script src="{$app_url}/ui/lib/app.js"></script>

<script src="{$_theme}/js/theme.js"></script>




<!-- iCheck -->



{if isset($xfooter)}
    {$xfooter}
{/if}

{block name=script}{/block}

<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins

        matForms();

        {if isset($xjq)}
        {$xjq}
        {/if}

        let $btn_pay_now = $('#btn_pay_now');
        let $pg = $('#pg');

        $btn_pay_now.on('click',function (event) {

            {if !empty($payment_gateways['stripe'])}

            if($pg.val() === 'stripe'){
                event.preventDefault();
                $btn_pay_now.prop('disabled',true);
                // Create an instance of the Stripe object with your publishable API key
                var stripe = Stripe("{$payment_gateways['stripe']['value']}");

                fetch("{$_url}client/stripe-create-checkout-session/{$d['id']}/{$d['vtoken']}", {
                    method: "POST",
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (session) {
                        return stripe.redirectToCheckout({ sessionId: session.id });
                    })
                    .then(function (result) {
                        // If redirectToCheckout fails due to a browser or network
                        // error, you should display the localized error message to your
                        // customer using error.message.
                        if (result.error) {
                            alert(result.error.message);
                        }
                    })
                    .catch(function (error) {
                        console.error("Error:", error);
                    });

            }





            {/if}



        });



    });

</script>
{$_c['footer_scripts']}
</body>

</html>
