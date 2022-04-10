<?php
define('check',TRUE);
include 'crypt.php';
session_start();
$c=new McryptCipher('passKey');
if(isset($_POST['code'])){
$_SESSION['decrypted']=$c->decrypt($_POST['code']);
}
if(isset($_POST['encode'])){
    $_SESSION['decrypted']=$c->encrypt($_POST['encode']);
    }
header('location:decrypter.php');