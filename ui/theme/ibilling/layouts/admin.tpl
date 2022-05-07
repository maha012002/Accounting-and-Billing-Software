<!DOCTYPE html>

<!--
Dynamically Auto Generated Page - Do Not Edit
================================================================
Software Name: iBilling - CRM, Accounting and Invoicing Software
Author: CloudOneX
Website: https://www.cloudonex.com/
License: You must have a valid license in order to legally use this Software.
========================================================================================================================
-->


<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{$_title}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{$app_url}application/storage/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{$app_url}application/storage/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{$app_url}application/storage/icon/favicon-16x16.png">
    <link rel="manifest" href="{$app_url}application/storage/icon/site.webmanifest">
    <link rel="mask-icon" href="{$app_url}application/storage/icon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="{$app_url}application/storage/icon/favicon.ico">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="{$app_url}application/storage/icon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link href="{$app_url}ui/lib/css/ibilling.css?v=3" rel="stylesheet">

    <link href="{$_theme}/css/{$_c['nstyle']}.css" rel="stylesheet">

    {foreach $plugin_ui_header_admin as $plugin_ui_header_add}
        {$plugin_ui_header_add}
    {/foreach}

    {if $_c['rtl'] eq '1'}
        <link href="{$_theme}/css/bootstrap-rtl.min.css" rel="stylesheet">
        <link href="{$_theme}/css/style-rtl.min.css" rel="stylesheet">
    {/if}

    {if isset($xheader)}
        {$xheader}
    {/if}

    {foreach $plugin_ui_header_admin_css as $plugin_ui_header_add_css}
        <link href="{$plugin_ui_header_add_css}" rel="stylesheet">
    {/foreach}

</head>

<body class="fixed-nav {if $_c['mininav']}mini-navbar{/if}">
<section>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">

                {include file="$tplnav.tpl"}

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



                        <li class="hidden-xs">
                            <form class="navbar-form full-width" method="post" action="{$_url}contacts/list/">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="{$_L['Search Customers']}...">
                                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </li>




                        {if has_access($user->roleid,'utilities')}

                            <li class="dropdown">
                                <a class="dropdown-toggle count-info" data-toggle="dropdown" id="get_activity" href="#" aria-expanded="true">
                                    <i class="fa fa-bell"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-alerts" id="activity_loaded">



                                    <li id="activity_wait">
                                        <div class="text-center link-block">
                                            <a href="javascript:void(0)">
                                                <strong>{$_L['Please Wait']}...</strong> <br> <br>
                                                <img class="text-center" src="{$app_url}application/storage/system/download.gif" alt="Loading....">

                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>


                        {/if}



                        <li class="dropdown navbar-user">

                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

                                {if $user['img'] eq 'gravatar'}
                                    <img src="http://www.gravatar.com/avatar/{($user['username'])|md5}?s=200" class="img-circle" alt="{$user['fullname']}">
                                {elseif $user['img'] eq ''}
                                    <img src="{$app_url}ui/lib/imgs/default-user-avatar.png" alt="">
                                {else}
                                    <img src="{$user['img']}" class="img-circle" alt="{$user['fullname']}">
                                {/if}

                                <span class="hidden-xs">{$_L['Welcome']} {$user['fullname']}</span> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu animated fadeIn">
                                <li class="arrow"></li>
                                <li><a href="{$_url}settings/users-edit/{$user['id']}/">{$_L['Edit Profile']}</a></li>
                                <li><a href="{$_url}settings/change-password/">{$_L['Change Password']}</a></li>
                                <li class="divider"></li>
                                <li><a href="{$_url}logout/">{$_L['Logout']}</a></li>

                            </ul>
                        </li>

                        <li>
                            <a class="right-sidebar-toggle">
                                <i class="fa fa-tasks"></i>
                            </a>
                        </li>




                    </ul>

                </nav>
            </div>

            <div class="row wrapper white-bg page-heading">
                <div class="col-lg-12">
                    <h2 style="color: #2F4050; font-size: 16px; font-weight: 400; margin-top: 18px"> {$_st} </h2>

                </div>

            </div>

            <div class="wrapper wrapper-content {$_c['contentAnimation']}">
                {if isset($notify)}
                {$notify}
{/if}

                {block name="content"}{/block}

                <div id="ajax-modal" class="modal container fade-scale" tabindex="-1" style="display: none;"></div>
            </div>

            {if $tpl_footer}
                {if $_c['hide_footer']}

                {else}
                    <div class="footer">
                        <div>
                            <strong>{$_L['Copyright']}</strong> &copy; {$_c['CompanyName']}
                        </div>
                    </div>
                {/if}
            {/if}

        </div>

        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">

                    <li class="active"><a data-toggle="tab" href="#tab-1">
                            {$_L['Notes']}
                        </a></li>

                    <li class=""><a data-toggle="tab" href="#tab-3">
                            <i class="fa fa-gear"></i>
                        </a></li>
                </ul>

                <div class="tab-content">


                    <div id="tab-1" class="tab-pane active">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-file-text-o"></i> {$_L['Quick Notes']}</h3>

                        </div>

                        <div style="padding: 10px">

                            <form class="form-horizontal push-10-t push-10" method="post" onsubmit="return false;">

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material floating">
                                            <textarea class="form-control" id="ib_admin_notes" name="ib_admin_notes" rows="10">{$user->notes}</textarea>
                                            <label for="ib_admin_notes">{$_L['Whats on your mind']}</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button class="btn btn-sm btn-success" type="submit" id="ib_admin_notes_save"><i class="fa fa-check"></i> {$_L['Save']}</button>
                                    </div>
                                </div>
                            </form>
                        </div>




                    </div>


                    <div id="tab-3" class="tab-pane">

                        <div class="sidebar-title">
                            <h3><i class="fa fa-gears"></i> {$_L['Settings']}</h3>

                        </div>

                        <div class="setings-item">
                            <h4>{$_L['Theme_Color']}</h4>

                            <ul id="ib_theme_color" class="ib_theme_color">

                                <li><a href="{$_url}settings/set_color/light/"><span class="light"></span></a></li>
                                <li><a href="{$_url}settings/set_color/blue/"><span class="blue"></span></a></li>
                                <li><a href="{$_url}settings/set_color/dark/"><span class="dark"></span></a></li>
                            </ul>


                        </div>
                        <div class="setings-item">
                    <span>
                        {$_L['Fold Sidebar Default']}
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="r_fold_sidebar" {if get_option('mininav') eq '1'}checked{/if} class="onoffswitch-checkbox" id="r_fold_sidebar">
                                    <label class="onoffswitch-label" for="r_fold_sidebar">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>



        </div>

    </div>
</section>
<!-- BEGIN PRELOADER -->
{if ($_c['animate']) eq '1'}
    <div class="loader-overlay">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
{/if}
<input type="hidden" id="_url" name="_url" value="{$_url}">
<input type="hidden" id="_df" name="_df" value="{$_c['df']}">
<input type="hidden" id="_lan" name="_lan" value="{$_c['language']}">
<!-- END PRELOADER -->
<!-- Mainly scripts -->


<script>
    var _L = [];


    var app_url = '{$app_url}';
    var base_url = '{$base_url}';

    {if ($_c['animate']) eq '1'}
    var config_animate = 'Yes';
    {else}
    var config_animate = 'No';
    {/if}
    {$jsvar}
</script>

<script src="{$app_url}ui/lib/ibilling.js"></script>



{if isset($xfooter)}
    {$xfooter}
{/if}

{block name=script}{/block}

<script>
    $(function () {
        "use strict";
        matForms();
        {if isset($xjq)}
        {$xjq}
        {/if}
    });

</script>
</body>

</html>
