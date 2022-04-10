function playomniquiz(){
    localStorage.clear();
    var  field=document.getElementById('field_select').innerHTML;
    var  level=document.getElementById('level_select').value;
    var  no=document.getElementById('num_select').value;
    fieldData={
        field:field,
        no:no,
        level:level  
    }
    var datahold='field='+field + '&no='+no;
    localStorage.setItem('field',JSON.stringify(fieldData));
    $.ajax({
        type:'POST',
        url:'handle/playquiz',
        data:datahold,
        cache:false,
        success:function(html){
            if(html){
                    location='taketour';
            }else{
                location.reload();
            }
        }
    })
    return false;
}