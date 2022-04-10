document.addEventListener("DOMContentLoaded",function(){
    let data = { i: 1}
    var a =  setInterval(function(){
        // document.querySelector("#readyText span").innerHTML = data.i;
        if(data.i==4){document.querySelector(".cover").style.display= "none";clearInterval(a)}
        data.i++;
    },1000)
    document.getElementById('goBackTour').addEventListener('click',function(){
        window.location='take_test';
    })
    document.getElementById('goBackHome').addEventListener('click',function(){
        window.location='home';
    })
})