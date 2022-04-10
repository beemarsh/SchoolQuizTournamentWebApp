document.addEventListener("DOMContentLoaded",function(){
    data ={
        UIB : true,
        ham: false
    }
    document.querySelector("#user-info-butt").onclick = function(){
    if (data.UIB){
        document.querySelector("#user-info-butt > div").style.display = "block";
        data.UIB= false ;
    } else {
        document.querySelector("#user-info-butt > div").style.display = "none";
        data.UIB= true ;
    }
    }

    document.getElementById("search-ham").onclick = function(){
        
        document.querySelector(".page-links").className = "page-links m-page-links" ;
        document.querySelector(".page-links-cover").style.display =  "block";
        
        // document.getElementById("").style.animation = "animate 2s backwards 1";
        // document.querySelector(".page-links ul").style.opacity = "1";
        
    }
    document.getElementById("close-page-links").onclick = function(){
        document.querySelector(".page-links").className =  "page-links "  ;
        document.querySelector(".page-links-cover").style.display =  "none";
        
    }

})