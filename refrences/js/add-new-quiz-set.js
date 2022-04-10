function addquizset(){
    var setname=document.getElementById('quizSetName').value;
    var fieldname=document.getElementById('quizFieldName').value;
    var submit_set=document.getElementById('submit-set').value;
    var dataString='quizSetName='+setname + '&quizFieldName='+fieldname + '&submit-set='+submit_set;
    $.ajax({
        type:'POST',
        url:'handle/addQuizSet',
        data:dataString,
        cache:false,
        success:function(html){
            if(html=='Success'){
                $('.errorMsgForm').eq(0).hide();
                location.reload();
            }else{
                $('.errorMsgForm').eq(0).css('display','block');
            $('.errorMsgForm').eq(0).html(html);
            }
        }
    })
    return false;
}