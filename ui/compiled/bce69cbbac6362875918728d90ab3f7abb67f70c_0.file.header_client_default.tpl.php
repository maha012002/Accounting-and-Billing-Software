<?php
/* Smarty version 3.1.39, created on 2021-03-02 16:41:33
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/sections/header_client_default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_603eb10d9c0642_82799719',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bce69cbbac6362875918728d90ab3f7abb67f70c' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/sections/header_client_default.tpl',
      1 => 1557906298,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603eb10d9c0642_82799719 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>


<!--
Dynamically Auto Generated Page - Do Not Edit
================================================================
Software Name: iBilling - CRM, Accounting and Invoicing Software
Version: 4.6.1
Author: CloudOnex
Website: http://www.cloudonex.com
Contact: admin@ibilling.io
Purchase: http://www.cloudonex.com
License: You must have a valid license purchased in order to legally use this Software.
=======================================================================================
-->


<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $_smarty_tpl->tpl_vars['_title']->value;?>
</title>
    <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
application/storage/icon/favicon.ico" type="image/x-icon" />


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

    <?php echo $_smarty_tpl->tpl_vars['_c']->value['header_scripts'];?>


</head>

<body class="fixed-nav <?php if ($_smarty_tpl->tpl_vars['_c']->value['mininav']) {?>mini-navbar<?php }?>">
<section>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">

                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>

                <?php if ($_smarty_tpl->tpl_vars['user']->value['img'] == 'gravatar') {?>
                    <img src="http://www.gravatar.com/avatar/<?php echo md5(($_smarty_tpl->tpl_vars['user']->value['username']));?>
?s=64" class="img-circle" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
">
                                <?php } elseif ($_smarty_tpl->tpl_vars['user']->value['img'] == '') {?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/imgs/default-user-avatar.png"  class="img-circle" style="max-width: 64px;" alt="">
                                <?php } else { ?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['user']->value['img'];?>
" class="img-circle" style="max-width: 64px;" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
">
                <?php }?>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
</strong>
                             </span> <span class="text-muted text-xs block"><?php echo $_smarty_tpl->tpl_vars['_L']->value['My Account'];?>
 <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeIn m-t-xs">
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/profile/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit Profile'];?>
</a></li>

                                <li class="divider"></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/logout/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Logout'];?>
</a></li>
                            </ul>
                        </div>
                    </li>

                    <?php echo $_smarty_tpl->tpl_vars['client_extra_nav']->value[0];?>

                    <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'dashboard') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/dashboard/">
                            <i class="icon-th-large-outline"></i>
                            <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Dashboard'];?>
</span></a></li>
                    <?php echo $_smarty_tpl->tpl_vars['client_extra_nav']->value[1];?>


                    <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'orders') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/orders/"><i class="fa fa-server"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Orders'];?>
</span></a></li>

                    <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'invoices') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/invoices/"><i class="icon-credit-card-1"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoices'];?>
</span></a></li>
                    <?php echo $_smarty_tpl->tpl_vars['client_extra_nav']->value[2];?>

                    <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'quotes') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/quotes/"><i class="icon-article"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Quotes'];?>
</span></a></li>
                    <?php echo $_smarty_tpl->tpl_vars['client_extra_nav']->value[3];?>

                    <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'transactions') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/transactions/"><i class="icon-database"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Transactions'];?>
</span></a></li>
                    <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'downloads') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/downloads/"><i class="fa fa-file-o"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Downloads'];?>
</span></a></li>
                    <?php echo $_smarty_tpl->tpl_vars['client_extra_nav']->value[4];?>

                    <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'profile') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/profile/"><i class="icon-user-1"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Profile'];?>
</span></a></li>






                </ul>

            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-fixed-top white-bg" role="navigation" style="margin-bottom: 0">

                    <img class="logo" style="max-height: 40px; width: auto;" src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
application/storage/system/logo.png" alt="Logo">

                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-flat" href="#"><i class="fa fa-dedent"></i> </a>

                    </div>
                    <ul class="nav navbar-top-links navbar-right pull-right">





                        <li class="dropdown navbar-user">

                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

                                <?php if ($_smarty_tpl->tpl_vars['user']->value['img'] == 'gravatar') {?>
                                    <img src="http://www.gravatar.com/avatar/<?php echo md5(($_smarty_tpl->tpl_vars['user']->value['email']));?>
?s=200" class="img-circle" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
">
                                <?php } elseif ($_smarty_tpl->tpl_vars['user']->value['img'] == '') {?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/imgs/default-user-avatar.png" alt="">
                                <?php } else { ?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['user']->value['img'];?>
" class="img-circle" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['account'];?>
">
                                <?php }?>

                                <span class="hidden-xs"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Welcome'];?>
 <?php echo $_smarty_tpl->tpl_vars['user']->value['account'];?>
</span> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu animated fadeIn">
                                <li class="arrow"></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/profile/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit Profile'];?>
</a></li>

                                <li class="divider"></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/logout/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Logout'];?>
</a></li>

                            </ul>
                        </li>

                    </ul>

                </nav>
            </div>

            <div class="row wrapper white-bg page-heading">
                <div class="col-lg-12">
                    <h2 style="color: #2F4050; font-size: 16px; font-weight: 400; margin-top: 18px"><?php echo $_smarty_tpl->tpl_vars['_st']->value;?>
 </h2>

                </div>

            </div>

            <div class="wrapper wrapper-content animated fadeIn">
                <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
                <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>

<?php }
}
}
