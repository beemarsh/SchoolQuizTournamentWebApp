<?php
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
    if(!isset($_POST['qid'])|| empty($_POST['qid'])){
        echo 'Please enter the ID';
        exit();
    }
    $quizId=mysqli_real_escape_string($sql_connect,$_POST['qid']);
    $selectQuizQuery="SELECT * FROM sets WHERE setId=$quizId";
    $selectQuizQueryStore=mysqli_query($sql_connect,$selectQuizQuery);
    if(mysqli_num_rows($selectQuizQueryStore)!==1){
        echo 'Sorry!The Quiz Set Doesnt exist';
        exit();
    }
    $getQuiz=mysqli_fetch_assoc($selectQuizQueryStore);
    $current_setName=$getQuiz['setname'];
    // Now select QUIZ quiz
    $data_store=array();
    $stock[]=''; 
            $select_ques="SELECT * FROM quiz where setname='$current_setName'";
            $select_ques_query=mysqli_query($sql_connect,$select_ques);
            $num_rows=mysqli_num_rows($select_ques_query);
            if($num_rows==0){
                echo 'No questions exist in this set';
                exit();
            }
            ini_set('error_reporting',E_STRICT);
            $init_count=1;
            $select_data="SELECT * FROM quiz where setname=$current_setName";
            $select_data_query=mysqli_query($sql_connect,$select_data);
            while($fetch_data=mysqli_fetch_assoc($select_data_query)){
            $indatas=[$fetch_data['question'],$fetch_data['answer'],$fetch_data['field'],$fetch_data['opt1'],$fetch_data['opt2'],$fetch_data['opt3']];
            $complete_indatas=[$init_count,$indatas];
            array_push($data_store,$complete_indatas);
            $init_count++;
            }
            echo json_encode($data_store);