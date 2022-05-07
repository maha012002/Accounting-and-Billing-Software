<?php
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


if($fullname == '' || $email == '' || $password == '' ){

    exit('All fields are required');

}

if($password != $confirm_password ){

    exit('Password does not match');

}

$password = crypt($password,'ib_salt');

require '../config.php';

$dbh = new pdo( "mysql:host=$db_host;dbname=$db_name",
    "$db_user",
    "$db_password",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$sql = "UPDATE sys_users SET fullname='$fullname', username='$email', password='$password' WHERE id=1";

$stmt = $dbh->prepare($sql);

$stmt->execute();



echo '1';