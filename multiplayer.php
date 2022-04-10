<?php
    define('checkguest',TRUE);
    include 'handle/checkguest.php';
    if(defined('guest')){
        $_SESSION['errorcode']='You are logged in GUEST';
        include 'error.php';
        exit();
    }
   if(isset($_COOKIE['dijfnj'])){
    setcookie('dijfnj','',time()-360000,'/');
    unset($_COOKIE['dijfnj']);
   }
   if(isset($_COOKIE['reusMTP'])){
    setcookie('reusMTP','',time()-360000,'/');
    unset($_COOKIE['reusMTP']);
   }
   if(isset($_COOKIE['ursADM'])){
    setcookie('ursADM','',time()-360000,'/');
    unset($_COOKIE['ursADM']);
   }
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width initial-scale=1.0">
            <title> Guffadi </title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel=stylesheet href="refrences/fonts/fonts.css">
            <link rel=stylesheet href='refrences/css/multiplayer.css'>
            <link rel=stylesheet href='refrences/css/pop-box.css'>
            <link rel=stylesheet href='refrences/css/take_test_landing-style.css'>
            <link rel=stylesheet href='refrences/css/alertBox.css'>

            <link rel="shortcut icon" type="image/png" href="./refrences/favicon/favicon.ico"/>
            <script src='refrences/js/jquery.js'></script>
            <script src="refrences/js/take-test-landing-script.js"></script>
            <!-- <script src="refrences/js/multiplayer-script.js" -->

        </head>
        <body>
        <div class="hero">
            <div class="container">
            <div class="WTD-box">
            <h1 class="page-heading">Collect user Information</h1>
            <p class="WTD-content"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt libero quis finibus mollis. Ut aliquet tempus ipsum sit amet sollicitudin. Aenean commodo odio eget leo scelerisque feugiat. Integer ex odio, tempor in est eu, blandit eleifend lacus. Etiam iaculis vitae lorem sed blandit. Sed et risus erat. Morbi egestas eros at diam dictum, nec luctus elit pulvinar. Nunc consequat a massa a dapibus. Ut nec nibh suscipit, accumsan quam at, varius justo. Maecenas consectetur, sapien vel vulputate commodo, augue leo aliquet ante, venenatis semper sem enim ut dolor. Sed maximus dui ante, quis condimentum lectus fringilla eu. Phasellus ac rutrum sem. Praesent vestibulum viverra nisl, eu elementum nisi dignissim vitae.
            </p>
            </div>

            <div class="bttns-box" id='blueBody'>
                <div class="info-bar" id='infoBar'>Multiplayer Panel </div>
                
                <div class="mid-row" >
                    <i class="back-btn fas fa-arrow-left"></i>
                    
                
                     <!--for For Slef Admin -->
                    <button class='btn btn-4' id='generate' attr_hider><span>Generate a Host Code</span></button>
                    <!--  -->
                    
                    <!-- For taking otherse -->
                    <button class='btn btn-4' id='take_generate' attr_hider><span>Take a Game</span></button>
                    <input class="code-input" type='number' placeholder='Enter the code if you choose to take others game' displayer='i_code' id='input_code' style='display:none;'>
                    
                    <!--  -->
                    <button class="btn btn-4" displayer='i_code' id='submit_code' style='display:none;'><span>Submit</span></button>
                    
                    <!-- Displaying everything here -->
                    <h1 displayer='ran_code' class="code" id='dis_head'></h1>
                    
                    <button class='btn btn-4' id='join'style='display:none'><span>Start Searching Players</span></button>
                    
                    <ul class="makeAndRemove multiplayer-list" id="multiplayer-list"> </ul>
                    <div class="stop-btn  makeAndRemove" id='stopper'> Stop Search</div>
                    <div class="stop-btn makeAndRemove" id='starter'>Continue Searching </div>
                    <div class="stop-btn makeAndRemove" id='goGame'>Proceed To Game </div><!--Design this Button Extra -->
<!--                    
                    <div class="loader3 loader--style3" title="2">
  <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
  <path fill="#fff" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
    <animateTransform attributeType="xml"
      attributeName="transform"
      type="rotate"
      from="0 25 25"
      to="360 25 25"
      dur="0.6s"
      repeatCount="indefinite"/>
    </path>
  </svg>
</div> -->

            <div class="fields-container" id="chooseQuiz" >

            <form class="setId-container">
        <input
          class="set-id"
          name="set-id"
          id=""
          type="text"
          placeholder="Enter a Specific Set Id"
        />
        <button type="submit" class="search-butt">
          <span class="fa fa-search"></span>
        </button>
      </form>

                <div>

                    <ul class="btns-container">

                        <li class="btns "> 
                            <div class="field-icon"><img src="./refrences/extras/chemistry.png" alt="Icon"> </div>
                            <span>Science</span>
                        </li>

                        <li class="btns "> 
                            <div class="field-icon"><img src="./refrences/extras/worldwide.png" alt="Icon"></div>
                            <span>Geography</span>
                        </li>

                        <li class="btns "> 
                           <div class="field-icon"><img src="./refrences/extras/history.png" alt="Icon"></div>
                           <span>History</span>
                        </li>

                        <li class="btns "> 
                            <div class="field-icon"><img src="./refrences/extras/book.png" alt="Icon"></div>
                            <span>Literature</span>
                        </li>

                        <li class="btns " id="mixed-btns"> 
                            <div class="field-icon"><img src="./refrences/extras/quiz.png" alt="Icon"></div>
                            <span>Mixed</span>
                        </li>

                    </ul>
                </div>
            <div class="done-bttn green-butt">Thats it!</div>
        </div>
    </div>
    <div class="alert-container" id='errorBox'><!--This shows Errors-->
           <div class="alert-box">
            <SPAN id='errText'></SPAN>
            <button class="alert-button" id='okayPressed'> Okay </button>
           </div> 
         </div>
    <div class="bottom-row" id='bottomInfo'>
        <div class="notice-bar" id='noticeBar'>
            <div id='waitToProceed' >Waiting For Host To Start Game</div><!--Design a GHUMNI LOADER SMALL-->
        </div>
        
        <div id="circular-loader" class="loader3 loader--style3" >
  <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
  <path fill="#fff" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
    <animateTransform attributeType="xml"
      attributeName="transform"
      type="rotate"
      from="0 25 25"
      to="360 25 25"
      dur="0.6s"
      repeatCount="indefinite"/>
    </path>
  </svg>
</div>    
        <div class="loader-frame" id="circular-loader_big"><!--Design This big Loader which Covers Most of the Entire Div-->
                        <div class="loader-center">
                           <div class="loader-dot-1"></div>
                           <div class="loader-dot-2"></div>
                           <div class="loader-dot-3"></div>
                        </div>    
        </div>

        <div id='reloader'><i class="fa fa-undo" aria-hidden="true"></i> ReTry</div><!-- YUBRAJ DESIGN THIS A CIRCULAR RETRY BUTTON-->
        <div id='userAdmDisconn' > <i class="fa fa-undo" aria-hidden="true"></i> Reload</div><!-- YUBRAJ DESIGN THIS A CIRCULAR RETRY BUTTON-->
        
        <div class="total-info" id='playerInfo'>
            <span id='totPlay'></span>
        </div>
            
    </div>
</div>
    <div id=cover >
        <div class="cover-container">
            <div class="cover-hero">
        <form class=pop-box>
            <span class="pop-head"> Start Searching Players</span>
            <label> 
                 <input type="hidden" name="field_select">
                 <p><span> Fields:</span> <span id='field_select'> </span></p> 
            </label>
            <label>
                <p><span> Difficulty Level</span> 
                <span> <select name=level id='level_select'> 
                <option value=easy> Easy </option>
                <option value=medium> Medium </option>
                <option value=hard> Hard </option>
                 </select></span></p>
            </label>
            <label>
                <p><span> No. of questions:</span>
                 <span> <input type=number max=50 min=10 name=no value=10 id='num_select'></span></p>
            </label>
            <label>
                <p><span> Duration for each question:</span> <span id="duration"></span></p>
            </label>
            <label style="width:100%;">
                <button class='butt green-butt' type='button' id='submitQuiz'>Submit</button>
            </label>
                <div id="cancel-butt" class="pop-close">
                    X
            <!-- <i class="fas fa-times"></i> -->
        </div>
        </form>
    </div>
    </div>
    </div>
</body>

<script src='refrences/js/multiplayer.js'></script>
<script src='refrences/js/multiplayer_QF.js'></script>
   
</html>