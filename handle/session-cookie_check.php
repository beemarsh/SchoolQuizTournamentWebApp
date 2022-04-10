<?php
if(!defined('session-cookie_check')){
    include 'error.php';
    exit();
}
    if(!isset($_COOKIE['hafhk43'])){
        session_start();
        $_SESSION['error_direct']='Please login first';
        header('location:/quizee/login');
        exit();
    }
    if(!isset($_COOKIE['nbie09'])){
        session_start();
        $_SESSION['error_direct']='Please login first';
        header('location:/quizee/login');
        exit();
    }