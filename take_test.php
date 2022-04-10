<?php
define('check',TRUE);
define('session-cookie_check',TRUE);
include 'handle/session-cookie_check.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width initial-scale=1.0" />
    <title>Guffadi</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="refrences/fonts/fonts.css " />
    <link rel="stylesheet" href="refrences/css/take_test_landing-style.css" />
    <link rel="stylesheet" href="refrences/css/Scroll Bar.css" />
    <link rel="stylesheet" href="refrences/css/pop-box.css" />
    <link rel="stylesheet" href="refrences/css/alertBox.css" />
    <script src="refrences/js/jquery.js"></script>
    <script src="refrences/js/ajax.js"></script>
    <script src="refrences/js/take-test-landing-script.js"></script>
    <script src="refrences/js/playquiz.js"></script>
  </head>
  <body>
    <!-- Alert Box -->
    <div class="alert-container">
      <div class="alert-box">
        <SPAN id='errText'></SPAN>
        <button class="alert-button" id='leaveErr'> Okay </button>
      </div> 
    </div>
    <!-- -------- -->
    <h1>
      Take a Quiz Test
    </h1>
    <div>
      <form class="setId-container">
        <input
        class="set-id"
        name="set-id"
        id="quizId"
        type="text"
        placeholder="Enter a Specific Set Id"
        />
        <button type="button" class="search-butt" id='searchId'>
          <span class="fa fa-search"></span>
        </button>
      </form>
      <ul class="btns-container">
        <li class="btns ">
          <div class="field-icon">
            <img src="./refrences/extras/chemistry.png" alt="Icon" />
          </div>
          <span>Science</span>
        </li>
        <li class="btns ">
          <div class="field-icon">
            <img src="./refrences/extras/worldwide.png" alt="Icon" />
          </div>
          <span>Geography</span>
        </li>
        <li class="btns ">
          <div class="field-icon">
            <img src="./refrences/extras/history.png" alt="Icon" />
          </div>
          <span>History</span>
        </li>
        <li class="btns ">
          <div class="field-icon">
            <img src="./refrences/extras/book.png" alt="Icon" />
          </div>
          <span>Literature</span>
        </li>
        <li class="btns " id="mixed-btns">
          <div class="field-icon">
            <img src="./refrences/extras/quiz.png" alt="Icon" />
          </div>
          <span>Mixed</span>
        </li>
      </ul>
    </div>
    <div class="done-bttn green-butt">Thats it!</div>
    <div id="cover">
      <div class="cover-container">
        <div class="cover-hero">
          <form class="pop-box" onsubmit="return playomniquiz()">
            <span class="pop-head"> Take Quiz </span>
            <label>
              <input type="hidden" name="field_select" />
              <p><span> Fields:</span> <span id="field_select"> </span></p>
            </label>
            <label>
              <p>
                <span> Difficulty Level</span>
                <span>
                  <select name="level" id="level_select">
                    <option value="easy"> Easy </option>
                    <option value="medium"> Medium </option>
                    <option value="hard"> Hard </option>
                  </select></span
                  >
                </p>
              </label>
              <label>
                <p>
                  <span> No. of questions:</span>
                  <span>
                    <input
                    type="number"
                    max="50"
                    min="10"
                    name="no"
                    value="10"
                    id="num_select"
                    /></span>
                  </p>
                </label>
                <label>
                  <p>
                    <span> Duration for each question:</span>
                    <span id="duration"></span>
                  </p>
                </label>
                <label style="width:100%;">
                  <button class="butt green-butt" type="submit">Proceed</button>
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
  <script src="refrences/js/if_dataDel.js"></script>
  <script src="refrences/js/taketestById.js"></script>
  </html>
  