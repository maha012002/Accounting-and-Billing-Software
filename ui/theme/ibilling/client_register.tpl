
<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title>{$_title}</title>
    <link rel="shortcut icon" href="{$app_url}application/storage/icon/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="57x57" href="{$app_url}application/storage/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{$app_url}application/storage/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{$app_url}application/storage/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{$app_url}application/storage/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{$app_url}application/storage/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{$app_url}application/storage/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{$app_url}application/storage/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{$app_url}application/storage/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{$app_url}application/storage/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="{$app_url}application/storage/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{$app_url}application/storage/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{$app_url}application/storage/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{$app_url}application/storage/icon/favicon-16x16.png">
    <link rel="manifest" href="{$app_url}application/storage/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{$app_url}application/storage/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="{$_theme}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{$_theme}/lib/fa/css/font-awesome.min.css" rel="stylesheet">
    <link href="{$_theme}/lib/icheck/skins/all.css" rel="stylesheet">
    <link href="{$app_url}ui/lib/css/animate.css" rel="stylesheet">
    <link href="{$app_url}ui/lib/toggle/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="{$_theme}/fonts/open-sans/open-sans.css?ver=4.0.1" rel="stylesheet">
    <link href="{$_theme}/css/style.css?ver=2.0.1" rel="stylesheet">
    <link href="{$_theme}/css/component.css?ver=2.0.1" rel="stylesheet">
    <link href="{$_theme}/css/custom.css" rel="stylesheet">

    <link href="{$_theme}/css/material.css" rel="stylesheet">

    <link href="{$_theme}/css/{$_c['nstyle']}.css" rel="stylesheet">

    <link href="{$app_url}ui/lib/css/client_login.css" rel="stylesheet">

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
    {if $_c['recaptcha'] eq '1'}
    <script src='https://www.google.com/recaptcha/api.js'></script>
    {/if}
</head>
<body class="focused-form">


<div class="container" id="registration-form">
    <a href="{$_url}client/login/" class="login-logo"><img src="{$app_url}application/storage/system/logo.png"></a>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form method="post" action="{$_url}client/register_post/" id="iform">
                <div class="panel panel-default alt md-card">
                    <div class="panel-heading"><h2>Registration Form</h2></div>
                    <div class="panel-body">
                        <form action="" class="">
                            <div class="form-group">
                                <label for="fullname" class="control-label">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name">
                            </div>

                            <div class="form-group">
                                <label for="email" class="control-label">Email Address</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="someone@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="******">
                            </div>
                            <div class="form-group">
                                <label for="password2" class="control-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="******">
                            </div>

                            {foreach $extra_fields as $field}

                                <div class="form-group">
                                    <label for="{$field['id']}" class="control-label">{$field['label']}</label>
                                    <input type="text" class="form-control" id="{$field['id']}" name="{$field['name']}" {if isset($field['placeholder'])}placeholder="{$field['placeholder']}"{/if}>
                                    {if isset($field['help_block'])}<span class="help-block">{$field['help_block']}</span>{/if}
                                </div>



                            {/foreach}


                            {if $_c['recaptcha'] eq '1'}
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{$_c['recaptcha_sitekey']}"></div>
                                </div>
                            {/if}


                        </form>
                    </div>
                    <div class="panel-footer">
                        <div class="clearfix">
                            <a href="{$_url}client/login/" class="pull-left mt-xs">Already Registered? Login</a>
                            <button type="submit" id="btn_form_action" class="btn btn-primary pull-right">Register</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<input type="hidden" id="_url" name="_url" value="{$_url}">
<input type="hidden" id="_df" name="_df" value="{$_c['df']}">
<input type="hidden" id="_lan" name="_lan" value="{$_c['language']}">
<!-- END PRELOADER -->
<!-- Mainly scripts -->
<script src="{$_theme}/js/jquery-1.10.2.js"></script>
<script src="{$_theme}/js/jquery-ui-1.10.4.min.js"></script>
<script>
    var _L = [];
    var config_animate = 'No';
    {if ($_c['animate']) eq '1'}
    var config_animate = 'Yes';
    {/if}
    {$jsvar}
</script>
<script src="{$_theme}/js/bootstrap.min.js"></script>
<script src="{$_theme}/js/jquery.metisMenu.js"></script>
<script src="{$_theme}/js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="{$_theme}/lib/moment.js"></script>
<script src="{$app_url}ui/lib/blockui.js"></script>
<script src="{$app_url}ui/lib/toggle/bootstrap-toggle.min.js"></script>

<script src="{$app_url}ui/lib/app.js"></script>

{if ($_c['animate']) eq '1'}
    <script src="{$_theme}/js/pace.min.js"></script>
{/if}
<script src="{$_theme}/lib/progress.js"></script>
<script src="{$_theme}/lib/bootbox.min.js"></script>

<!-- iCheck -->
<script src="{$_theme}/lib/icheck/icheck.min.js"></script>
{if isset($xfooter)}
    {$xfooter}
{/if}
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins

        matForms();

        {if isset($xjq)}
        {$xjq}
        {/if}

    });

</script>

</body>
</html>