document.addEventListener("DOMContentLoaded", function(){
    let closeButt = document.querySelectorAll(".pop-close")
    for(i=0;i < closeButt.length; i++){
        closeButt[i].addEventListener("click", function(){
        document.querySelector("#cover").style.display = "none";
        this.parentElement.style.display = "none";
        })
    }

    document.querySelector("#changeDPbutt").onclick= function(){
        document.querySelector("#changeDP").click();
    }
    document.querySelector("#changeDP").onchange = function (){
        document.querySelector("#cover").style.display = "block";
        document.querySelector("#bigDP").style.display = "block";
        document.querySelector(".upload-button").style.display = "block";
        document.querySelector(".cancel-button").style.display = "block";
        valueofever=displaypic();
    }
    document.querySelector(".upload-button").onclick = function (){;
        uploadpic(valueofever);
    }
    document.querySelector(".cancel-button").onclick = function (){;
        cancelpic(valueofever);
        location.reload();
    }
    document.querySelector(".dp img").onclick = function() {
        document.querySelector("#cover").style.display = "block";
        document.querySelector("#bigDP img").setAttribute("src", document.querySelector(".dp img").getAttribute("src"));
        document.querySelector("#bigDP").style.display = "block";
        document.querySelector(".upload-button").style.display = "none";
        document.querySelector(".cancel-button").style.display = "none";
    }
})

function confirmPsd(){
    document.querySelector("#cover").style.display = "block";
    document.querySelector("#formConfirm").style.display = "block";
}
function changeName(){
    document.querySelector("#cover").style.display = "block";
    document.querySelector("#formChangeName").style.display = "block";
}
function displaypic(){
    var file_data = $('#changeDP').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    $.ajax({
        url: 'handle/temp-profile',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(html){
            if(html){
                document.querySelector("#bigDP img").setAttribute("src",html);
            }
        }
    })
    return form_data;
}
function uploadpic(datafiles){
    $.ajax({
        url: 'handle/addprofilepic',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: datafiles,
        type: 'post',
        success: function(html){
            if(html==1){
                location.reload();
            }else{
                document.querySelector('error-show').style.display='block';
                document.querySelector('error-show').innerHTML=html;
            }
        }
    })
    return false;
}
function cancelpic(datasssss){
    $.ajax({
        url: 'handle/cancelpic',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: datasssss,
        type: 'post',
        success: function(html){
            if(html){
                
            }
        }
    })
    return false;
}