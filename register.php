<?php
define('session-cookie_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
include 'handle/session-cookie_check.php';
?>