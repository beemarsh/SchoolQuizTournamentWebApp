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
    $currentuser_encrypt=$_COOKIE['hafhk43'];
    $c = new McryptCipher('passKey');
    $currentuser= $c->decrypt($currentuser_encrypt);
    $select_table="SELECT * FROM sets WHERE id='$currentuser'";
    $query_table_set=mysqli_query($sql_connect,$select_table);
    if(isset($_POST['submit-set'])){
        if(isset($_POST['quizSetName']) && !empty($_POST['quizSetName'])){
            $set_name=mysqli_real_escape_string($sql_connect,$_POST['quizSetName']);
        }else{
            echo 'Please enter a quiz set';
            exit();
        }
        if(isset($_POST['quizFieldName']) && !empty($_POST['quizFieldName'])){
            $set_field=mysqli_real_escape_string($sql_connect,$_POST['quizFieldName']);
        }else{
            echo 'Please select a quiz field';
            exit();
        }
        randKeyGen:
        $getRandKey=mt_rand(1000000,9999999);
        $idCheckQuery="SELECT * FROM sets WHERE setId=$getRandKey";
        $idCheckQueryStore=mysqli_query($sql_connect,$idCheckQuery);
        if(mysqli_num_rows($idCheckQueryStore)!==0){
            goto randKeyGen;
        }
        $same_set_check="SELECT * FROM sets WHERE id='$currentuser' AND setname='$set_name'";
        $same_set_check_query=mysqli_query($sql_connect,$same_set_check);
        $check_set=mysqli_num_rows($same_set_check_query);
        if($check_set!==0){
            echo 'This set name is already taken';
            exit();
        }
        if(validate_string_spaces_only($set_name)===false){
            echo 'Only letters and numbers are allowed in set name';
            exit();
        }
        $insert_set="INSERT INTO sets(id,setname,field,setId)VALUES('$currentuser','$set_name','$set_field','$getRandKey')";
        mysqli_query($sql_connect,$insert_set);
        echo 'Success';
        exit();
    }
    function validate_string_spaces_only($string) {
        if(preg_match('/^[a-zA-Z0-9 .]+$/', $string)) {
            return true;
        } else {
            return false;
        }
    }
?>