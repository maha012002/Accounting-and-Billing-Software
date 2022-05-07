<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{$_title}</title>
    <link rel="shortcut icon" href="{$app_url}application/storage/icon/favicon.ico" type="image/x-icon" />

    <link href="{$_theme}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{$_theme}/lib/fa/css/font-awesome.min.css" rel="stylesheet">
    <link href="{$_theme}/lib/icheck/skins/all.css" rel="stylesheet">
    <link href="{$app_url}ui/lib/toggle/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="{$_theme}/css/style.css?ver=2.0.1" rel="stylesheet">
    <link href="{$_theme}/css/component.css?ver=2.0.1" rel="stylesheet">
    <link href="{$_theme}/css/custom.css" rel="stylesheet">
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

</head>
<body class="focused-form">


<div class="container" id="login-form">
    <a href="{$_url}client/login/" class="login-logo"><img src="{$app_url}application/storage/system/logo.png"></a>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            {if isset($notify)}
                {$notify}
            {/if}


            <form action="?ng=client/forgot_pw_post/" method="post" class="" id="validate-form">



                <div class="panel panel-default md-card">
                    <div class="panel-heading"><h2>Password Reset</h2></div>
                    <div class="panel-body">


                        <div class="form-group">

                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</span>
                                <input type="email" class="form-control" id="username" name="username" placeholder="Email Username" required>
                            </div>

                        </div>




                    </div>
                    <div class="panel-footer">
                        <div class="clearfix">

                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </div>
                </div>


            </form>




            <div class="text-center">
                <a href="{$_url}client/register/" class="mb20">Signup Here</a> |
                <a href="{$_url}client/login/">Login</a>
            </div>
        </div>
    </div>
</div>


<!-- Load site level scripts -->

<script src="{$_theme}/js/jquery-1.10.2.js"></script>
<script src="{$_theme}/js/jquery-ui-1.10.4.min.js"></script>

<script src="{$_theme}/js/bootstrap.min.js"></script>

<!-- End loading site level scripts -->
<!-- Load page level scripts-->


<!-- End loading page level scripts-->
</body>
</html>