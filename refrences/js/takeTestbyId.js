document.addEventListener('DOMContentLoaded',function(){
    document.querySelector('#searchId').addEventListener('click',takeTestByJs);
    document.querySelector('#leaveErr').addEventListener('click',hideerr);

})

function takeTestByJs(){
    var quizId=document.querySelector('#quizId').value;
    if(quizId==''){
        showerror('Please enter quiz ID');
        return;
    }
    datahold='qid='+quizId;
    $.ajax({
        async:true,
        type:'POST',
        url:'handle/getquestionByid.php',
        data:datahold,
        cache:false,
        success:function(html){
            // console.log(JSON.parse(html));
            showerror(html);
        }
    })
    return false;
}

function showerror(whatIserr){
    document.querySelector('.alert-container').style.display='flex';
    document.querySelector('#errText').innerHTML=whatIserr; 
}
function hideerr(){
    document.querySelector('.alert-container').style.display='none';
}