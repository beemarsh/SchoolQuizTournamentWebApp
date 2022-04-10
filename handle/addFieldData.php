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
include 'sql-connection.php';
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
if(!isset($_COOKIE['dijfnj'])||!isset($_COOKIE['reusMTP'])){
    $_SESSION['errorcode']='x115';
    include 'error.php';
    exit();
}else{
    $userCode=$_COOKIE['dijfnj'];
    $userIdAdmin=$_COOKIE['reusMTP'];
}
if(!isset($_POST['msgField']) && !isset($_POST['msgGetField'])){
    $_SESSION['errorcode']='x114';
    include 'error.php';
    exit();
}
if(isset($_POST['msgField'])){//If ADmin sends Request to save Field to Multiplay
    $JSONmsg=$_POST['msgField'];
    $sql_query="UPDATE multiplay SET field=$JSONmsg WHERE id=$userIdAdmin AND code=$userCode";
    if(!mysqli_query($sql_connect,$sql_query)){
        echo 'There was an error';
        exit();
    }
    echo 1;
    exit();
}
if(isset($_POST['msgGetField'])){//If Client sends request to recieve Field Data
    $JSONmsg=$_POST['msgGetField'];
    $sql_query="SELECT * FROM multiplay WHERE code=$userCode";
    $storesql=mysqli_query($sql_connect,$sql_query);
    $check_no_OF=mysqli_num_rows($storesql);
    $field=mysqli_fetch_assoc($storesql);
    if($check_no_OF==0){        
        echo 1;
        exit();
    }
    echo $field['field'];
    exit();
}
