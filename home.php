<?php 
define('checkguest',TRUE);
include 'handle/checkguest.php';
// define('check',TRUE);
define('head_check',TRUE);
define('afterlog_check',TRUE);
include 'handle/afterlog.php';
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width initial-scale=1.0">
            <title> Guffadi </title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel=stylesheet href="refrences/fonts/fonts.css">
            <link rel=stylesheet href='refrences/css/user_home-style.css'>
            <link rel=stylesheet href='refrences/css/alertBox.css'>
            <link rel=stylesheet href='refrences/css/header.css'>
            <link rel="shortcut icon" type="image/png" href="./refrences/favicon/favicon.ico"/>
            <script src='refrences/js/jquery.js'></script>
            <?php if(defined('guest')){echo "
            <script src='refrences/js/showerror.js'></script>
            ";}?>
         </head>
      <body>         
            <?php 
            include 'header.php'; 
            ?>
            <div id='cover'></div>
            <section class="container1">
                
                <section class="hero">
                    <div class="container">
                        <ul>    
                        <a  <?php if(defined('guest')){echo "href='#' onclick='showError(0)'";}else{echo "href='manage_quiz'";}?>'>
                        <li class="opts" data="create">
                           <div class="icons"><img src="refrences/extras/manage.png" ></div> 
                           <h2>Manage Questions!</h2>
                           <h4>Manage your questions </h4>
                        </li> </a>
                        <!-- <span class="helptxt"> Manage questions of your quiz set. </span> -->
                        <br>
                       <a href='take_test'> 
                            <li class="opts" data="create">
                                <div class="icons"><img src="refrences/extras/checklist.png" ></div> 
                                <h2>Take Quiz Test!</h2>
                                <h4>Take quiz from server. </h4>
                            </li>
                        </a>
                        <!-- <span class="helptxt"> Take a test and learn new questions. </span> -->
                       <!-- <a href='<?php if(defined('guest')){echo '#';}else{echo '@@@@Enter hosting location here';} ?>'>
                       <li class="opts" data="create">
                                <div class="icons"><img src="refrences/extras/server.png" ></div> 
                                <h2>Host a Quiz</h2>
                                <h4>Host a quiz test</h4>
                        </li></a> -->
                        <!-- <span class="helptxt"> Take a test and learn new questions. </span> -->
                       <!-- <a href='<?php if(defined('guest')){echo '#';}else{echo '@@@@Enter hosting location here';} ?>'><li class="opts" data="create">
                                <div class="icons"><img src="refrences/extras/edit.png" ></div> 
                                <h2>Take a hosted quiz!</h2>
                                <h4>Take test hosted by others</h4>
                            </li></a> -->
                        <!-- <span class="helptxt"> Take a test and learn new questions. </span> -->
                       
                        <a <?php if(!defined('guest')){ echo "href='multiplayer'";}else{echo "href=# onclick='showError(1)'";}?>>
                            <li class='opts multiquiz' data='create'>
                                <div class='icons'><img src='refrences/extras/group.png' ></div> 
                                <h2>Multiplayer</h2>
                                <h4>Multiplayer test </h4>
                            </li>
                        </a>";
            </ul>            
            <div class="text-container">
    <div class=" text-head"> What is Omni Quiz ? </div>
        <div class="text-content"> 
                     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi egestas eros at diam dictum, nec luctus elit pulvinar. Nunc consequat a massa a dapibus. Ut nec nibh suscipit, accumsan quam at, varius justo. Maecenas consectetur, sapien vel vulputate commodo, augue leo aliquet ante, venenatis semper sem enim ut dolor. Sed maximus dui ante, quis condimentum lectus fringilla eu. Phasellus ac rutrum sem. Praesent vestibulum viverra nisl, eu elementum nisi dignissim vitae.
            </div>
            </div>
                    </div>
                        
                    <!-- <div class='notifications-contain'>
                        <h2 class='subhead-text'><?php if(defined('guest')){echo 'You are logged in as Guest.<br>Limited features are only available.';}else{echo 'Notifications!!';}?></h2>
                        <?php if(!defined('guest')){ echo "
                        <div>
                            <div class='a-notification' id='note-1'> 
                                <div class='opponent-userpic'> </div>
                                <span> Oppoenent_name has challenged you.</span>
                            </div>
                            <div class='a-notification' id='note-1'> 
                                <div class='opponent-userpic'> </div>
                                <span>Oppoenent_name accepted your challenge and scored opponent_score in your quiz set.</span>
                            </div>
                        </div>
                        ";}?>
                    </div> -->
                    <?php if(defined('guest')){echo "
                    <form id='formAddQS' autocomplete='off'>
                        <div class='close-section fa fa-window-close'></div>
                        <h1 class='display-error-head'>Error!!</h1>
                        <br>
                        <span class='display-error'>Sorry!This option is unavailable for guest.</span>
                        <br>
                        <br>
                        <br>
                        <span class='display-error-info'>Register a account to use all features.</span><br><br>
                        Error code:x112
                    </form>
                    ";}
                    ?>
                    <form id='formAddQS' class='multiwindow' autocomplete='off'>
                        <div class='close-section fa fa-window-close'></div>
                        <button class='butt igive' type='button'>Let me Host</button>
                        <button class='butt itake' type='button'>Take others</button>
                    </form>
                    <form id='formAddQS' class='mehost' autocomplete='off'>
                        <div class='close-section fa fa-window-close'></div>
                        <button class='butt randg' type='button'>Generate a Host code</button>
                        <h1 id='mycode'></h1>
                        <br>
                        <br>
                        <button class='butt searchactive' type='button'>Start searching players</button>
                        <span class='errorMsgForm'></span>
                    </form>
                    <form id='formAddQS' class='hehost' autocomplete='off'>
                        <div class='close-section fa fa-window-close'></div>
                        <h1>Enter the Host code</h1>
                        <input type="number" class='multiput' placeholder="Enter the code">
                        <span class='errorMsgForm'></span>
                        <br><br>
                        <button class='playmultiquiz butt' type='button'>Go</button>
                    </form>
                              <!-- ==------------------------------------------- -->
         <div class="alert-container">
           <div class="alert-box">
            <SPAN id='errDisplay'></SPAN>
            <button class="alert-button"> Okay </button>
           </div> 
         </div>
                    <form id='formAddQS' class='waitingarea' autocomplete='off'>
                        <div class='close-section fa fa-window-close'></div>
                        <h1>Active Players</h1>
                        <h1 class='curr_code'></h1>
                        <div class='actualdisplay'></div>
                        <span class='errorMsgForm'></span>
                        <button class='butt starter' type='button'>Start Quiz </button>
                    </form>
                </section>
            </section>
            <!-- <footer>
     <span> Developed by Ideal coders! </span>
    </footer> -->
        </body>
        <script src="refrences/js/if_dataDel.js"></script>
    </html>