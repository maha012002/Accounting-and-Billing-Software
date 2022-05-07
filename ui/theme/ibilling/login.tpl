<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{$_L['Login']} - {$_title}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{$_theme}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{$_theme}/lib/fa/css/font-awesome.min.css" rel="stylesheet">


    <link rel="apple-touch-icon" sizes="180x180" href="{$app_url}application/storage/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{$app_url}application/storage/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{$app_url}application/storage/icon/favicon-16x16.png">
    <link rel="manifest" href="{$app_url}application/storage/icon/site.webmanifest">
    <link rel="mask-icon" href="{$app_url}application/storage/icon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="{$app_url}application/storage/icon/favicon.ico">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="{$app_url}application/storage/icon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link href="{$_theme}/css/logincss.css" rel="stylesheet">

    {if $_c['rtl'] eq '1'}
        <link href="{$_theme}/css/bootstrap-rtl.min.css" rel="stylesheet">
        <link href="{$_theme}/css/style-rtl.min.css" rel="stylesheet">
    {/if}


</head>

<body class="overflow-hidden light-background">
<div class="wrapper no-navigation preload">
    <div class="sign-in-wrapper">
        <div class="sign-in-inner">
            <div class="login-brand text-center">
                <img class="logo" src="{$app_url}application/storage/system/logo.png" alt="Logo">

            </div>
            {if isset($notify)}
                {$notify}
            {/if}
            <form class="login" method="post" action="{$_url}admin/post/{if isset($after)}{$after}/{/if}">
                <div class="form-group m-bottom-md">
                    <input type="text" class="form-control" id="username" name="username" placeholder="{$_L['Email Address']}">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="{$_L['Password']}">
                </div>



                <div class="m-top-md p-top-sm">

                    <button class="btn btn-success block full-width" name="login" type="submit">{$_L['Sign in']}</button>
                </div>

                <div class="m-top-md p-top-sm">
                    <div class="font-12 text-center m-bottom-xs">
                        <a href="{$_url}admin/forgot-pw/" class="font-12">{$_L['Forgot password']}</a>

                    </div>


                </div>
            </form>
        </div><!-- ./sign-in-inner -->
    </div><!-- ./sign-in-wrapper -->
</div><!-- /wrapper -->


<script src="{$_theme}/js/jquery-3.6.0.min.js"></script>


<script src="{$_theme}/js/bootstrap.min.js"></script>


</body>
</html>
