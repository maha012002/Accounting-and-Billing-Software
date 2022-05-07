<?php

@ini_set('memory_limit', '512M');
@ini_set('max_execution_time', 0);
@set_time_limit(0);
require 'application_installer_config.php';
$appurl = $_POST['appurl'];
$db_host = $_POST['dbhost'];
$db_user = $_POST['dbuser'];
$db_password = $_POST['dbpass'];
$db_name = $_POST['dbname'];
if ($appurl == '' or $db_host == '' or $db_user == '' or $db_name == '') {
    header("location: step3.php?_error=3");
    exit();
}
$cn = '0';
$wConfig = "../config.php";
if (file_exists($wConfig)) {
    header("location: step3.php?_error=2");
    exit();
}
try {
    $dbh = new pdo(
        "mysql:host=$db_host;dbname=$db_name",
        "$db_user",
        "$db_password",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $cn = '1';
} catch (PDOException $ex) {
    header("location: step3.php?_error=1");
    exit();
}

if ($cn == '1') {
    $input =
        '<?php
$db_host	    = \'' .
        $db_host .
        '\';
$db_user        = \'' .
        $db_user .
        '\';
$db_password	= \'' .
        $db_password .
        '\';
$db_name	    = \'' .
        $db_name .
        '\';
define(\'APP_URL\', \'' .
        $appurl .
        '\');
$_app_stage = \'Live\'; // You can set this variable Live to Dev to enable ibilling Debug
';

    ($fh = fopen($wConfig, 'w')) or
        die("Can't create config file, your server does not support 'fopen' function, or file does not have write permission. Please check the documentation for Manual Installation.
  <br/>
 $input
 ");
    fwrite($fh, $input);
    fclose($fh);

    $sql = file_get_contents('primary.sql');

    $qr = $dbh->exec($sql);
    //
} else {
    header("location: step3.php?_error=$cn");
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $app_name; ?> Installer</title>
    <link rel="shortcut icon" type="image/x-icon" href="../storage/icon/favicon.ico">
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
        <h4> <?php echo $app_name; ?> Installer </h4>
        <?php if ($cn == '1') { ?>
            <p>
                <strong>Config File Created and Database Imported.</strong><br>
            </p>
            <form action="step5.php" method="post">
                <fieldset>
                    <legend>Click Continue</legend>




                    <button type='submit' class='btn btn-primary'>Continue</button>
                </fieldset>
            </form>
        <?php } elseif ($cn == '2') { ?>
            <p> MySQL Connection was successfull. An error occured while adding data on MySQL. Unsuccessfull
                Installation. Please refer manual installation in the Documentation or Contact support@bdinfosys.com for
                helping on installation</p>
        <?php } else { ?>

            <p> MySQL Connection Failed. </p>
        <?php } ?>
    </div>
</div>

</div>

</body>
</html>

