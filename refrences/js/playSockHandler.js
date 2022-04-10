uponPageOpen();




// Functions List

function uponPageOpen(){
    stopClose();//Prevent From closing of page
    conn = new WebSocket('ws://192.168.100.57:8080');
    var req1=getCookie('dijfnj');
    var req2=getCookie('reusMTP');
    if(checkIfAdmin()){
        var req3=getCookie('ursAdm');
        var firstMSG=JSON.stringify([req2,req1,'112battling',req3]);
    }else{
        var firstMSG=JSON.stringify([req2,req1,'112battling']);
    }
    conn.onopen=function(e){
        conn .send(firstMSG);
        scoreInterval=setInterval(getUsersScore,3000);
    }
    conn.onclose=function(e){//If server Gets Cut Off
        stopClose();
        $('#errText').text('The connection to server was interrupted');
        clearInterval(setSomeTime);
        clearInterval(scoreInterval);
    }
    conn.onmessage=function(e){
        showPlayersActive(JSON.parse(e.data));//Show players there
    }
}

function checkIfAdmin(){//Check if He is Admin or NOt
    if(getCookie('ursADM')){
        return true;
    }else{
        return false;
    }
}

function getCookie(cname){//Get cookies
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

function stopClose(){//Prevent from Page Reload
    $(window).on('beforeunload',stopCloseReturn);
}
function stopCloseReturn(){
    localStorage.clear();
    return 'MAKE A ALERT';
}
function getUsersScore(){//Get Users score function to Update scores
    var connMessage=JSON.stringify(['112score',getCookie('dijfnj'),getCookie('reusMTP')]);
    conn.send(connMessage);
}
function showPlayersActive($varsData){
    $('#scoreCorner').empty();
    for(i=0;i<$varsData.length;i++){
    var mainContainer= document.createElement("li");
    attrforcontainer=document.createAttribute('class');
    attrforcontainer.value='a-score me';    
    mainContainer.setAttributeNode(attrforcontainer);

    var child1=document.createElement('span');
    var attr_for_child1= document.createTextNode(i+1);
    child1.appendChild(attr_for_child1);
    mainContainer.appendChild(child1);

    var child2_pic=document.createElement('div');
    var attrForChild2=document.createAttribute('class');
    attrForChild2.value='profile-pic';
    child2_pic.setAttributeNode(attrForChild2);
    var PlayerPicText=document.createTextNode($varsData[i][2]);
    child2_pic.appendChild(PlayerPicText);
    mainContainer.appendChild(child2_pic);

    var child3NAME=document.createElement('span');
    var attrforCHILD3=document.createAttribute('class');
    child3NAME.setAttributeNode(attrforCHILD3);
    attrforCHILD3.value='player-name';
    var playerFirstLetter=$varsData[i][2].charAt(0);
    var palyerName=document.createTextNode(playerFirstLetter.toUpperCase());
    child3NAME.appendChild(palyerName);
    mainContainer.appendChild(child3NAME);
    
    var child4NAME=document.createElement('span');
    var attrforCHILD4=document.createAttribute('class');
    attrforCHILD4.value='no-score';
    child4NAME.setAttributeNode(attrforCHILD4);
    var scoreText=document.createTextNode($varsData[i][1]);
    child4NAME.appendChild(scoreText);
    mainContainer.appendChild(child4NAME);

    document.querySelector('#scoreCorner').appendChild(mainContainer);
    }

}
setSomeTime=setInterval(updateScore,3000);
function updateScore(){
    var datahold='score='+localStorage.getItem('dfgeryy');
    $.ajax({
        type:'POST',
        url:'handle/updateScore.php',
        data:datahold,
        cache:false,
        success:function(html){
            if(html==1){
                console.log('dataSent');
        }else{
            console.log(html);
        }
    }
    })
}