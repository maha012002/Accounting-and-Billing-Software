<?php
/* Smarty version 3.1.39, created on 2021-03-02 16:49:26
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/client-iview.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_603eb2e6c26427_52370770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af0d453eaa82802d341014328f806b22f7643370' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/client-iview.tpl',
      1 => 1614721762,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603eb2e6c26427_52370770 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $_smarty_tpl->tpl_vars['_L']->value['INVOICE'];?>
 - <?php echo $_smarty_tpl->tpl_vars['d']->value['invoicenum'];
if ($_smarty_tpl->tpl_vars['d']->value['cn'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['cn'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
 <?php }?></title>
    <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
storage/icon/favicon.ico" type="image/x-icon" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/lib/fa/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/lib/icheck/skins/all.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/css/animate.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/toggle/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/fonts/open-sans/open-sans.css?ver=4.0.1" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/css/style.css?ver=2.0.1" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/css/component.css?ver=2.0.1" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/css/custom.css" rel="stylesheet">

    <link href="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/icons/css/ibilling_icons.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/css/material.css" rel="stylesheet">

    <link href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/css/<?php echo $_smarty_tpl->tpl_vars['_c']->value['nstyle'];?>
.css" rel="stylesheet">

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plugin_ui_header_client']->value, 'plugin_ui_header_add');
$_smarty_tpl->tpl_vars['plugin_ui_header_add']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plugin_ui_header_add']->value) {
$_smarty_tpl->tpl_vars['plugin_ui_header_add']->do_else = false;
?>
        <?php echo $_smarty_tpl->tpl_vars['plugin_ui_header_add']->value;?>

    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    <?php if ($_smarty_tpl->tpl_vars['_c']->value['rtl'] == '1') {?>
        <link href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/css/bootstrap-rtl.min.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/css/style-rtl.min.css" rel="stylesheet">
    <?php }?>

    <?php if ((isset($_smarty_tpl->tpl_vars['xheader']->value))) {?>
        <?php echo $_smarty_tpl->tpl_vars['xheader']->value;?>

    <?php }?>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2059113892603eb2e6be7de0_64797927', 'style');
?>


    <?php echo $_smarty_tpl->tpl_vars['_c']->value['header_scripts'];?>

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

    <?php if (!empty($_smarty_tpl->tpl_vars['payment_gateways']->value['stripe'])) {?>
        <?php echo '<script'; ?>
 src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://js.stripe.com/v3/"><?php echo '</script'; ?>
>
    <?php }?>

</head>

<body class="fixed-nav">

<div class="paper">
    <section class="panel">
        <div class="panel-body">
            <div class="invoice">
                <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
                    <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>

                <?php }?>
                <header class="clearfix">
                    <div class="row">
                        <div class="col-sm-6 mt-md">
                            <h2 class="h2 mt-none mb-sm text-dark text-bold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['INVOICE'];?>
</h2>
                            <h4 class="h4 m-none text-dark text-bold">#<?php echo $_smarty_tpl->tpl_vars['d']->value['invoicenum'];
if ($_smarty_tpl->tpl_vars['d']->value['cn'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['cn'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
 <?php }?></h4>
                            <?php if ($_smarty_tpl->tpl_vars['d']->value['status'] == 'Unpaid') {?>
                                <h3 class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Unpaid'];?>
</h3>
                            <?php } elseif ($_smarty_tpl->tpl_vars['d']->value['status'] == 'Paid') {?>
                                <h3 class="alert alert-success"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Paid'];?>
</h3>
                            <?php } elseif ($_smarty_tpl->tpl_vars['d']->value['status'] == 'Partially Paid') {?>
                                <h3 class="alert alert-info"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Partially Paid'];?>
</h3>
                            <?php } else { ?>
                                <h3 class="alert alert-info"><?php echo $_smarty_tpl->tpl_vars['d']->value['status'];?>
</h3>
                            <?php }?>



                        </div>
                        <div class="col-sm-6 text-right mt-md mb-md">
                            <address class="ib mr-xlg">
                                <strong><?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</strong>
                                <br>
                                <?php echo $_smarty_tpl->tpl_vars['_c']->value['caddress'];?>

                            </address>
                            <div class="ib">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
application/storage/system/logo.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                </header>
                <div class="bill-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bill-to">
                                <p class="h5 mb-xs text-dark text-semibold"><strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoiced To'];?>
</strong></p>
                                <address>
                                    <?php if ($_smarty_tpl->tpl_vars['a']->value['company'] != '') {?>
                                        <?php echo $_smarty_tpl->tpl_vars['a']->value['company'];?>

                                        <br>
                                        <?php echo $_smarty_tpl->tpl_vars['_L']->value['ATTN'];?>
: <?php echo $_smarty_tpl->tpl_vars['d']->value['account'];?>

                                        <br>
                                    <?php } else { ?>
                                        <?php echo $_smarty_tpl->tpl_vars['d']->value['account'];?>

                                        <br>
                                    <?php }?>
                                    <?php echo $_smarty_tpl->tpl_vars['a']->value['address'];?>
 <br>
                                    <?php echo $_smarty_tpl->tpl_vars['a']->value['city'];?>
 <br>
                                    <?php echo $_smarty_tpl->tpl_vars['a']->value['state'];?>
 - <?php echo $_smarty_tpl->tpl_vars['a']->value['zip'];?>
 <br>
                                    <?php echo $_smarty_tpl->tpl_vars['a']->value['country'];?>

                                    <br>
                                    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Phone'];?>
:</strong> <?php echo $_smarty_tpl->tpl_vars['a']->value['phone'];?>

                                    <br>
                                    <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email'];?>
:</strong> <?php echo $_smarty_tpl->tpl_vars['a']->value['email'];?>

                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cf']->value, 'cfs');
$_smarty_tpl->tpl_vars['cfs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cfs']->value) {
$_smarty_tpl->tpl_vars['cfs']->do_else = false;
?>
                                        <br>
                                        <strong><?php echo $_smarty_tpl->tpl_vars['cfs']->value['fieldname'];?>
: </strong> <?php echo get_custom_field_value($_smarty_tpl->tpl_vars['cfs']->value['id'],$_smarty_tpl->tpl_vars['a']->value['id']);?>

                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    <?php echo $_smarty_tpl->tpl_vars['x_html']->value;?>

                                </address>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bill-data text-right">
                                <p class="mb-none">
                                    <span class="text-dark"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Date'];?>
</span>
                                    <span class="value"><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['d']->value['date']));?>
</span>
                                </p>
                                <p class="mb-none">
                                    <span class="text-dark"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Due Date'];?>
:</span>
                                    <span class="value"><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['d']->value['duedate']));?>
</span>
                                </p>

                                <h2> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Total'];?>
: <?php echo ib_money_format($_smarty_tpl->tpl_vars['d']->value['total'],$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
 </h2>
                                <?php if (($_smarty_tpl->tpl_vars['d']->value['credit']) != '0.00') {?>
                                    <h2> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Total Paid'];?>
: <?php echo ib_money_format($_smarty_tpl->tpl_vars['d']->value['credit'],$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</h2>
                                    <h2> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount Due'];?>
: <?php echo ib_money_format($_smarty_tpl->tpl_vars['i_due']->value,$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</h2>
                                <?php }?>
                                <?php if ((($_smarty_tpl->tpl_vars['d']->value['status']) != 'Paid') && (ib_pg_count() != '0' && (($_smarty_tpl->tpl_vars['d']->value['status']) != 'Cancelled'))) {?>
                                    <form class="form-inline" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/ipay/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/token_<?php echo $_smarty_tpl->tpl_vars['d']->value['vtoken'];?>
">

                                        <div class="form-group has-success">
                                            <select class="form-control" name="pg" id="pg">
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pgs']->value, 'pg');
$_smarty_tpl->tpl_vars['pg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pg']->value) {
$_smarty_tpl->tpl_vars['pg']->do_else = false;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['pg']->value['processor'];?>
"><?php echo $_smarty_tpl->tpl_vars['pg']->value['name'];?>
</option>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary ml-sm" id="btn_pay_now"><i class="fa fa-credit-card"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Pay Now'];?>
</button>
                                    </form>

                                    <?php if ($_smarty_tpl->tpl_vars['a']->value->balance > 0 && $_smarty_tpl->tpl_vars['d']->value->is_credit_invoice != 1) {?>
                                        <hr>
                                        <h3> Your Current Balance: <span class="amount"><?php echo $_smarty_tpl->tpl_vars['a']->value->balance;?>
</span> </h3>
                                        <a class="btn btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/pay_with_credit/<?php echo $_smarty_tpl->tpl_vars['d']->value->id;?>
/token_<?php echo $_smarty_tpl->tpl_vars['d']->value->vtoken;?>
"> Pay with Credit</a>
                                        <hr>
                                    <?php }?>

                                <?php }?>

                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table invoice-items">
                        <thead>
                        <tr class="h4 text-dark">
                            <th id="cell-id" class="text-semibold">#</th>
                            <th id="cell-item" class="text-semibold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Item'];?>
</th>

                            <th id="cell-price" class="text-center text-semibold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Price'];?>
</th>
                                                        <th id="cell-qty" class="text-center text-semibold"><?php if ($_smarty_tpl->tpl_vars['d']->value['show_quantity_as'] == '' || $_smarty_tpl->tpl_vars['d']->value['show_quantity_as'] == '1') {
echo $_smarty_tpl->tpl_vars['_L']->value['Qty'];
} else {
echo $_smarty_tpl->tpl_vars['d']->value['show_quantity_as'];
}?></th>
                            <th id="cell-total" class="text-center text-semibold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Total'];?>
</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['itemcode'];?>
</td>
                                <td class="text-semibold text-dark"><?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>
</td>

                                <td class="text-center"><?php echo ib_money_format($_smarty_tpl->tpl_vars['item']->value['amount'],$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</td>
                                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['item']->value['qty'];?>
</td>
                                <td class="text-center"><?php echo ib_money_format($_smarty_tpl->tpl_vars['item']->value['total'],$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                        </tbody>
                    </table>
                </div>

                <div class="invoice-summary">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-8">
                            <table class="table h5 text-dark">
                                <tbody>
                                <tr class="b-top-none">
                                    <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Sub Total'];?>
</td>
                                    <td class="text-left"><?php echo ib_money_format($_smarty_tpl->tpl_vars['d']->value['subtotal'],$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</td>
                                </tr>

                                <?php if (($_smarty_tpl->tpl_vars['d']->value['discount']) != '0.00') {?>
                                    <tr>
                                        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Discount'];?>

                                            <?php if ($_smarty_tpl->tpl_vars['d']->value['discount_type'] == 'p') {?>(<?php echo $_smarty_tpl->tpl_vars['d']->value['discount_value'];?>
%)<?php }?>
                                        </td>
                                        <td class="text-left"><?php echo ib_money_format($_smarty_tpl->tpl_vars['d']->value['discount'],$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</td>
                                    </tr>
                                <?php }?>

                                <tr>
                                    <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['TAX'];?>
</td>
                                    <td class="text-left"><?php echo ib_money_format($_smarty_tpl->tpl_vars['d']->value['tax'],$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</td>
                                </tr>
                                <?php if (($_smarty_tpl->tpl_vars['d']->value['credit']) != '0.00') {?>
                                    <tr>
                                        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Total'];?>
</td>
                                        <td class="text-left"><?php echo ib_money_format($_smarty_tpl->tpl_vars['d']->value['total'],$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Total Paid'];?>
</td>
                                        <td class="text-left"><?php echo ib_money_format($_smarty_tpl->tpl_vars['d']->value['credit'],$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</td>
                                    </tr>
                                    <tr class="h4">
                                        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount Due'];?>
</td>
                                        <td class="text-left"><?php echo ib_money_format($_smarty_tpl->tpl_vars['i_due']->value,$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</td>
                                    </tr>
                                <?php } else { ?>
                                    <tr class="h4">
                                        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Grand Total'];?>
</td>
                                        <td class="text-left"><?php echo ib_money_format($_smarty_tpl->tpl_vars['d']->value['total'],$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (($_smarty_tpl->tpl_vars['trs_c']->value != '')) {?>
                <h3><?php echo $_smarty_tpl->tpl_vars['_L']->value['Related Transactions'];?>
</h3>
                <table class="table table-bordered sys_table">
                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Date'];?>
</th>
                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Account'];?>
</th>


                    <th class="text-right"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>

                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Description'];?>
</th>




                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['trs']->value, 'tr');
$_smarty_tpl->tpl_vars['tr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tr']->value) {
$_smarty_tpl->tpl_vars['tr']->do_else = false;
?>
                        <tr class="<?php if ($_smarty_tpl->tpl_vars['tr']->value['cr'] == '0.00') {?>warning <?php } else { ?>info<?php }?>">
                            <td><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['tr']->value['date']));?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['tr']->value['account'];?>
</td>


                            <td class="text-right"><?php echo ib_money_format($_smarty_tpl->tpl_vars['tr']->value['amount'],$_smarty_tpl->tpl_vars['_c']->value,$_smarty_tpl->tpl_vars['d']->value['currency_symbol']);?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['tr']->value['description'];?>
</td>




                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>



                </table>
            <?php }?>



            <?php if (($_smarty_tpl->tpl_vars['d']->value['notes']) != '') {?>
                <div class="well m-t">
                    <?php echo $_smarty_tpl->tpl_vars['d']->value['notes'];?>

                </div>
            <?php }?>
            <div class="text-right">

                <br>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/dashboard/" class="btn btn-primary ml-sm no-shadow no-border"><i class="fa fa-long-arrow-left"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Back to Client Area'];?>
</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/ipdf/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/token_<?php echo $_smarty_tpl->tpl_vars['d']->value['vtoken'];?>
/dl/" class="btn btn-primary buttons-pdf ml-sm"><i class="fa fa-file-pdf-o"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Download PDF'];?>
</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/ipdf/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/token_<?php echo $_smarty_tpl->tpl_vars['d']->value['vtoken'];?>
/view/" class="btn btn-primary buttons-excel ml-sm"><i class="fa fa-file-text-o"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['View PDF'];?>
</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
iview/print/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/token_<?php echo $_smarty_tpl->tpl_vars['d']->value['vtoken'];?>
" target="_blank" class="btn btn-primary buttons-print ml-sm"><i class="fa fa-print"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Printable Version'];?>
</a>
            </div>
        </div>
    </section>



</div>



<input type="hidden" id="_url" name="_url" value="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
">
<input type="hidden" id="_df" name="_df" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['df'];?>
">
<input type="hidden" id="_lan" name="_lan" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['language'];?>
">
<!-- END PRELOADER -->
<!-- Mainly scripts -->

<?php echo '<script'; ?>
>

    var _L = [];


    _L['Save'] = '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Save'];?>
';
    _L['Submit'] = '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Submit'];?>
';
    _L['Loading'] = '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Loading'];?>
';
    _L['Media'] = '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Media'];?>
';
    _L['OK'] = '<?php echo $_smarty_tpl->tpl_vars['_L']->value['OK'];?>
';
    _L['Cancel'] = '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Cancel'];?>
';
    _L['Close'] = '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Close'];?>
';
    _L['Close'] = '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Close'];?>
';
    _L['are_you_sure'] = '<?php echo $_smarty_tpl->tpl_vars['_L']->value['are_you_sure'];?>
';
    _L['Saved Successfully'] = '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Saved Successfully'];?>
';
    _L['Empty'] = '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Empty'];?>
';

    var app_url = '<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
';
    var base_url = '<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
';

    <?php if (($_smarty_tpl->tpl_vars['_c']->value['animate']) == '1') {?>
    var config_animate = 'Yes';
    <?php } else { ?>
    var config_animate = 'No';
    <?php }?>
    <?php echo $_smarty_tpl->tpl_vars['jsvar']->value;?>

<?php echo '</script'; ?>
>



<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/js/jquery-1.10.2.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/js/jquery.metisMenu.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/js/jquery.slimscroll.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/ui/lib/blockui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/ui/lib/numeric.js"><?php echo '</script'; ?>
>



<?php if ($_smarty_tpl->tpl_vars['_c']->value['language'] != 'en') {?>

    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/moment/moment-with-locales.min.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
>
        moment.locale('<?php echo $_smarty_tpl->tpl_vars['_c']->value['momentLocale'];?>
');
    <?php echo '</script'; ?>
>

<?php } else { ?>

    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/moment/moment.min.js"><?php echo '</script'; ?>
>

<?php }?>




<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/ui/lib/app.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_theme']->value;?>
/js/theme.js"><?php echo '</script'; ?>
>




<!-- iCheck -->



<?php if ((isset($_smarty_tpl->tpl_vars['xfooter']->value))) {?>
    <?php echo $_smarty_tpl->tpl_vars['xfooter']->value;?>

<?php }?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1577317334603eb2e6c21916_82163070', 'script');
?>


<?php echo '<script'; ?>
>
    jQuery(document).ready(function() {
        // initiate layout and plugins

        matForms();

        <?php if ((isset($_smarty_tpl->tpl_vars['xjq']->value))) {?>
        <?php echo $_smarty_tpl->tpl_vars['xjq']->value;?>

        <?php }?>

        let $btn_pay_now = $('#btn_pay_now');
        let $pg = $('#pg');

        $btn_pay_now.on('click',function (event) {

            <?php if (!empty($_smarty_tpl->tpl_vars['payment_gateways']->value['stripe'])) {?>

            if($pg.val() === 'stripe'){
                event.preventDefault();
                $btn_pay_now.prop('disabled',true);
                // Create an instance of the Stripe object with your publishable API key
                var stripe = Stripe("<?php echo $_smarty_tpl->tpl_vars['payment_gateways']->value['stripe']['value'];?>
");

                fetch("<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/stripe-create-checkout-session/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['d']->value['vtoken'];?>
", {
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





            <?php }?>



        });



    });

<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['_c']->value['footer_scripts'];?>

</body>

</html>
<?php }
/* {block 'style'} */
class Block_2059113892603eb2e6be7de0_64797927 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'style' => 
  array (
    0 => 'Block_2059113892603eb2e6be7de0_64797927',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'style'} */
/* {block 'script'} */
class Block_1577317334603eb2e6c21916_82163070 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_1577317334603eb2e6c21916_82163070',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'script'} */
}
