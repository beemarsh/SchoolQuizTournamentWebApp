<?php
define('sql-connection_check',TRUE);
define('session-cookie_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
include 'session-cookie_check.php';
include 'sql-connection.php';
session_start();
    $field=mysqli_real_escape_string($sql_connect,$_POST['field']);
    $no_of_ques=mysqli_real_escape_string($sql_connect,$_POST['no']);
    $ActualFields=explode(',',$field);//Making field an array of Fields
    if($no_of_ques>50 || $no_of_ques<10){//Checking if questions are more or less
        echo json_encode(1);
        exit();
    }
    if(in_array('Geography',$ActualFields) || in_array('Science',$ActualFields) || in_array('History',$ActualFields) || in_array('Mixed',$ActualFields) || in_array('Literature',$ActualFields)){
     $j='god';//DO NTG
    }else{//BUT IF FIELDS ARE NOT RIGHT
        echo json_encode(1);
        exit();
    }
    $data_store=array();
    $stock[]='';
    if($ActualFields[0]=='Mixed'){//If field is Not mixed   
            $select_ques="SELECT * FROM all_question_admin ";
            $select_ques_query=mysqli_query($sql_connect,$select_ques);
            $num_rows=mysqli_num_rows($select_ques_query);
            ini_set('error_reporting',E_STRICT);
    for($i=1;$i<=$no_of_ques;$i++){
        check:
        $randa=mt_rand(1,$num_rows);
        if(in_array($randa,$stock)){
            goto check ;
        }
            array_push($stock,$randa);

            $select_data="SELECT * FROM all_question_admin WHERE sn='$randa'";
            $select_data_query=mysqli_query($sql_connect,$select_data);
            $numOfRows=mysqli_num_rows($select_data_query);
            if($numOfRows==0){
                goto check;
            }
            $fetch_data=mysqli_fetch_assoc($select_data_query);
    
            $indatas=[$fetch_data['question'],$fetch_data['answer'],$fetch_data['field'],$fetch_data['opt1'],$fetch_data['opt2'],$fetch_data['opt3']];
            $complete_indatas=[$i,$indatas];
            array_push($data_store,$complete_indatas);
    }
    }else{//If field is Not Mixed
        $sql1SelectQuery="SELECT * FROM all_question_admin WHERE ";
        for($i=0;$i<count($ActualFields);$i++){
            if($i==count($ActualFields)-1){//IF the Array is Last Dont add OR
                $sql1SelectQuery.="field='".$ActualFields[$i]."'";
            }else{
                $sql1SelectQuery.="field='".$ActualFields[$i]."' OR ";
            }
        }
        $storeSQLData=mysqli_query($sql_connect,$sql1SelectQuery);
        $empArray=[];
        $c=0;
        while($sql1Fetch=mysqli_fetch_assoc($storeSQLData)){
            // if($no_of_ques==$c){//If more than questions then break Loop
            // break;
            // }
            $FetchedQuesAns=[$sql1Fetch['question'],$sql1Fetch['answer'],$sql1Fetch['field'],$sql1Fetch['opt1'],$sql1Fetch['opt2'],$sql1Fetch['opt3']];
            $QuestionsArrayManage=[$c,$FetchedQuesAns];
            array_push($empArray,$QuestionsArrayManage);
            $c++;
        }
        for($d=0;$d<$no_of_ques;$d++){
            checkLast:
            $randa=mt_rand(0,count($empArray)-1);
            if(in_array($randa,$stock)){
                goto checkLast ;
            }
            array_push($stock,$randa);
            $complete_indatas=$empArray[$randa];
            array_push($data_store,$complete_indatas);
        }
    }
    $jsoned=json_encode($data_store);
    echo $jsoned;
    exit();
?>