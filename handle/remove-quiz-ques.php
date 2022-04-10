<?php
session_start();
define('handlecheckguest',TRUE);
include 'handlecheckguest.php';
if(defined('guest')){
    $_SESSION['errorcode']='x113';
    include 'error.php';
    exit();
}
define('sql-connection_check',TRUE);
define('session-cookie_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
    include 'session-cookie_check.php';
    include 'sql-connection.php';
    $location='location:../quizset_manage/'.$_GET['set'];
    if(isset($_GET['quiz-id'])){
        $id_of_quiz=mysqli_real_escape_string($sql_connect,$_GET['quiz-id']);
        $set_name=mysqli_real_escape_string($sql_connect,$_GET['set']);
    }else{
        header($location);
        exit();
    }
    $current_id_encrypt=$_COOKIE['hafhk43'];
    $c = new McryptCipher('passKey');
    $current_id = $c->decrypt($current_id_encrypt);
    $delete_query="DELETE FROM quiz WHERE id='$current_id' AND id_of_quiz='$id_of_quiz' AND setname='$set_name' ";
    $select_query="SELECT * FROM quiz WHERE id='$current_id' AND id_of_quiz='$id_of_quiz' AND setname='$set_name'";
    $query_select_question=mysqli_query($sql_connect,$select_query);
    $row_check=mysqli_num_rows($query_select_question);
    $location2='location:../../../quizset_manage/'.$_GET['set'];
    if($row_check===0){
        //Sorry there was an error
        header($location2);
        exit();
    }else{
        mysqli_query($sql_connect,$delete_query);
        header($location2);
        exit();
    }

?>