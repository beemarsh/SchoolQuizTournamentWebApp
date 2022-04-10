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
if(!isset($_COOKIE['dijfnj'])||!isset($_COOKIE['reusMTP'])){
    include 'error.php';
    exit();
}
include 'session-cookie_check.php';
include 'sql-connection.php';
if(!isset($_POST['score'])){
    include 'error.php';
    exit();
}
include 'sql-connection.php';
$score=mysqli_real_escape_string($sql_connect,$_POST['score']);
$userId=$_COOKIE['reusMTP'];
$userCode=$_COOKIE['dijfnj'];
$sql1="UPDATE battle_active SET score=$score WHERE id=$userId AND code=$userCode";
mysqli_query($sql_connect,$sql1);
    echo 1;
exit();