<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{$_title}</title>
    <link rel="shortcut icon" href="{$app_url}application/storage/icon/favicon.ico" type="image/x-icon" />


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

    {$_c['header_scripts']}

</head>

<body class="fixed-nav {if $_c['mininav']}mini-navbar{/if}">
<section>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">

                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>

                {if $user['img'] eq 'gravatar'}
                    <img src="http://www.gravatar.com/avatar/{($user['username'])|md5}?s=64" class="img-circle" alt="{$user['fullname']}">
                                {elseif $user['img'] eq ''}
                                    <img src="{$app_url}ui/lib/imgs/default-user-avatar.png"  class="img-circle" style="max-width: 64px;" alt="">
                                {else}
                                    <img src="{$user['img']}" class="img-circle" style="max-width: 64px;" alt="{$user['fullname']}">
                {/if}
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{$user['fullname']}</strong>
                             </span> <span class="text-muted text-xs block">{$_L['My Account']} <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeIn m-t-xs">
                                <li><a href="{$_url}client/profile/">{$_L['Edit Profile']}</a></li>

                                <li class="divider"></li>
                                <li><a href="{$_url}client/logout/">{$_L['Logout']}</a></li>
                            </ul>
                        </div>
                    </li>

                    {$client_extra_nav[0]}
                    <li {if $_application_menu eq 'dashboard'}class="active"{/if}><a href="{$_url}client/dashboard/">
                            <i class="icon-th-large-outline"></i>
                            <span class="nav-label">{$_L['Dashboard']}</span></a></li>
                    {$client_extra_nav[1]}

                    <li {if $_application_menu eq 'orders'}class="active"{/if}><a href="{$_url}client/orders/"><i class="fa fa-server"></i> <span class="nav-label">{$_L['Orders']}</span></a></li>

                    <li {if $_application_menu eq 'invoices'}class="active"{/if}><a href="{$_url}client/invoices/"><i class="icon-credit-card-1"></i> <span class="nav-label">{$_L['Invoices']}</span></a></li>
                    {$client_extra_nav[2]}
                    <li {if $_application_menu eq 'quotes'}class="active"{/if}><a href="{$_url}client/quotes/"><i class="icon-article"></i> <span class="nav-label">{$_L['Quotes']}</span></a></li>
                    {$client_extra_nav[3]}
                    <li {if $_application_menu eq 'transactions'}class="active"{/if}><a href="{$_url}client/transactions/"><i class="icon-database"></i> <span class="nav-label">{$_L['Transactions']}</span></a></li>
                    <li {if $_application_menu eq 'downloads'}class="active"{/if}><a href="{$_url}client/downloads/"><i class="fa fa-file-o"></i> <span class="nav-label">{$_L['Downloads']}</span></a></li>
                    {$client_extra_nav[4]}
                    <li {if $_application_menu eq 'profile'}class="active"{/if}><a href="{$_url}client/profile/"><i class="icon-user-1"></i> <span class="nav-label">{$_L['Profile']}</span></a></li>






                </ul>

            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-fixed-top white-bg" role="navigation" style="margin-bottom: 0">

                    <img class="logo" style="max-height: 40px; width: auto;" src="{$app_url}application/storage/system/logo.png" alt="Logo">

                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-flat" href="#"><i class="fa fa-dedent"></i> </a>

                    </div>
                    <ul class="nav navbar-top-links navbar-right pull-right">





                        <li class="dropdown navbar-user">

                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

                                {if $user['img'] eq 'gravatar'}
                                    <img src="http://www.gravatar.com/avatar/{($user['email'])|md5}?s=200" class="img-circle" alt="{$user['fullname']}">
                                {elseif $user['img'] eq ''}
                                    <img src="{$app_url}ui/lib/imgs/default-user-avatar.png" alt="">
                                {else}
                                    <img src="{$user['img']}" class="img-circle" alt="{$user['account']}">
                                {/if}

                                <span class="hidden-xs">{$_L['Welcome']} {$user['account']}</span> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu animated fadeIn">
                                <li class="arrow"></li>
                                <li><a href="{$_url}client/profile/">{$_L['Edit Profile']}</a></li>

                                <li class="divider"></li>
                                <li><a href="{$_url}client/logout/">{$_L['Logout']}</a></li>

                            </ul>
                        </li>

                    </ul>

                </nav>
            </div>

            <div class="row wrapper white-bg page-heading">
                <div class="col-lg-12">
                    <h2 style="color: #2F4050; font-size: 16px; font-weight: 400; margin-top: 18px">{$_st} </h2>

                </div>

            </div>

            <div class="wrapper wrapper-content animated fadeIn">
                {if isset($notify)}
                {$notify}
{/if}
