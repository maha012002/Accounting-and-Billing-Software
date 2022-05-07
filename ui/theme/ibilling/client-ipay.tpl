<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{$_L['INVOICE']} - {$d['id']}</title>

    <link href="{$_theme}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{$_theme}/lib/fa/css/font-awesome.min.css" rel="stylesheet">
    <link href="{$_theme}/lib/icheck/skins/all.css" rel="stylesheet">
    <link href="{$app_url}ui/lib/css/animate.css" rel="stylesheet">
    <link href="{$_theme}/css/style.css" rel="stylesheet">
    <link href="{$_theme}/css/custom.css" rel="stylesheet">

    {if $_c['rtl'] eq '1'}
        <link href="{$_theme}/css/bootstrap-rtl.min.css" rel="stylesheet">
        <link href="{$_theme}/css/style-rtl.min.css" rel="stylesheet">
    {/if}

    {if isset($xheader)}
        {$xheader}
    {/if}
    <style type="text/css">
        body {

            background-color: #FAFAFA;
            overflow-x: visible;
        }
        .paper {
            margin: 50px auto;

            border: 2px solid #DDD;
            background-color: #FFF;
            position: relative;
            width: 450px;
        }
    </style>
</head>

<body class="fixed-nav">

<div class="paper">
    <section class="panel">
        <div class="panel-body" style="font-size: 14px;">
            <div class="invoice">
                {if isset($notify)}
                    {$notify}
                {/if}
                <header class="clearfix">
                    <div class="row">
                        <div class="col-sm-6 mt-md">
                            <h2 class="h2 mt-none mb-sm text-dark text-bold">{$_L['INVOICE']}</h2>
                            <h4 class="h4 m-none text-dark text-bold">#{$d['invoicenum']}{if $d['cn'] neq ''} {$d['cn']} {else} {$d['id']} {/if}</h4>
                        </div>
                        <div class="col-sm-6 text-right mt-md mb-md">

                            <h4> {$_L['Invoice Total']}: {$_c['currency_code']} {number_format($d['total'],2,$_c['dec_point'],$_c['thousands_sep'])} </h4>
                            {if ($d['credit']) neq '0.00'}
                                <h4> {$_L['Total Paid']}: {$_c['currency_code']} {number_format($d['credit'],2,$_c['dec_point'],$_c['thousands_sep'])} </h4>
                                <h4> {$_L['Amount Due']}: {$_c['currency_code']} {number_format($i_due,2,$_c['dec_point'],$_c['thousands_sep'])} </h4>
                            {/if}
                        </div>
                    </div>
                </header>

                <div class="bill-info">
                    <div class="row">

                        <div class="col-md-12">
                            {if isset($ins)}
                                {$ins}
                            {/if}
                        </div>
                    </div>
                </div>



            </div>




        </div>
    </section>

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
<script src="{$app_url}ui/lib/app.js"></script>
<script src="{$app_url}ui/lib/toggle/bootstrap-toggle.min.js"></script>

<script src="{$_theme}/js/theme.js"></script>
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
