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
if(isset($_POST['submit_check'])){
if(isset($_POST['question']) && !empty($_POST['question'])){
    $question=mysqli_real_escape_string($sql_connect,$_POST['question']);
}else{
    echo 'Please fill all details';
    exit();
}
if(isset($_POST['answer'])&&!empty($_POST['answer'])){
    $answer=mysqli_real_escape_string($sql_connect,$_POST['answer']);
}else{
    echo 'Please fill all details';
    exit();
}
if(isset($_POST['opt1'])&&!empty($_POST['opt1'])){
    $opt1=mysqli_real_escape_string($sql_connect,$_POST['opt1']);
}else{
    echo 'Please fill all details';
    exit();
}
if(isset($_POST['opt2'])&&!empty($_POST['opt2'])){
    $opt2=mysqli_real_escape_string($sql_connect,$_POST['opt2']);
}else{
    echo 'Please fill all details';
    exit();
}
if(isset($_POST['opt3'])&& !empty($_POST['opt3'])){
    $opt3=mysqli_real_escape_string($sql_connect,$_POST['opt3']);
}else{
    echo 'Please fill all details';
    exit();
}
if(isset($_COOKIE['asfdfdg'])){
    $current_setname=$_COOKIE['asfdfdg'];
}else{
    echo 'Sorry! There was an error';
    exit();
}
if(isset($_COOKIE['asfsfbs'])){
    $current_field=$_COOKIE['asfsfbs'];
}else{
    echo 'Sorry! There was an error';
    exit();
}
   if(strnatcasecmp($opt1,$opt2)==0 ||strnatcasecmp($opt1,$opt3)==0 || strnatcasecmp($opt2,$opt3)==0 || strnatcasecmp($opt1,$answer)==0|| strnatcasecmp($opt2,$answer)==0|| strnatcasecmp($opt3,$answer)==0){
        echo 'Options cannot be same';
        exit();
    }
    $userid_encrypt=$_COOKIE['hafhk43'];
    $c = new McryptCipher('passKey');
    $userid= $c->decrypt($userid_encrypt);
    $insert_data="INSERT INTO quiz(id,question,answer,opt1,opt2,opt3,field,setname)VALUES('$userid','$question','$answer','$opt1','$opt2','$opt3','$current_field','$current_setname')";
    $insert_data_admin="INSERT INTO all_question_admin(question,answer,opt1,opt2,opt3,field)VALUES('$question','$answer','$opt1','$opt2','$opt3','$current_field')";
    mysqli_query($sql_connect,$insert_data);
    mysqli_query($sql_connect,$insert_data_admin);
    echo '1';
    session_destroy();
    exit();
}else{
    header('location:../manage_quiz');
}
?>