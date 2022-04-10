<?php
if(!defined('handlecheckguest')){
    include 'error.php';
    exit();
}
define('check',TRUE);
include '../crypt.php';
// Checking if logged in as guest
$guest_check=$_COOKIE['hafhk43'];
$c=new Mcryptcipher('passKey');
$user=$c->decrypt($guest_check);
if($user==0){
    define('guest',TRUE);
}