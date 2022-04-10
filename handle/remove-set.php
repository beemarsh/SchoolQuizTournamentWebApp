<?php
session_start();
define('handlecheckguest',TRUE);
include 'handlecheckguest.php';
if(defined('guest')){
    $_SESSION['errorcode']='x113';
    include 'error.php';
    exit();
}
define('session-cookie_check',TRUE);
define('sql-connection_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
include 'session-cookie_check.php';
    include 'sql-connection.php';
    $setname=mysqli_real_escape_string($sql_connect,$_GET['set']);
    $userid_encrypt=$_COOKIE['hafhk43'];
 $c = new McryptCipher('passKey');
 $userid = $c->decrypt($userid_encrypt);
    $select_set="DELETE FROM sets WHERE id='$userid' AND setname='$setname' ";
    mysqli_query($sql_connect,$select_set);
    header('location:../../manage_quiz');
?>