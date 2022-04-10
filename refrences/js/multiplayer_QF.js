document.addEventListener("DOMContentLoaded",function(){
document.querySelector('#submitQuiz').addEventListener('click',playomniquiz);
})
function playomniquiz(){//Send Request To server for Question validation
    // localStorage.clear();
    var  field=document.getElementById('field_select').innerHTML;
    var perfectField=arrifyField(field);
    var  level=document.getElementById('level_select').value;
    var  no=document.getElementById('num_select').value;
    fieldData={                     //Set field Data Variables
        field:perfectField,
        no:no,
        level:level  
    }
    var datahold='field='+field + '&no='+no;
    localStorage.setItem('field',JSON.stringify(fieldData));
    conn.send('112start');
    $('#cover').hide();//Now Give some time to Load the Game
    $('#chooseQuiz').hide();
    $('#infoBar').text('The Game Will Start in Few Seconds');//** */
}
function arrifyField(infField){
    var field = infField.split(',');
    return field;
}