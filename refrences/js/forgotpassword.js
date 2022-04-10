document.addEventListener('DOMContentLoaded',function(){
    var a = document.getElementsByClassName('error');
    for (i=0;i<a.length;i++){
    if(a[i].innerHTML.trim()!=""){
       a[i].style.display= "block";
    }
}
})
function resendcode(){
    var  data1=readCookie('fdgirt3');
    if(!data1){
        alert('Session has expired.Try again.')
        document.location.href='forgotpassword';
    }
    var datahold='dated='+data1;
    $.ajax({
        async:true,
        type:'POST',
        url:'forgotpass',
        data:datahold,
        cache:false,
        success:function(html){
            if(html=='1'){ //1 means Success
                $('.error').css('display','block');
                $('.error').html('Code is resent.  Check your inbox');
            }else{
                $('.error').css('display','block');
            $('.error').html(html);
            }
        }
    })
    return false;
}
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}