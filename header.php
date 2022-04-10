<?php
    if(!defined('head_check')){
        include 'error.php';
        exit;
    }
    define('session-cookie_check',TRUE);
    include 'handle/session-cookie_check.php';
    ?>
        <div class="horizontal-header"> 
            <i  id=search-ham class=" bar fa fa-bars"></i>
            
            <form id=search-form>
                <input name=player-search type=text placeholder="Search a person here." id='search-player' onkeyup='getname(this.value)'>
                <button type=submit>
                    <span class="fa fa-search"></span>
                </button>
                <div class="search-result"> </div>
            </form>
            
            <div class="user-info-butt" id="user-info-butt">
                <?php 
                    $c = new McryptCipher('passKey');
                    $decrypted = $c->decrypt($_COOKIE['nbie09']);
                    echo $decrypted;
                ?>
                <div>
                    <div class="side-arrow"></div>
                    
                    <span> <a href="my_account">Myaccount</a></span>
                    <span> <a href="handle/logout">Logout</a></span>
                </div>
            </div>
        
        
        </div>
        <div class="page-links ">
            <ul>
                <li><a class="a" href="home"> 
                    <div><i class="fa fa-home" aria-hidden="true"></i> </div>
                    <p>Home</p></a>
                </li>
                <li><a class="a" href="my_account">
                    <div><i class="fa fa-user-circle" aria-hidden="true"></i></div> 
                    <p> My account </p></a>
                </li>
            </ul>              
        </div>               
        <div class="page-links-cover" id="close-page-links"> <i class="fa fa-times" aria-hidden="true"></i></div>
    
    
    <script src='refrences/js/open-close.js'></script> 
    <script src='refrences/js/ajax.js'></script>