document.addEventListener("DOMContentLoaded", function(){
    let closeButt = document.querySelectorAll(".pop-close")
    for(i=0;i < closeButt.length; i++){
        closeButt[i].addEventListener("click", function(){
        document.querySelector("#cover").style.display = "none";
        this.parentElement.style.display = "none";
        })
    }

    document.querySelector(".addQbutt").onclick= function(){
      window.scrollTo(0,0);
      document.querySelector("#cover").style.display = "block";
        document.querySelector("#formAddQ").style.display= "block"
    }
})
function removeThisSet(){
    window.scrollTo(0,0);
    document.querySelector("#cover").style.display = "block";
    document.querySelector("#formConfirmBox").style.display= "block"  
}
function removeCBox(){
    document.querySelector("#cover").style.display = "none";
    document.querySelector("#formConfirmBox").style.display= "none"; 
}

