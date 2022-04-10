<?php
session_start();
define('checkguest',TRUE);
include 'handle/checkguest.php';
if(defined('guest')){
    $_SESSION['errorcode']='x113';
    include 'error.php';
    exit();
}
define('head_check',TRUE);
define('display-set_check',TRUE);
?>
<!DOCTYPE Html>
<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <title> Manage Quiz Sets</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel=stylesheet href="refrences/fonts/fonts.css ">
        <link rel=stylesheet href='refrences/css/manage_quiz-style.css'>
        <link rel=stylesheet href='refrences/css/header.css'>
        <link rel=stylesheet href='refrences/css/pop-box.css'>
        
    </head>
        <script src='refrences/js/open-close.js'>    </script>
        <script src='refrences/js/jquery.js'>    </script>
        <script src="./refrences/js/manage_quiz-script.js"></script>
        <script src='refrences/js/add-new-quiz-set.js'></script>
        <script src='refrences/js/add-question.js'></script>
    <body>
        <?php include 'header.php';    ?>
        <div class="Main-container">
            <h2 class="headtext"> Manage your Quiz Sets</h2>
            <div id="addQuizSetButt" class="butt addQuizSetButt"> Add a New Quiz Set</div>
            <ul>
            <?php include 'handle/display-set.php'; ?>
            </ul>
        </div>
                <!-- After user clicks on Add Quizset -->
                
            <!-- <form id="formAddQS" autocomplete='off' onsubmit='return addquizset()' >
                <div class="close-section fa fa-window-close"></div>
                Add Quiz Set <br>
                <input type=text id="quizSetName" placeholder="Enter the name for your new quiz set">
                <select id="quizFieldName">
                    <option value="Geography">Geography</option>
                    <option value="Science">Science</option>
                    <option value="History">History</option>
                    <option value="Literature">Literature</option>
                    <option value="Mixed">Mixed</option>
                </select>
                <button type=submit id='submit-set' class="doneAddQSbutt butt" > Done</button>

                <span class="errorMsgForm">
                
                 </span>
                </form> -->
                <div id=cover >
                    <div class="cover-container">
                        <div class="cover-hero">
                            <form id="formAddQS" class=pop-box autocomplete='off' onsubmit='return addquizset()'>
                                <span class="pop-head">Add Quiz Set </span>
                            <label> 
                                <input type=text  id="quizSetName" placeholder="Enter the name for your new quiz set">
                            </label>
                            <label >
                                <select style="width:100%;" id="quizFieldName">
                                        <option value="Geography">Geography</option>
                                        <option value="Science">Science</option>
                                        <option value="History">History</option>
                                        <option value="Literature">Literature</option>
                                        <option value="Mixed">Mixed</option>
                                    </select>
                                </label>
                                <label style="width:100%;">
                                        <button type=submit id='submit-set' class="doneAddQSbutt"> Done</button>
                                    </label>
                                    <div id="cancel-butt" class="pop-close">
                                        X
                                    </div>
                                 <span class="errorMsgForm">
                                 
                                  </span>
                        </form> 
                </div>
            </div>
        </div>

    </body>
    <script src="refrences/js/if_dataDel.js"></script>
</html>
<?php session_destroy();?>