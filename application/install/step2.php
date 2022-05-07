<?php
require 'application_installer_config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $app_name; ?> Installer</title>
    <link rel="shortcut icon" type="image/x-icon" href="../storage/icon/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../ui/theme/ibilling/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../ui/theme/ibilling/lib/fa/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../ui/theme/ibilling/lib/icheck/skins/all.css" rel="stylesheet">
    <link href="../../ui/lib/css/animate.css" rel="stylesheet">
    <link href="../../ui/lib/toggle/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="../../ui/theme/ibilling/css/style.css?ver=2.0.1" rel="stylesheet">
    <link href="../../ui/theme/ibilling/css/component.css?ver=2.0.1" rel="stylesheet">
    <link href="../../ui/theme/ibilling/css/custom.css" rel="stylesheet">
    <link href="../../ui/lib/icons/css/ibilling_icons.css" rel="stylesheet">
    <link href="../../ui/theme/ibilling/css/material.css" rel="stylesheet">
    <link type='text/css' href='style.css' rel='stylesheet'/>

</head>
<body style='background-color: #FBFBFB;'>
<div id='main-container'>
    <div class='header'>
        <div class="header-box wrapper">
            <div class="hd-logo"><a href="#"><img src="../storage/system/logo.png" alt="Logo"/></a></div>
        </div>

    </div>
    <!--  contents area start  -->
    <div class="col-md-12">
       <hr>
        <?php
        $passed = '';
        $ltext = '';
        if (version_compare(PHP_VERSION, '7.1.3') >= 0) {
            $ltext .=
                'To Run ' .
                $app_name .
                ' You need at least PHP version 7.1.3, Your PHP Version is: ' .
                PHP_VERSION .
                " Tested <strong>---PASSED---</strong><br/>";
            $passed .= '1';
        } else {
            $ltext .=
                'To Run ' .
                $app_name .
                ' You need at least PHP version 7.1.3, Your PHP Version is: ' .
                PHP_VERSION .
                " Tested <strong>---FAILED---</strong><br/>";
            $passed .= '0';
        }

        if (extension_loaded('PDO')) {
            $ltext .=
                'PDO is installed on your server: ' .
                "Tested <strong>---PASSED---</strong><br/>";
            $passed .= '1';
        } else {
            $ltext =
                'PDO is installed on your server: ' .
                "Tested <strong>---FAILED---</strong><br/>";
            $passed .= '0';
        }

        if (extension_loaded('pdo_mysql')) {
            $ltext .=
                'PDO MySQL driver is enabled on your server: ' .
                "Tested <strong>---PASSED---</strong><br/>";
            $passed .= '1';
        } else {
            $ltext .=
                'PDO MySQL driver is not enabled on your server: ' .
                "Tested <strong>---FAILED---</strong><br/>";
            $passed .= '0';
        }
        if ($passed == '111') {
            echo "<br/> $ltext <br/> Great! System Test Completed. You can run  $app_name on your server. Click Continue For Next Step.
 <br><br>
 <a href=\"step3.php\" class=\"btn btn-primary\">Continue</a> 
 ";
        } else {
            echo "<br/> $ltext <br/> Sorry. The requirements of $app_name is not available on your server.
 Please contact with this page- $support_url with this code- $passed Or contact with your server administrator
  <br><br>
 <a href=\"#\" class=\"btn btn-primary disabled\">Correct The Problem To Continue</a> 
 ";
        }
        ?>
    </div>


    <!--  contents area end  -->
</div>

<script src="../../ui/theme/ibilling/js/jquery-1.10.2.js"></script>
<script src="../../ui/theme/ibilling/js/bootstrap.min.js"></script>
<script src="../../ui/lib/blockui.js"></script>

</body>
</html>

