<?php
$appurl = $_POST['appurl'];
$db_host = $_POST['dbhost'];
$db_user = $_POST['dbuser'];
$db_password = $_POST['dbpass'];
$db_name = $_POST['dbname'];
if ($appurl == '' or $db_host == '' or $db_user == '' or $db_name == '') {
    echo 'Please Input all the informations and try again.';
    exit();
}

try {
    $dbh = new pdo(
        "mysql:host=$db_host;dbname=$db_name",
        "$db_user",
        "$db_password",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

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

    $f_msg =
        'Can\'t create config file. The folder is not writable. You will have to manually create config file. Create a <strong>config.php</strong> inside- <strong>application</strong> folder with following contents- <hr>
<textarea rows="10" class="form-control">' .
        $input .
        '</textarea>
<span class="help-block">iBilling required some folders writable. It seems folders is not writable. The App may not work properly. For common troubleshooting tips, please visit- <strong><a href="http://www.ibilling.io/common-troubleshooting-tips/" target="_blank">http://www.ibilling.io/common-troubleshooting-tips/</a></strong></span>
';

    $wConfig = "../config.php";

    if (file_exists($wConfig)) {
        echo 'Config file exist. Please delete- <strong>application/config.php</strong> and try again.';
        exit();
    }

    ($fh = fopen($wConfig, 'w')) or die($f_msg);
    fwrite($fh, $input);
    fclose($fh);

    echo '1';
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}
