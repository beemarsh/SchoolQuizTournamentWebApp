document.addEventListener('DOMContentLoaded',function(){
    if(check_LSTorage()==null){//when field doesnt exist
        $(window).off('beforeunload');
        ifErrorShowIt();
    }
    $('#okayPressed').on('click',function(){
        window.location.href='home';
    })
})
window.addEventListener('load',questions);
radio_time=true;
function questions(){
    localdata=JSON.parse(localStorage.getItem('field'));
    var  field=localdata.field;
    var  no=localdata.no;
    var  level=localdata.level;
    var datahold='field='+field + '&no='+no;
    $.ajax({
        type:'POST',
        url:'handle/getquestions',
        data:datahold,
        cache:false,
        success:function(html){
            if(html){
                value=JSON.parse(html);
                if(value==1){//If there is error in Getting questions
                    ifErrorShowIt();
                }else{
                localStorage.setItem('bresdss',JSON.stringify(value));
                localStorage.setItem('dssdgsa',0);//No of questions taken
                localStorage.setItem('dfgeryy',0);//SCore
                tobekept=JSON.stringify({
                    "no":[]
                });
                ques_dataObj=[];//Last result info Local storage
                localStorage.setItem('nnbshri',JSON.stringify(ques_dataObj));
                localStorage.setItem('sfasfa',tobekept);//No of questions taken
                setTimeout(playing,4000);
                document.getElementsByClassName('bar')[0].style.maxWidth='100%';
            }
            }
            else{
                console.log('error');
            }
        }
    })
}
function playing(){
    questionstaken=parseInt(localStorage.getItem('dssdgsa'))+1;
    quesarray=JSON.parse(localStorage.getItem('bresdss'));
    no_ques=quesarray.length;
    total_points=no_ques*10;
    current_points=localStorage.getItem('dfgeryy');
    if(questionstaken>no_ques){//If questions are finished
        clearInterval(time_interval_bar);
        for(a=0;a<document.getElementsByClassName('Opt').length;a++){
            document.getElementsByClassName('Opt')[a].removeEventListener('click',event_listen_click);
        }
        document.querySelector('.bar').style.maxWidth='100%';
        document.querySelector('.container').style.display='none';
        document.querySelector('.results').style.display='block';
        show_result_paper();
        return;
    }
    document.querySelector('#score').innerHTML=current_points+'/'+total_points;
    selected_ques_random=Math.floor((Math.random() * no_ques-1) + 1);
    already_selected_ques=JSON.parse(localStorage.getItem('sfasfa'));
    while(already_selected_ques.no.includes(selected_ques_random)){
        selected_ques_random=Math.floor((Math.random() * no_ques-1) + 1);
    }
    already_selected_ques.no.push(selected_ques_random);
    localStorage.setItem('sfasfa',JSON.stringify(already_selected_ques));
    document.querySelector('#nos').innerHTML=questionstaken+'/'+no_ques;
    document.querySelector('#qfield').innerHTML=quesarray[selected_ques_random][1][2];
    document.querySelector('#ques').innerHTML=quesarray[selected_ques_random][1][0];
    randomly_place_ans=Math.floor((Math.random() * 4) + 1)-1;
    localStorage.setItem('dssdgsa',questionstaken);//No of questions taken
    document.getElementsByClassName('Opt')[randomly_place_ans].innerHTML=quesarray[selected_ques_random][1][1];
    curr_ques_this=quesarray[selected_ques_random][1][0];
    curr_ans_this=quesarray[selected_ques_random][1][1];
    optionaray=[3,4,5];
    c=0;
    // Making pause button
    document.querySelector('.pause').addEventListener('click',pausequiz);
    document.querySelector('#skipper').addEventListener('click',skipquiz);
    for(i=0;i<4;i++){
        if(i!==randomly_place_ans){            
            document.getElementsByClassName('Opt')[i].innerHTML=quesarray[selected_ques_random][1][optionaray[c]];
            c+=1;
        }
    }
    for(j=0;j<document.getElementsByClassName('Opt').length;j++){
        document.getElementsByClassName('Opt')[j].addEventListener('click',event_listen_click);
        }
        time_interval_bar=setInterval(timerbar,1);
}
function wrong_correct(){
    document.getElementsByClassName('Opt')[randomly_place_ans].classList.add('righted');
}
function event_listen_click(){//When user clicks on the options
    document.querySelector('.pause').removeEventListener('click',pausequiz);
    var curr_choosed=this.innerHTML;
    if(this.innerHTML==quesarray[selected_ques_random][1][1]){//If the selected option is correct
        this.classList.add('righted');
        points_added=parseInt(current_points)+10;
        localStorage.setItem('dfgeryy',points_added);
        for(a=0;a<document.getElementsByClassName('Opt').length;a++){
            document.getElementsByClassName('Opt')[a].removeEventListener('click',event_listen_click);
        }
        setTimeout(removecolors,2000);
        clearInterval(time_interval_bar);
        wrong_correct();
        document.querySelector('.bar').style.maxWidth='100%';
        setTimeout(playing,2500);
        var data_QuizObj=[curr_ques_this,curr_ans_this,curr_choosed,true,true];
    }else{//If the selected option is wrong
        this.classList.add('wronged');
        for(a=0;a<document.getElementsByClassName('Opt').length;a++){
            document.getElementsByClassName('Opt')[a].removeEventListener('click',event_listen_click);
        }
        setTimeout(wrong_correct,500);
        setTimeout(removecolors,2000);
        clearInterval(time_interval_bar);
        wrong_correct();
        document.querySelector('.bar').style.maxWidth='100%';
        // document.querySelector('.bar').style.background='#fffcf9';
        setTimeout(playing,2500);
        var data_QuizObj=[curr_ques_this,curr_ans_this,curr_choosed,true,false];
        }
        var prev_DATA=JSON.parse(localStorage.getItem('nnbshri'));
        prev_DATA.push(data_QuizObj);
        localStorage.setItem('nnbshri',JSON.stringify(prev_DATA));
}
function timerbar(){
    // This radio_time is to check if user has checked the timer bar or not
    if(radio_time==true){
    var prpert=document.getElementsByClassName('bar')[0].style.maxWidth;
    asfa=prpert.replace('%','');
    document.querySelector('.bar').style.maxWidth=asfa-0.02+'%';
    // if(asfa<65){
    //     document.querySelector('.bar').style.background='#ffbb00';
    // }
    // if(asfa<40){
    //     document.querySelector('.bar').style.background='red';
    // }
    if(asfa==0){
        document.querySelector('.pause').removeEventListener('click',pausequiz);
        clearInterval(time_interval_bar);
        wrong_correct();
        setTimeout(removecolors,1500);
        document.querySelector('.bar').style.maxWidth='100%';
        // document.querySelector('.bar').style.background='#000';
        setTimeout(playing,2000);
    }
}
}
function removecolors(){
    redbluefor=document.getElementsByClassName('Opt-box')[0];
    for(a=0;a<redbluefor.children.length;a++){
        redbluefor.children[a].classList.remove('righted');
        redbluefor.children[a].classList.remove('wronged');
    }
}
// After user clicks pause button
function pausequiz(){
    clearInterval(time_interval_bar);
    document.querySelector('#skipper').removeEventListener('click',skipquiz);
    // When user clicks resume button on Paused Display
    document.querySelector('.resume-quiz').addEventListener('click',playquiz);
    // When user clicks on Quit button
    document.querySelector('.quit-button').addEventListener('click',quizquiz);
    // ************
    // After user checks radio
    document.querySelector('.radio_time').addEventListener('change',func_timerDis);
    // 
    document.querySelector('#pausedisplay').classList.add('w3-animate-top');
    document.querySelector('.pause').removeEventListener('click',pausequiz);
    document.querySelector('.pause').addEventListener('click',playquiz);
    document.querySelector('#pausedisplay').style.display='flex';
    document.querySelector('.pause').classList.remove('fa-pause-circle');
    document.querySelector('.pause').classList.add('fa-play-circle');
    for(a=0;a<document.getElementsByClassName('Opt').length;a++){
        document.getElementsByClassName('Opt')[a].removeEventListener('click',event_listen_click);
    }
}
function playquiz(){
    time_interval_bar=setInterval(timerbar,1);
    document.querySelector('#skipper').addEventListener('click',skipquiz);
    document.querySelector('#pausedisplay').classList.remove('w3-animate-top');
    $('#pausedisplay').slideUp(350);
    document.querySelector('.pause').removeEventListener('click',playquiz);
    document.querySelector('.pause').addEventListener('click',pausequiz);
    document.querySelector('.pause').classList.remove('fa-play-circle');
    document.querySelector('.pause').classList.add('fa-pause-circle');
    for(a=0;a<document.getElementsByClassName('Opt').length;a++){
        document.getElementsByClassName('Opt')[a].addEventListener('click',event_listen_click);
    }
}
function skipquiz(){
    clearInterval(time_interval_bar);
    document.querySelector('.pause').removeEventListener('click',pausequiz);
    setTimeout(removecolors,1500);
    document.querySelector('.bar').style.maxWidth='100%';
    setTimeout(playing,1000);
    // Update data to Localstorage for last Result
    var data_QuizObj=[curr_ques_this,curr_ans_this,'Unselected',false,true];
    var prev_DATA=JSON.parse(localStorage.getItem('nnbshri'));
    prev_DATA.push(data_QuizObj);
    localStorage.setItem('nnbshri',JSON.stringify(prev_DATA));
}
// This function is executed when user clicks on Quit button
function quizquiz(){
var concode=confirm('Are you sure you want to Quit . All the changes will be Lost');
if(concode==true){
    window.location.href='take_test';
}
}
// This function is executed when user changes Timer Check box
function func_timerDis(){
    var radd_check=document.querySelector('.radio_time').checked;
    if(radd_check==true){
        radio_time=true;
        document.querySelector('.outer').style.display='block';
    }else{
        radio_time=false;
        document.querySelector('.outer').style.display='none';
    }
}

// Result Showing Function
 function show_result_paper(){
     var quesTotal=localStorage.getItem('dssdgsa');
     var dataMain=JSON.parse(localStorage.getItem('nnbshri'));
    for(i=0;i<quesTotal;i++){
            showResult(dataMain);
        //
        // For correctly attempted Questions
    }
 }


// To create new elements and add them fopr showing quiz results
function showResult(dataMain){
    if(dataMain[i][4]==true){// For skipped questions
        var outerStrrct= document.createElement("div");
        var attr_for_outerStrrct= document.createAttribute("class");
        attr_for_outerStrrct.value = "question-result corrected-quest";
        outerStrrct.setAttributeNode(attr_for_outerStrrct);
        var child1=document.createElement('span');
        var child1_ques=document.createTextNode("Query:  "+dataMain[i][0]);
        child1.appendChild(child1_ques);
        var attr_for_child1= document.createAttribute("class");
        attr_for_child1.value = "res-quest";
        child1.setAttributeNode(attr_for_child1);
        var child2=document.createElement('span');
        var child2_ques=document.createTextNode("Answer:  "+dataMain[i][1]);
        child2.appendChild(child2_ques);
        var attr_for_child2= document.createAttribute("class");
        attr_for_child2.value = "res-answer correct-answer-res";
        child2.setAttributeNode(attr_for_child2);
        outerStrrct.appendChild(child1);
        outerStrrct.appendChild(child2);
        var bodyElemnt= document.getElementById("overAll");
        bodyElemnt.appendChild(outerStrrct);
    } else{
        var outerStrrct= document.createElement("div");
        var attr_for_outerStrrct= document.createAttribute("class");
        attr_for_outerStrrct.value = "question-result wronged-quest";
        outerStrrct.setAttributeNode(attr_for_outerStrrct);
        var child1=document.createElement('span');
        var child1_ques=document.createTextNode("Query:"+dataMain[i][0]);
        child1.appendChild(child1_ques);
        var attr_for_child1= document.createAttribute("class");
        attr_for_child1.value = "res-quest";
        child1.setAttributeNode(attr_for_child1);
        var child2=document.createElement('span');
        var child2_ques=document.createTextNode("Answer:  "+dataMain[i][1]);
        child2.appendChild(child2_ques);
        var attr_for_child2= document.createAttribute("class");
        attr_for_child2.value = "res-answer correct-answer-res";
        child2.setAttributeNode(attr_for_child2);
        var child3=document.createElement('span');
        var child3_ques=document.createTextNode("Your choice:  "+dataMain[i][2]);
        child3.appendChild(child3_ques);
        var attr_for_child3= document.createAttribute("class");
        attr_for_child3.value = "res-answer correct-answer-res";
        child3.setAttributeNode(attr_for_child3);
        outerStrrct.appendChild(child1);
        outerStrrct.appendChild(child2);
        outerStrrct.appendChild(child3);
        var bodyElemnt= document.getElementById("overAll");
        bodyElemnt.appendChild(outerStrrct);
    }
}
// Check localstorage data existence
function check_LSTorage(){
    var data=localStorage.getItem('field');
    return data;
}

function ifErrorShowIt(){//Makae divs clear and errors visible
    $('.cover').empty();
    $('#pauseddisplay').empty();
    $('.container').empty();
    $('.results').empty();
    $('#errorBox').css('display','flex');
    $('#errText').text('You arent Permitted to This Page.Please Fill up All data');
    // alert('You arent Permitted to This Page.Please Fill up All data  POPUP NOT SHOWING ERROR DESIGNING HERE');
}