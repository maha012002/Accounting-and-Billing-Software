<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
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
    <link href="{$app_url}ui/lib/css/client_login.css" rel="stylesheet">

    <link href="{$_theme}/lib/icheck/skins/all.css" rel="stylesheet">

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

</head>
<body class="focused-form">


<div class="container" id="login-form">
    <a href="{$_url}client/login/" class="login-logo"><img src="{$app_url}application/storage/system/logo.png"></a>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            {if isset($notify)}
                {$notify}
            {/if}


            <form action="{$_url}client/auth/" method="post" class="" id="validate-form">



                <div class="panel panel-default md-card">
                    <div class="panel-heading"><h2>Client Login</h2></div>
                    <div class="panel-body">


                        <div class="form-group">

                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</span>
                                <input type="email" class="form-control" id="username" name="username" placeholder="Email Username" required>
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-key"></i>
								</span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>

                        </div>


                        <div class="i-checks"><label  style="padding-left: 0"> <input name="remember_me" checked class="ib_checkbox" type="checkbox" value="yes"> {$_L['Remember me']}</label></div>


                    </div>
                    <div class="panel-footer">
                        <div class="clearfix">

                            <button type="submit" class="btn btn-primary pull-right">Login</button>
                        </div>
                    </div>
                </div>


            </form>




            <div class="text-center">
                <a href="{$_url}client/register/" class="mb20"><i class="ion-social-facebook"></i>Signup Here</a> |
                <a href="{$_url}client/forgot_pw/" class="mb20"><i class="ion-social-twitter"></i>Forgot Password ?</a>
            </div>
        </div>
    </div>
</div>



<script src="{$_theme}/js/jquery-3.6.0.min.js"></script>
<script src="{$_theme}/js/jquery-ui-1.10.4.min.js"></script>

<script src="{$_theme}/js/bootstrap.min.js"></script>

<script src="{$_theme}/lib/icheck/icheck.min.js"></script>


<script type="text/javascript">
    $(function() {

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue'
        });


    });
</script>

<!-- End loading page level scripts-->
</body>
</html>
