<?php
    define('check',TRUE);
    define('session-cookie_check',TRUE);
    session_start();
    include 'handle/session-cookie_check.php';
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width initial-scale=1.0">
            <title> Guffadi </title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel=stylesheet href="refrences/fonts/fonts.css ">
            <link rel=stylesheet href='refrences/css/take_test_main-style.css'>
            <link rel=stylesheet href='refrences/css/alertBox.css'>
            <script src='https://kit.fontawesome.com/a076d05399.js'></script>
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <script src='refrences/js/jquery.js'></script>
            <script src="refrences/js/take-test-main-script.js"></script>
            <script src='refrences/js/questionget.js'></script>
        </head>
        <body>
        <div class="alert-container" id='errorBox'><!--This shows Errors-->
           <div class="alert-box">
            <SPAN id='errText'></SPAN>
            <button class="alert-button" id='okayPressed'> Okay </button>
           </div> 
         </div>
            <div class=cover> 
            <div class="demo">
  <div class="demo__colored-blocks">
    <div class="demo__colored-blocks-rotater">
      <div class="demo__colored-block"></div>
      <div class="demo__colored-block"></div>
      <div class="demo__colored-block"></div>
    </div>
    <div class="demo__colored-blocks-inner"></div>
    <div class="demo__text">Ready</div>
  </div>
  <div class="demo__inner">
    <svg class="demo__numbers" viewBox="0 0 100 100">
      <defs>
        <path class="demo__num-path-1" d="M40,28 55,22 55,78"/>
        <path class="demo__num-join-1-2" d="M55,78 55,83 a17,17 0 1,0 34,0 a20,10 0 0,0 -20,-10"/>
        <path class="demo__num-path-2" d="M69,73 l-35,0 l30,-30 a16,16 0 0,0 -22.6,-22.6 l-7,7"/>
        <path class="demo__num-join-2-3" d="M28,69 Q25,44 34.4,27.4"/>
        <path class="demo__num-path-3" d="M30,20 60,20 40,50 a18,15 0 1,1 -12,19"/>
      </defs>
      <path class="demo__numbers-path" 
            d="M-10,20 60,20 40,50 a18,15 0 1,1 -12,19 
               Q25,44 34.4,27.4
               l7,-7 a16,16 0 0,1 22.6,22.6 l-30,30 l35,0 L69,73 
               a20,10 0 0,1 20,10 a17,17 0 0,1 -34,0 L55,83 
               l0,-61 L40,28" />
    </svg>
  </div>
</div>
            </div>
            <section id='pausedisplay'>
                <div class="pause-container">
                    <h1 style="text-align:center">Paused</h1>
                    <div class="afterpause-butt-container">
                        <div class="butt green-butt resume-quiz"> Resume </div>
                        <div class="butt red-butt quit-button"> Quit </div>
                    </div>
                    <div class="lang-container">
                        <span>Language options </span>
                        <div class="lang-opt lang-active"> English </div>
                        <div class="lang-opt ">Nepali </div>
                    </div>
                    <div class="settings-container">
                        <span> Other settings </span>
                        <p>
                            <label class="switch">
                            <input type="checkbox" class='radio_time' checked>
                            <span class="slider round"></span><br>
                        </label> <b> Timer </b> </p> 
                    </div>
                </div>
            </section>
            <section class=container>
                <section class=hero>
                        <div class="outer onehundred">
                            <div class="inner bar"></div>
                        </div>
                        <div class='pause far fa-pause-circle'></div>
                        <div class='scorebox'><span class='text-score'>Score: &nbsp;&nbsp;<span><span id='score'></span></div>
                    <div class="Q-Box">
                        <div class="qno" id='nos'></div>
                        <span id='ques'></span>
                        <!-- <div class='fas fa-angle-double-right' id='skipper'></div> -->
                        <div class="Q-data">
                            <span class= "Q-field">Field : <span id="qfield"></span></span>
                            <!-- <span class= "Q-field">Field : <span id="qfield"> data</span></span> -->
                            <div id="skipper" >Skip This ! </div> 
                        </div>
                    </div>
                    <div class="Opt-box">
                        <div class="Opt"></div>
                        <div class="Opt"></div>
                        <div class="Opt"></div>
                        <div class="Opt"></div>
                    </div>
                </section>
            </section>
            <section class='results'>
                <span class="overall-score">  Congratulations! you socred <p id="final-score"> </p> </span>
                <div class="result-btns"> 
                    <span id="goBackHome"> <i class="fa fa-home" aria-hidden="true"></i>Return Home</span></a>
                    <span id='goBackTour'>  <i class="fa fa-refresh" aria-hidden="true"></i>Retake</span>
                </div>
                <div class="overall-data" id='overAll'>
                  <!-- Section to be filled with Results -->
                </div>
            </section>
        </body>
    </html>