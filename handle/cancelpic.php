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
    $c=new McryptCipher('passKey');
    $temp_pic_to_unnlink=$c->decrypt($_COOKIE['dfsdfr']);
    unlink($temp_pic_to_unnlink);   //Deleting file from temprorary location
    setcookie('dfsdfr','expired',1,'/'); //Deleting temrorary cookie that stores temprorary location
    exit();
?>