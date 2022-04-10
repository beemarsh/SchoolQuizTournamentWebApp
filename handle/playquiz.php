<?php
define('session-cookie_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
include 'session-cookie_check.php';
    header('location:../taketour');
?>