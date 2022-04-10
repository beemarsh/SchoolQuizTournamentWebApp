window.addEventListener('load',questions);
function questions(){
    localdata=JSON.parse(localStorage.getItem('field'));
    var  field=localdata.field
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
                localStorage.setItem('bresdss',JSON.stringify(value));
                localStorage.setItem('dssdgsa',0);//No of questions taken
                localStorage.setItem('dfgeryy',0);//SCore
                tobekept=JSON.stringify({
                    "no":[]
                });
                localStorage.setItem('sfasfa',tobekept);//No of questions taken
                setTimeout(playing,4000);
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
    if(questionstaken>no_ques){
        alert('Questions are finished');
        for(a=0;a<document.getElementsByClassName('Opt').length;a++){
            document.getElementsByClassName('Opt')[a].removeEventListener('click',event_listen_click);
        }
        document.querySelector('.container').style.display='none';
        document.querySelector('.results').style.display='block';
        // *****************
        get_scores=JSON.parse(localStorage.getItem('ddffeert'));
        for(i=0;i<get_scores.length;i++){
            document.getElementsByClassName('results')[0].innerHTML=get_scores[i][0];
        }
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
    optionaray=[3,4,5];
    c=0;
    // Making pause button
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
}
function wrong_correct(){
    document.getElementsByClassName('Opt')[randomly_place_ans].classList.add('righted');
}
function event_listen_click(){
    // localStorage.setItem('dssdgsa',questionstaken);//No of questions taken
    if(this.innerHTML==quesarray[selected_ques_random][1][1]){
        this.classList.add('righted');
        points_added=parseInt(current_points)+10;
        localStorage.setItem('dfgeryy',points_added);
        for(a=0;a<document.getElementsByClassName('Opt').length;a++){
            document.getElementsByClassName('Opt')[a].removeEventListener('click',event_listen_click);
        }
        setTimeout(removecolors,2000);
        wrong_correct();        
        setTimeout(playing,2500);
    }else{
        this.classList.add('wronged');
        for(a=0;a<document.getElementsByClassName('Opt').length;a++){
            document.getElementsByClassName('Opt')[a].removeEventListener('click',event_listen_click);
        }
        setTimeout(wrong_correct,500);
        setTimeout(removecolors,2000);
        wrong_correct();
        setTimeout(playing,2500);
        }
}
function removecolors(){
    redbluefor=document.getElementsByClassName('Opt-box')[0];
    for(a=0;a<redbluefor.children.length;a++){
        redbluefor.children[a].classList.remove('righted');
        redbluefor.children[a].classList.remove('wronged');
    }
}
function pausequiz(){
    clearInterval(time_interval_bar);
    document.querySelector('#skipper').removeEventListener('click',skipquiz);
    document.querySelector('#pausedisplay').classList.add('w3-animate-top');
    document.querySelector('.pause').removeEventListener('click',pausequiz);
    document.querySelector('.pause').addEventListener('click',playquiz);
    document.querySelector('#pausedisplay').style.display='block';
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
    setTimeout(removecolors,1500);
    setTimeout(playing,1000);
}