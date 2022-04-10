<?php
    include 'sql-connection.php';
    $current_user_encrypt=$_COOKIE['hafhk43'];
 $c = new McryptCipher('passKey');
 $current_user = $c->decrypt($current_user_encrypt);
    if(isset($_GET['set'])){
        $set_name=mysqli_real_escape_string($sql_connect,$_GET['set']);
    }else{
        header('location:../manage_quiz');
        exit();
    }
    $select_question="SELECT * FROM quiz WHERE id='$current_user' AND setname='$set_name'";
    $query_select_question=mysqli_query($sql_connect,$select_question);
    $check_if_exists=mysqli_num_rows($query_select_question);
    $check=1;
    if($check_if_exists===0){
        echo '<span class=helptxt> No questions exist</span>';
    }else{
    while($fetch_record=mysqli_fetch_assoc($query_select_question)){
        if($check===1){
    // echo "<ul>
    //         <li>
    //             <div>
    //             <span>Question</span>
    //              <span>Answer</span>
    //               <span>Option1</span>
    //                <span>Option2</span>
    //                 <span>Option3</span>
    //                 </div> 
    //         </li>";
        }
           echo "
           <div class=a-question>
           <span class=que>".$fetch_record['question']."</span>
             <span> Correct Ans:".$fetch_record['answer']."</span> 
             <span> Option1: ".$fetch_record['opt1']."</span> 
             <span> Option2: ".$fetch_record['opt2']."</span>
              <span> Option3: ".$fetch_record['opt3']."</span>
              <div >
              <button class='editQbutt'>Edit</button>
              <a href='../handle/remove-quiz-ques/".$fetch_record['id_of_quiz']."/".$fetch_record['setname']."'>
              <button class='removeQbutt'>Remove</button>
              </a>
              </div>
              </div>
                ";
        $check++;
    }
    // echo '</ul>';
    }

?>