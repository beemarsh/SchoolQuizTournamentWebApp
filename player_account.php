<?php
    define('head_check',TRUE);
    define('afterlog_check',TRUE);
    define('checkguest',TRUE);
    include 'handle/checkguest.php';
    include 'handle/afterlog.php';
    include 'handle/user_profile.php';
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width initial-scale=1.0">
            <title> Guffadi</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel=stylesheet href="refrences/fonts/fonts.css ">
            <link rel=stylesheet href='refrences/css/myaccount-style.css'>
            <link rel=stylesheet href='refrences/css/header.css'>
            <!-- <link rel=stylesheet href='refrences/css/pop-box.css'> -->
            <script src='refrences/js/jquery.js'></script>
            <script src='refrences/js/open-close.js'></script>
            <script src='refrences/js/myaccount-script.js'></script>
            <script src='refrences/js/password-name-change.js'></script>
        </head>
        <body>
            <?php include 'header.php';?>
            <!-- <div id="cover">
            <div class="cover-container">
                        <div class="cover-hero">
            <form class=pop-box id="formConfirm" autocomplete='off' onsubmit='return passchange()'>
                    
                    <span class="pop-head"> Change Your Password </span>
                    <div class="errorMsgForm"> Error </div>
                    <label>
                        <input type='password' placeholder="Enter your Old password" id='oldpass'>
                </label> <label>
                <input type='password' placeholder="Enter your New password" id='newpass'/>
                </label> <label>
                <input type='password' placeholder="Confirm your New password" id='confirmpass'/>
                </label>
                <label>
                <button class="butt green-butt" type=submit id='pass_submit'> Done </button>
                </label>
                <div class="pop-close ">
                X
                    </div>
            </form>
            <form class=pop-box id="formChangeName" autocomplete="off" onsubmit='return namechange()'>
            <span class="pop-head">Change Your Full Name </span>   
            
                <div class="errorMsgForm"> Error </div>
            <label>
            <input type=text placeholder="Enter your New Full Name" id='fullname'>
            </label> <label>
            <input type=password placeholder="Enter your password" id='password'>
            </label> <label>
            <button class="butt green-butt" type=submit id='submit_namechange'> Done </button>
            </label> 
            <div class="pop-close ">
                X
                    </div>
            </form>
            <form class=pop-box id="bigDP">
                <img>
                <div class="pop-close ">
                X
                    </div>    
                    <label>  
                    <input id="changeDP" placeholder="change" type='file' name='profile_pic' accept='image/*'>
                </label> <label>
                    <button class="butt blue-butt upload-button" type='button'>Upload</button>
                    <button class="butt red-butt cancel-button" type='button'>Cancel</button>
            </label> 
                    <span class='errorMsgForm'>This is error</span>
            </form>
</div> </div> </div> -->
            <div class="data-container">
                    <div class="Display-pic-contain">
                        <!-- Display profile pic here -->
                        <div class="dp"><?php if(defined('guest')){echo "<img src='uploads/profile_pic/guest.png'>";}else{echo $user_pic_bigdp;}?></div>
                        <?php if(!defined('guest')){
                        echo "
                        <!-- <form>
                             <div class=bott id='changeDPbutt'> Change </div>
                         </form> -->";
                        }?>
                    </div>
                    <div>
                    <span>
                        <h2>Full Name:</h2>
                        <h3> <?php echo $user_name; ?></h3>
                        <!-- <?php if(!defined('guest')){
                        echo "<a href='#' class=bott onclick='changeName()'> Edit </a>";
                        }?> -->
                    </span>
                    <span><h2>User Name:</h2> <h3> <?php echo $user_username;?></h3> </span>
                    <!-- <span><h2>Points earned:</h2> <h3> <?php echo $points;?></h3> </span>
                    <span><h2>Global Rank:</h2> <h3><?php echo $global_rank;?></h3> </span> -->
                    <span><h2>Email:</h2> <h3><?php echo $user_email; ?></h3> </span>
                    <!-- <?php if(!defined('guest')){
                    echo "<h2><a href='#' class=bott onclick='confirmPsd()'>Change Password</a></h2>";
                    }?> -->
                    </div>
            </div>
        </body>
        <script src="refrences/js/if_dataDel.js"></script>
    </html>