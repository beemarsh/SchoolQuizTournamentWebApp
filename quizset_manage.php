<?php
session_start();
error_reporting(0);
setcookie('asfdfdg',$_GET['set'],0,'/');
define('checkguest',TRUE);
include 'handle/checkguest.php';
if(defined('guest')){
    $_SESSION['errorcode']='x113';
    include 'error.php';
    exit();
}
define('head_check',TRUE);
define('session-cookie_check',TRUE);
include 'handle/managequizset.php';
setcookie('asfsfbs',$data_set['field'],0,'/');
?>
<!DOCTYPE Html>
<html>
    <head>
            <title> Guffadi</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width initial-scale=1.0">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel=stylesheet href="../refrences/fonts/fonts.css ">
            <link rel=stylesheet href='../refrences/css/manage_quizset-style.css'>
            <link rel=stylesheet href='../refrences/css/header.css'>
            <link rel=stylesheet href='../refrences/css/pop-box.css'>

        
    </head>
        <script src='../refrences/js/jquery.js'>    </script>
        <script src="../refrences/js/manage_quizset-script.js"></script>
        <script src="../refrences/js/add-question.js"></script>
    <body>
    <?php include 'header.php';?>
<div id="manageQS-contain"> 
        <h3 class="headtext"> Manage QuizSet</h3>
        <h2 class="headtext"> <?php echo $data_set['setname'].'/  '.$data_set['field'];?></h2>
        <button class="addQbutt">Add Question</button>
        <button class="removeThisQSbutt" onclick="removeThisSet()">Remove this Set</button></a>
        <div class="all-questions">
            <?php
            include 'handle/viewquestions.php';
            ?>
        </div>
        <!-- <div class=a-question> 
            <span class=que> What is your name </span>
            <span > YUbraj </span> 
            <span > abs  </span> 
            <span > abs  </span> 
            <span > abs  </span> 

        </div>  -->
    </div>
     <!-- After user clicks on Add question or Manage question -->
     <div id="cover">
        <div class="cover-container">
            <div class="cover-hero">
     <form id="formAddQ" class=pop-box autocomplete='off' onsubmit='return addquizquestion()'> 
                <span class="pop-head">Add new question </span> 
            <label>
               <input type=text placeholder="Add question" id='question'>   
            </label> <label>
                <input type=text placeholder="Enter answer" id='answer'>
            </label> <label>
                <input type=text  placeholder="Enter Option1" id='opt1'>
            </label> <label>
                <input type=text  placeholder="Enter Option2" id='opt2'>
            </label> <label>
                <input type=text placeholder="Enter Option3" id='opt3'>
            </label> 
            <button type=submit id='submit_question'>Add new</button>
        
            <div id="cancel-butt" class="pop-close">
                                        X
            </div>
            <span class='errorMsgForm'> </span>
        </form>
        
        
        <form id='formConfirmBox' class=pop-box>
            <span>Are You Sure</span>
             
            <a class="ch" href='../handle/remove-set/<?php echo $data_set['setname'];?>'><button > Yes </button> </a>
            <div id="cancel-butt" class="pop-close">
                  X
            </div>
            
    </form>
    
     </div>
     </div>
     </div>
</body>
<script src="refrences/js/if_dataDel.js"></script>
</html>
<?php session_destroy();?>