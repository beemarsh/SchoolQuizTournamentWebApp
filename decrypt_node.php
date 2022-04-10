<?php
// now this file is uncescaary
define('check',TRUE);
include 'crypt.php';
session_start();
$c=new McryptCipher('passKey');
if(isset($_POST['code'])){
    $code_decoded=$c->decrypt($_POST['code']);
}
if(isset($_POST['id'])){
    $id_decoded=$c->encrypt($_POST['id']);
    }
    $temp_array=[$id_decoded,$code_decoded];
    $jsonified_str=json_encode($temp_array);
    echo  $jsonified_str;