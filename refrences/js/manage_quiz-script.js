document.addEventListener('DOMContentLoaded', function(){
    let closeButt = document.querySelectorAll(".pop-close")
    for(i=0;i < closeButt.length; i++){
        closeButt[i].addEventListener("click", function(){
        document.querySelector("#cover").style.display = "none";
        })
    }

    document.querySelector(".addQuizSetButt").onclick= function(){
        window.scrollTo(0,0)
        document.querySelector("#cover").style.display = "block";
    }

    document.querySelector(".removeThisQSbutt").onclick= function(){

    }
});