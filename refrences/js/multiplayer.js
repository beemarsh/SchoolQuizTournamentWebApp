// INIT VARS
count=1;
// After user clicks on Generate a Code Then Request the server to Generate a code
document.querySelector('#generate').addEventListener('click',req_ran_gen_code);
// Adding event listener when user Clicks take a Quiz
document.querySelector('#take_generate').addEventListener('click',take_ran_quiz);
// Verify the code if It exists when the user clicks Submit 
document.querySelector('#submit_code').addEventListener('click',verify_code);
// Function lists
// ************
// This function is executed when user Clicks to generate a random number
function req_ran_gen_code(){       
    $(".WTD-box").hide(1000);
    $(".container > div").css("flex-basis","100%") 
        $.ajax({
            type:'POST',
            url:'handle/generaterand',
            cache:false,
            success:function(html){
                if(parseInt(html)==NaN){//1 means Success
                    var msg_recieved='Error! Communicating with Server';
                    document.querySelector("[displayer='ran_code']").innerHTML=msg_recieved;
                }else{
                    document.querySelector("[displayer='ran_code']").innerHTML='Your Host Code:'+html;
                    $('#join').show();
                    $('#noticeBar').show();
                    $('#noticeBar').text('Provide This Code to the Clients To Join Your Game Session');

                    stopClose();
                }
            }
        })
        // It removes the buttons when user clicks on it
        $("[attr_hider]").remove();
        return false;
}
// ****************
// This function is executed when user clicks take a hosted quiz
function take_ran_quiz(){
    $(".WTD-box").hide(1000);
    $(".container > div").css("flex-basis","100%")
    // It removes the buttons when user clicks on it
    $("[attr_hider]").remove();
    // It shows the hidden input field
    $("[displayer='i_code']").show();
}


// This function is executed when user clicks submit button
function verify_code(){
    var code_entered=document.querySelector('#input_code').value;
    datahold='code='+code_entered;
    $.ajax({
        type:'POST',
        data:datahold,
        url:'handle/checkmulticode',
        cache:false,
        success:function(html){
            if(IsValidJSONString(html)){//means Succes
                $MesSage=JSON.parse(html);
                document.querySelector("[displayer='ran_code']").innerHTML='Successfully joined the game Hosted by '+$MesSage[1];
                $("[displayer='i_code']").remove();
                $('#join').show();
                stopClose();
            }          
            else{
                document.querySelector("[displayer='ran_code']").innerHTML=html;
            }
        }
    })
    // It removes the buttons when user clicks on it
    $("[attr_hider]").remove();
    return false;
}


// When user clicks start searching players
document.getElementById('join').addEventListener('click',after_search);
function after_search(){
    document.querySelector('#dis_head').style.display='none';
    document.querySelector('#join').style.display='none';
    // Give some time for Loader
    conn = new WebSocket('ws://192.168.100.57:8080');
    conn.onclose=function(e){//When USER gets Disconnected With WS
        $('#userAdmDisconn').show();
        $('#chooseQuiz').hide();
        $('#cover').hide();
        $('#circular-loader').hide();
        $('#circular-loader_big').hide();
        $('.mid-row').hide();
        $('#totPlay').hide();
        clearInterval(requestInterval);
        document.querySelector('#reloader').addEventListener('click',function(){
            window.location.reload();
        });//*** */
    }
    conn.onopen = function(e){
        $('#infoBar').text("Online Players: Host Code: "+getCookie('dijfnj'));//User Details Put
        $('#noticeBar').text("Above Players are Currenly Online on Your Host");
        document.querySelector('#reloader').removeEventListener('click',clickRetry);
        $('#reloader').hide();//*** */
        $('#circular-loader').hide();
        // JSONFIYING THE DATA
        $sendMSG=[
            getCookie('dijfnj'),getCookie('reusMTP')
        ]
    conn.send(JSON.stringify($sendMSG));
    requestInterval=setInterval(repeatRQST,1000);
    };


    var checkIfUAdmin=getCookie('ursADM');
    if(checkIfUAdmin==1){
    document.querySelector('#stopper').addEventListener('click',function(){//IF CLICKS STOP SEARCHING
        clearInterval(requestInterval);
        conn.send('112stop');
        $('#stopper').css('display','none');
        $('#starter').css('display','block');
        $('#goGame').css('display','block');
        $('#circular-loader').hide();
    })
    document.querySelector('#starter').addEventListener('click',function(){//IF CLICKS CONTINUE SEARCHING
        requestInterval=setInterval(repeatRQST,1000);
        $('#stopper').css('display','block');
        $('#starter').css('display','none');
        $('#goGame').css('display','none');
        $('#circular-loader').show();
    })

    document.querySelector('#goGame').addEventListener('click',function(){//IF CLICKS PROCEED TO GAME
        if(playerObj.length<2){
            $('#errorBox').css('display','flex');//If not more Than 1 player
            $('#errText').text('You require at Least One Player for Multiplayer');
            $('#okayPressed').on('click',function(){
                $('#errorBox').hide();
            })
        }else{
        conn.send('112proceed');
        $('#infoBar').text('Quiz Field Select');
        $('.makeAndRemove').remove();
        $('#chooseQuiz').show();
        $('#noticeBar').remove();
        $('#totPlay').remove();
        $('#circular-loader').hide();
        }
    })
 
    }

    conn.onmessage = function(e){//When Player List is Obtained From Socket
    console.log('Message Recieved');
    if(e.data=='112goPlay'){//Now users are readt to Go to Battle //If admin starts the Game pressing SUbmit in QuizField Select---------------------->Next Page goes Here
        clearInterval(requestInterval);
        $(window).off('beforeunload');
        $('#circular-loader').hide();
        $('#playerInfo').hide();
        $('#circular-loader_big').show();
        if(getCookie('ursADM')){//If he is admin Then Send the ajax request sending some data
            sendDataToServer('msgField');
        }else{//If he isnt admin recieve the data from ajax server
            sendDataToServer('msgGetField');
        }
        $('#cover').hide();//Now Give some time to Load the Game
        $('#chooseQuiz').hide();
        $('#multiplayer-list').hide();
        $('#infoBar').text('The Game Will Start in Few Seconds');//** */
        return;
    }                                  //
    playerObj=JSON.parse(e.data);
    document.querySelector('#multiplayer-list').style.display='flex';
    makePlayerDisplays(playerObj);
};
}


// Cookie Data Extracteing Function
function getCookie(cname){
    var name = cname + "=",
        ca = document.cookie.split(';'),
        i,
        c,
        ca_length = ca.length;
    for (i = 0; i < ca_length; i += 1) {
        c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) !== -1) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
// /Prevent From Closing Page 
function stopClose(){
    $(window).on('beforeunload',stopCloseReturn);
}
function stopCloseReturn(){
    return 'MAKE A ALERT';
}
// Continuously Send Sockets Reqsest
function repeatRQST(){
    conn.send('112PLAYS');
    var ifUserAdmin=getCookie('ursADM');
    if(ifUserAdmin==1){//Remove Stopper If Isnt ADmin
        $('#stopper').show();
    }else{
        $('#waitToProceed').show();
            $('#stopper').remove();
            $('#starter').remove();
            $('#goGame').remove();            
        }
}
 
// Player Displaying Function Is HERE
function makePlayerDisplays(ourPlays){
    $('#circular-loader').show();
    // First Remove All The Child Elements
    $('#multiplayer-list').empty();
    // 
    if(ourPlays[0]=='112off'){//If Admin Gets Logged Off
        conn.close();        
        $('#waitToProceed').hide();
        $('#totPlay').hide();
        $('#infoBar').text('Sorry!The Admin is Offline. You cannot Proceed Further');
        $('#noticeBar').text('The Host Admin might turn off the Game or The Server is out of Reach');
        $('#noticeBar').show();
        $('#userAdmDisconn').show();
        clearInterval(requestInterval);
        return;
    }
    if(ourPlays[0]=='112go'){//After Admin presses Submit Button
        $('#multiplayer-list').remove();
        $("#infoBar").show();
        $('#infoBar').text('Admin has Started the Game.The game will now proceed in few Moments....Loader for 3 seconds');
        return;
    }
    for(i=0;i<ourPlays.length;i++){
    var outerStrrct= document.createElement("li");
    // Player Pic
    var child1=document.createElement('div');
    var attr_for_child1= document.createAttribute("class");
    attr_for_child1.value = "player-pic";
    child1.setAttributeNode(attr_for_child1);
    outerStrrct.appendChild(child1);
    // PIC
    var PIC_URL=getPicLoc(i,ourPlays);
    if(PIC_URL.length==1){//If name String is PIC
        var namePic=document.createTextNode(PIC_URL.toUpperCase());
        child1.appendChild(namePic);
    }else{
    var userPic=document.createElement('img');
    var userPicAttr=document.createAttribute('src');
    userPicAttr.value=PIC_URL;
    userPic.setAttributeNode(userPicAttr);
    child1.appendChild(userPic);
    }
    // 
    // Player Name
    var child2=document.createElement('span');
    var attr_for_child2= document.createAttribute("class");
    attr_for_child2.value = "player-name";
    child2.setAttributeNode(attr_for_child2);
    outerStrrct.appendChild(child2);
    // Player Name
    var userName=document.createTextNode(ourPlays[i][1]);
    child2.appendChild(userName);
    // 
    // Player Profile
    var child3=document.createElement('div');
    var attr_for_child3= document.createAttribute("class");
    attr_for_child3.value = "player-prof";
    child3.setAttributeNode(attr_for_child3);
    outerStrrct.appendChild(child3);
    var userStat=document.createTextNode('User:'+ourPlays[i][0]);
    child3.appendChild(userStat);
    var PlayerBody=document.querySelector('#multiplayer-list');
    PlayerBody.appendChild(outerStrrct);
    }
    displayNoActive(ourPlays);
}

function getPicLoc(cout,datObj){
    $uSERlOCATION=datObj[cout][2];
    if($uSERlOCATION==''){
        $namePic=datObj[cout][1].charAt(0);
        return $namePic;
    }else{
        return $uSERlOCATION;
    }
}

// Check if JSON DATA OR NOT
function IsValidJSONString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
//When user Clicks reTry
function clickRetry(){
    after_search();
}
//To display no of Active Players
function displayNoActive(userInfoGet){
    $('#playerInfo').show();
    var TotalNousers=userInfoGet.length;
    $('#totPlay').text('Total Active Players:'+TotalNousers);
}

function gotoPlayLocation(){//To send them to new Playing location
    window.location.href='multipleplay';
}

function sendDataToServer(postVar){
    if(postVar=='msgField'){
        var datahold=postVar+'='+JSON.stringify(localStorage.getItem('field'));
    }else{
        var datahold=postVar+'='+123;
    }
    $.ajax({
        type:'POST',
        url:'handle/addFieldData.php',
        data:datahold,
        cache:false,
        success:function(html){
            if(html==1 && postVar=='msgField'){//IF admin sends Ajax to server
            }
            if(postVar=='msgGetField' && html!==1){//If client recievers from Ajax
                localStorage.setItem('field',html);
            }
            setTimeout(gotoPlayLocation,10000);
        }
    })
}
document.querySelector('#userAdmDisconn').addEventListener('click',function(){
    $(window).off('beforeunload');
    window.location.reload();
    console.log('actia');
});
6407970269