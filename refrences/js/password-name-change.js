function namechange(){
    var  name=document.getElementById('fullname').value;
    var password=document.getElementById('password').value;
    var submit_check=document.getElementById('submit_namechange').value;
    var datahold='name='+name + '&password='+password+'&submit_check='+submit_check;
    $.ajax({
        type:'POST',
        url:'handle/change_name',
        data:datahold,
        cache:false,
        success:function(html){
            if(html=='Success'){
                location.reload();
                $('.errorMsgForm').eq(1).hide();
            }else{
                $('.errorMsgForm').eq(1).css('display','block');
            $('.errorMsgForm').eq(1).html(html);
            }
        }
    })
    return false;
}
function passchange(){
    var  oldpassword=document.getElementById('oldpass').value;
    var newpassword=document.getElementById('newpass').value;
    var confirmpassword=document.getElementById('confirmpass').value;
    var submit_check_pass=document.getElementById('pass_submit').value;
    var datahold='oldpass='+oldpassword + '&newpass='+newpassword+'&confirmpass='+confirmpassword+'&check_if_submit='+submit_check_pass;
    $.ajax({
        type:'POST',
        url:'handle/password_change',
        data:datahold,
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